<?php
// Inclure les fonctions nécessaires
require_once '../../include/functions.php';

// Démarrer la session
session_start();

if (isset($_POST['validate'])) {
    // Liste des erreurs
    $errors = array();

    // Vérification du nom du produit
    if (empty($_POST['name'])) {
        $errors['name'] = "Le nom du produit ne peut être vide";
    } else {
        // Nettoyer le nom du produit
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    // Vérification du prix du produit
    if (empty($_POST['price'])) {
        $errors['price'] = "Le prix ne peut être vide";
    } else {
        // Nettoyer le prix du produit (autoriser les nombres à virgule)
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    // Vérification de l'image du produit
    if (empty($_POST['image'])) {
        $errors['image'] = "L'image ne peut être vide";
    } else {
        // Nettoyer l'URL de l'image
        $image = filter_var($_POST['image'], FILTER_SANITIZE_URL);
    }

    // Si aucune erreur de validation, exécuter la requête vers la base de données
    if (empty($errors)) {
        // Inclure le fichier de connexion à la base de données
        require_once '../../include/database.php';

        try {
            // Préparation de la requête
            $req = $pdo->prepare('INSERT INTO goods (`name`, `price`, `image`) VALUES (:name, :price, :image)');
            
            // Liaison des paramètres
            $req->bindParam(':name', $name, PDO::PARAM_STR);
            $req->bindParam(':price', $price, PDO::PARAM_STR); // Utiliser PARAM_INT si le prix est un entier
            $req->bindParam(':image', $image, PDO::PARAM_STR);

            // Exécution de la requête
            $req->execute();

            // Message de succès et redirection vers la page de gestion des produits
            $_SESSION['flash']['success'] = 'Votre produit a bien été créé';
            header('Location: ../dashboardProduit.php');
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur de base de données
            $_SESSION['flash']['errors'] = "Erreur lors de l'ajout du produit : " . $e->getMessage();
            header('Location: ../dashboardProduit.php');
            exit();
        }
    } else {
        // S'il y a des erreurs de validation, les stocker dans la session
        $_SESSION['flash']['errors'] = $errors;
        header('Location: ../dashboardProduit.php');
        exit();
    }
}
