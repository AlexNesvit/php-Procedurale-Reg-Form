<?php
session_start();
require '../include/database.php';

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['auth'])) {
    // Si l'utilisateur n'est pas authentifié, le rediriger vers la page de connexion
    header('Location: ../login.php');
    exit;
}

// Récupération de l'ID utilisateur
$user_id = $_SESSION['auth']->id;

// Vérification de la présence du panier dans la session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Récupération du panier depuis la session
    $cart = $_SESSION['cart'];

    // Insertion des données dans la table basket
    $stmt = $pdo->prepare("INSERT INTO basket (user_id, createdAt, isPaid) VALUES (?, NOW(), 0)");
    $stmt->execute([$user_id]);
    $basket_id = $pdo->lastInsertId();

    // Insertion des articles du panier dans la table basket_has_goods
    foreach ($cart as $item) {
        $goods_id = $item['goods_id']; // Supposons que dans le tableau $item il y a une clé goods_id
        $quantity = $item['quantity'];
        $stmt = $pdo->prepare("INSERT INTO basket_has_goods (basket_id, goods_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$basket_id, $goods_id, $quantity]);
    }

    // Mise à jour de la table basket, définir isPaid = 1
    $stmt = $pdo->prepare("UPDATE basket SET isPaid = 1 WHERE id = ?");
    $stmt->execute([$basket_id]);

    // Vider le panier dans la session
    unset($_SESSION['cart']);

    // Définir un message de succès pour la commande
    $_SESSION['message'] = "Votre commande a été envoyée au gestionnaire, nous vous contacterons bientôt!";
}

// Rediriger vers la page du panier
header('Location: cart.php');
exit;
?>
