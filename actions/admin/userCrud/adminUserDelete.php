<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
include ('../../../include/database.php');

// Récupérer l'ID de l'utilisateur depuis l'URL
$user_id = $_GET['id'];

try {
    // Préparer et exécuter la requête de suppression de l'utilisateur
    $pdo->prepare('DELETE FROM users WHERE id = ?')->execute([$user_id]);

    // Ajouter un message de succès à la session
    $_SESSION['flash']['success'] = "Le compte a bien été supprimé";

    // Rediriger vers la page de gestion des utilisateurs
    header('Location: ../../../vueDashboard/dashboardUser.php');
    exit();
} catch (PDOException $e) {
    // En cas d'erreur, ajouter un message d'erreur à la session
    $_SESSION['flash']['danger'] = "Erreur lors de la suppression du compte : " . $e->getMessage();

    // Rediriger vers la page de gestion des utilisateurs
    header('Location: ../../../vueDashboard/dashboardUser.php');
    exit();
}
