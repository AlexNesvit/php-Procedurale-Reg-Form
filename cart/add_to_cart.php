<?php
session_start();
require '../include/database.php';

if (!isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    echo 'Données manquantes';
    exit;
}

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = 1;

// Инициализация корзины в сессии, если она еще не существует
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Проверка, есть ли продукт уже в корзине
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['product_id'] == $product_id) {
        $item['quantity'] += $quantity;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $quantity,
    ];
}

header('Location: ../index.php');
exit;

