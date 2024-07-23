<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
include ('../../../include/database.php');

// Récupérer l'ID du produit depuis l'URL
$produit_id = $_GET['id'];

try {
    // Préparer et exécuter la requête de suppression en une seule étape
    $pdo->prepare('DELETE FROM goods WHERE id = ?')->execute([$produit_id]);

    // Ajouter un message de succès à la session
    $_SESSION['flash']['danger'] = "Le produit a bien été supprimé";

    // Rediriger vers la page de gestion des produits
    header('Location: ../../../vueDashboard/dashboardProduit.php');
    exit();
} catch (PDOException $e) {
    // En cas d'erreur, ajouter un message d'erreur à la session
    $_SESSION['flash']['danger'] = "Erreur lors de la suppression du produit : " . $e->getMessage();

    // Rediriger vers la page de gestion des produits
    header('Location: ../../../vueDashboard/dashboardProduit.php');
    exit();
}