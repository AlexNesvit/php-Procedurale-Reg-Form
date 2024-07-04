<?php
session_start();

// Проверяем, существует ли корзина
if (!isset($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

// Получаем корзину из сессии
$cart = $_SESSION['cart'];

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
}

// Если пользователь нажал "Supprimer"
if (isset($_POST['remove'])) {
    $index = $_POST['remove'];
    if (isset($cart[$index])) {
        unset($cart[$index]);
    }
}

// Обновляем корзину в сессии
$_SESSION['cart'] = $cart;

// Возвращаем пользователя на страницу корзины
header('Location: cart.php');
exit;
?>
