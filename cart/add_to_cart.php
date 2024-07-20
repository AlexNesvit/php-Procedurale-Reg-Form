<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require '../include/database.php';

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['auth'])) {
    // Si l'utilisateur n'est pas authentifié, le rediriger vers la page de connexion
    header('Location: ../login.php');
    exit;
}

// Vérification des données POST requises
if (!isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    echo 'Données manquantes';
    die();
}

// Récupération des données de produit et de l'utilisateur
$user_id = $_SESSION['auth']->id;
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$quantity = 1;

// Initialisation du panier si non existant
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Vérifie si un panier non payé existe déjà pour cet utilisateur
$req = $pdo->prepare('SELECT id FROM basket WHERE user_id = ? AND isPaid = FALSE ORDER BY createdAT DESC LIMIT 1');
$req->execute([$user_id]);
$basket = $req->fetch(PDO::FETCH_ASSOC); // Utilise PDO::FETCH_ASSOC pour retourner un tableau associatif

if ($basket) {
    $basket_id = $basket['id'];
} else {
    // Crée un nouveau panier
    $req = $pdo->prepare('INSERT INTO basket (user_id, createdAT, isPaid) VALUES (?, ?, FALSE)');
    $req->execute([$user_id, date('Y-m-d H:i:s')]);
    $basket_id = $pdo->lastInsertId();
}

// Vérifie si le produit est déjà dans le panier
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['product_id'] == $product_id) {
        $item['quantity'] += $quantity;
        $found = true;

        // Mets à jour la quantité du produit dans la base de données
        $req = $pdo->prepare('UPDATE basket_has_goods SET quantity = ? WHERE basket_id = ? AND goods_id = ?');
        $req->execute([$item['quantity'], $basket_id, $product_id]);
        break;
    }
}

if (!$found) {
    // Ajoute le produit au panier dans la base de données
    $req = $pdo->prepare('INSERT INTO basket_has_goods (basket_id, goods_id, quantity) VALUES (?, ?, ?)');
    $req->execute([$basket_id, $product_id, $quantity]);

    // Ajoute le produit au panier en session
    $_SESSION['cart'][] = [
        'basket_id' => $basket_id,
        'user_id' => $user_id,
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $quantity,
        'createdAT' => date('Y-m-d H:i:s'),
        'goods_id' => $product_id,
    ];
}

// Ajouter un message de succès à la session
$_SESSION['message'] = 'Produit ajouté au panier avec succès!';

// Rediriger vers la page d'accueil
header('Location: ../index.php');
exit();

