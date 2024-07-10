<?php
session_start();
require '../include/database.php';

// Проверка авторизации пользователя
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../login.php');
//     exit;
// }

// Проверяем, существует ли корзина
if (!isset($_SESSION['cart'])) {
    header('Location: ../index.php');
    exit;
}

// Получаем корзину из сессии
$cart = $_SESSION['cart'];
$message = '';

// Если пользователь нажал "Mettre à jour la Quantité"
if (isset($_POST['update'])) {
    // Обновляем количество товаров
    foreach ($_POST['quantities'] as $index => $quantity) {
        if (isset($cart[$index])) {
            $quantity = intval($quantity);
            if ($quantity > 0) {
                $cart[$index]['quantity'] = $quantity;
                $req = $pdo->prepare('UPDATE basket SET quantity = :quantity WHERE id = :id');
                $req->bindParam('quantity', $quantity);
                $req->bindParam('id', $cart[$index]['basket_id']);
                $req->execute();
            } else {
                // Удаляем товар, если количество равно нулю или меньше
                unset($cart[$index]);
            }
        }
    }
    $_SESSION['message'] = 'Quantité mise à jour avec succès!';
  
}

// Если пользователь нажал "Supprimer"
$cart = $_SESSION['cart'];

// Если пользователь нажал "Supprimer"
if (isset($_POST['remove'])) {
    $index = $_POST['remove'];
    if (isset($cart[$index])) {
        // Получаем ID корзины
        $basket_id = $cart[$index]['basket_id'];

        // Удаляем запись из базы данных
        $req = $pdo->prepare('DELETE FROM basket WHERE id = :id');
        $req->bindParam('id', $basket_id);
        $req->execute();

        // Удаляем запись из сессии
        unset($cart[$index]);

        // Обновляем сессию
        $_SESSION['cart'] = $cart;

        // Сообщение об успешном удалении
        $_SESSION['message'] = 'Produit supprimé avec succès!';
    }
}

// Перенаправляем пользователя обратно на страницу корзины или главную страницу
header('Location: cart.php');
exit;


