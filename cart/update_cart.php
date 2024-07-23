<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require '../include/database.php';

// Vérifier si la session de panier existe
if (!isset($_SESSION['cart'])) {
    // Si le panier n'existe pas, rediriger vers la page d'accueil
    header('Location: ../index.php');
    exit;
}

// Récupérer le panier de la session
$cart = $_SESSION['cart'];
$message = '';

// Si l'utilisateur a cliqué sur "Mettre à jour la Quantité"
if (isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $index => $quantity) {
        if (isset($cart[$index])) {
            $quantity = intval($quantity);
            if ($quantity > 0) {
                // Mettre à jour la quantité du produit dans le panier
                $cart[$index]['quantity'] = $quantity;
                $req = $pdo->prepare('UPDATE basket_has_goods SET quantity = :quantity WHERE basket_id = :basket_id AND goods_id = :goods_id');
                $req->bindParam(':quantity', $quantity);
                $req->bindParam(':basket_id', $cart[$index]['basket_id']);
                $req->bindParam(':goods_id', $cart[$index]['goods_id']);
                $req->execute();
            } else {
                // Supprimer le produit si la quantité est nulle ou inférieure
                $req = $pdo->prepare('DELETE FROM basket_has_goods WHERE basket_id = :basket_id AND goods_id = :goods_id');
                $req->bindParam(':basket_id', $cart[$index]['basket_id']);
                $req->bindParam(':goods_id', $cart[$index]['goods_id']);
                $req->execute();
                unset($cart[$index]);
            }
        }
    }
    // Mettre à jour la session pour refléter les changements dans le panier
    $_SESSION['cart'] = array_values($cart); // Réindexer le tableau pour éliminer les "trous"
    $_SESSION['message'] = 'Quantité mise à jour avec succès!';
}

// Si l'utilisateur a cliqué sur "Supprimer"
if (isset($_POST['remove'])) {
    $index = $_POST['remove'];
    if (isset($cart[$index])) {
        // Récupérer l'ID du panier et du produit
        $basket_id = $cart[$index]['basket_id'];
        $goods_id = $cart[$index]['goods_id'];

        // Supprimer l'entrée de la base de données
        $req = $pdo->prepare('DELETE FROM basket_has_goods WHERE basket_id = :basket_id AND goods_id = :goods_id');
        $req->bindParam(':basket_id', $basket_id);
        $req->bindParam(':goods_id', $goods_id);
        $req->execute();

        // Vérifier si c'était le dernier produit dans le panier et supprimer le panier si nécessaire
        $req = $pdo->prepare('SELECT COUNT(*) FROM basket_has_goods WHERE basket_id = :basket_id');
        $req->bindParam(':basket_id', $basket_id);
        $req->execute();
        $count = $req->fetchColumn();

        if ($count == 0) {
            $req = $pdo->prepare('DELETE FROM basket WHERE id = :id');
            $req->bindParam(':id', $basket_id);
            $req->execute();
        }

        // Supprimer l'entrée du panier de la session
        unset($cart[$index]);

        // Mettre à jour la session
        $_SESSION['cart'] = array_values($cart); // Réindexer le tableau pour éliminer les "trous"

        // Message de succès pour la suppression du produit
        $_SESSION['message'] = 'Produit supprimé avec succès!';
    }
}

// Rediriger l'utilisateur vers la page du panier
header('Location: cart.php');
exit;
