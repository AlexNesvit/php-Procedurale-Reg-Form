<?php
session_start();
require '../include/database.php';

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
            } else {
                // Удаляем товар, если количество равно нулю или меньше
                unset($cart[$index]);
            }
        }
    }
    $message = 'Quantité mise à jour avec succès!';
}

// Если пользователь нажал "Supprimer"
if (isset($_POST['remove'])) {
    $index = $_POST['remove'];
    if (isset($cart[$index])) {
        unset($cart[$index]);
    }
    $message = 'Produit supprimé avec succès!';
}

// Обновляем корзину в сессии
$_SESSION['cart'] = $cart;
$_SESSION['message'] = $message;

// Возвращаем пользователя на страницу корзины
header('Location: cart.php');
exit;

