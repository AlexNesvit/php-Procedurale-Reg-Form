<?php
session_start();
require '../include/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['auth']->id;
    $basket_id = $_POST['basket_id'];

    $stmt = $pdo->prepare('
        DELETE FROM basket
        WHERE id = :basket_id AND user_id = :user_id
    ');
    $stmt->bindParam(':basket_id', $basket_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: cart.php');
    exit();
}
