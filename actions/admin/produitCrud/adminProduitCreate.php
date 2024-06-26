<?php
require_once '../../include/functions.php';
session_start();

if (isset($_POST['validate'])) {
    // Список ошибок
    $errors = array();

    // Проверка наличия имени продукта
    if (empty($_POST['name'])) {
        $errors['name'] = "Le nom du produit ne peut être vide";
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    // Проверка наличия цены продукта
    if (empty($_POST['price'])) {
        $errors['price'] = "Le prix ne peut être vide";
    } else {
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Позволяет использовать дробные числа
    }

    // Проверка наличия изображения продукта
    if (empty($_POST['image'])) {
        $errors['image'] = "L'image ne peut être vide";
    } else {
        $image = filter_var($_POST['image'], FILTER_SANITIZE_URL);
    }

    // Если нет ошибок валидации, выполняем запрос к базе данных
    if (empty($errors)) {
        require_once '../../include/database.php'; // Подключение к базе данных

        try {
            // Подготовка запроса
            $req = $pdo->prepare('INSERT INTO goods (`name`, `price`, `image`) VALUES (:name, :price, :image)');
            
            // Привязка параметров
            $req->bindParam(':name', $name, PDO::PARAM_STR);
            $req->bindParam(':price', $price, PDO::PARAM_STR); // Можно использовать PARAM_INT, если цена целое число
            $req->bindParam(':image', $image, PDO::PARAM_STR);

            // Выполнение запроса
            $req->execute();

            // Успешное сообщение и перенаправление на страницу управления продуктами
            $_SESSION['flash']['success'] = 'Votre produit a bien été créé';
            header('Location: ../dashboardProduit.php');
            exit();
        } catch (PDOException $e) {
            // В случае ошибки базы данных
            $_SESSION['flash']['errors'] = "Erreur lors de l'ajout du produit : " . $e->getMessage();
            header('Location: ../dashboardProduit.php');
            exit();
        }
    } else {
        // Если есть ошибки валидации, сохраняем их в сессию
        $_SESSION['flash']['errors'] = $errors;
        header('Location: ../dashboardProduit.php');
        exit();
    }
}
