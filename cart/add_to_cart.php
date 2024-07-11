<?php
session_start();
require '../include/database.php';

// Проверка авторизации пользователя
// if (!isset($_SESSION['user_id'])) {
//     // Если пользователь не авторизован, перенаправляем его на страницу входа
//     header('Location: ../login.php');
//     exit;
// }

if (!isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    echo 'Données manquantes';
    die();
}
$user_id = $_SESSION['auth']->id;
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = 1;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['product_id'] == $product_id) {
        $item['quantity'] += $quantity;
        $found = true;
        break;
    }
}

if (!$found) {
    // $req = $pdo->prepare('INSERT INTO basket (user_id, produit_id, quantity) VALUES (?, ?, ?)');
    // $req->execute([$_SESSION['auth']->id, $product_id, $quantity]);

    $req = $pdo->prepare('INSERT INTO basket (user_id, createdAT) VALUES (?, ?)');
    $req->execute([$_SESSION['auth']->id, date('Y-m-d H:i:s')]);

    $basket_id = $pdo->lastInsertId(); // Получение последнего вставленного ID

    $_SESSION['cart'][] = [
        'basket_id' => $basket_id,
        'user_id' => $user_id,
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $quantity,
    ];
  
}
$_SESSION['message'] = 'Produit ajouté au panier avec succès!';
header('Location: ../index.php');
// echo json_encode(['status' => 'success', 'message' => 'Produit ajouté au panier avec succès !']);



