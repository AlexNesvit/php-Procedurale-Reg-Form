<?php
session_start();
require '../include/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['auth']->id;
    $basket_id = $_POST['basket_id'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare('
        UPDATE basket
        SET quantity = :quantity
        WHERE id = :basket_id AND user_id = :user_id
    ');
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':basket_id', $basket_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: cart.php');
    exit();
}
