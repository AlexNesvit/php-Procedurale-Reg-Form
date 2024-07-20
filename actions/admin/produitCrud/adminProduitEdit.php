<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once '../../include/database.php';

// Récupérer l'ID du produit depuis l'URL
$produit_id = $_GET['id'];

// Préparer et exécuter la requête pour récupérer les détails du produit
$reqProduit = $pdo->prepare('SELECT * FROM goods WHERE id = ?');
$reqProduit->execute([$produit_id]);

// Récupérer le produit sous forme de tableau associatif
$produit = $reqProduit->fetch();

// Vérifier si le formulaire a été soumis
if (isset($_POST['validate'])) {

    // Initialiser un tableau pour stocker les erreurs
    $errors = array();

    // Inclure à nouveau le fichier de connexion à la base de données (même si déjà inclus)
    require_once '../../include/database.php'; //appel du fichier relationnel de la base de données

    // Si le tableau des erreurs est vide, procéder à la mise à jour du produit
    if (empty($errors)) {  
        // Récupérer et nettoyer les données du formulaire
        $name = htmlspecialchars($_POST['name']);
        $price = htmlspecialchars($_POST['price']);
        $image = htmlspecialchars($_POST['image']);
        $produit_id = $_GET['id'];

        // Préparer la requête de mise à jour
        $req = $pdo->prepare("UPDATE goods SET `name` = ?, `price` = ?, `image` = ? WHERE `id` = ?");

        // Exécuter la requête avec les données du formulaire
        $req->execute([$name, $price, $image, $produit_id]);

        // Ajouter un message de succès à la session
        $_SESSION['flash']['success'] = 'Votre produit a bien été modifié';

        // Rediriger vers la page de gestion des produits
        header('Location: ../dashboardProduit.php');
        exit();
    } else {
        // S'il y a des erreurs, les stocker dans la session
        $_SESSION['flash']['errors'] = $errors;

        // Rediriger vers la page de gestion des produits
        header("Location: ../dashboardProduit.php");
        exit();
    }
}
