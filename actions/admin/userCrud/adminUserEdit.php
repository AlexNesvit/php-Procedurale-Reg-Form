<?php

// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once '../../include/database.php';

// Récupérer l'ID de l'utilisateur depuis l'URL
$user_id = $_GET['id'];

// Préparer et exécuter la requête pour récupérer les informations de l'utilisateur
$reqUser = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$reqUser->execute([$user_id]);
$user = $reqUser->fetch();

// Permet la modification des informations de profil
if (isset($_POST['validateProfil'])) {

    // Initialiser un tableau pour les erreurs
    $errors = array();
    require_once '../../include/database.php'; // Inclure à nouveau le fichier de connexion à la base de données
    $user_id = $_GET['id'];

    // Vérification du nom d'utilisateur et mise en œuvre des conditions dans la base de données
    $errors = getArr($errors);

    // Si aucune erreur de validation, envoi des données dans la base de données
    if (empty($errors)) {
        require_once '../../include/database.php';  // Inclure à nouveau le fichier de connexion à la base de données
        list($req, $name, $username, $phone, $address, $zipcode, $city) = extracted($pdo, $user_id);
        
        // Ajouter un message de succès à la session
        $_SESSION['flash']['success'] = 'Le compte a bien été mis à jour';
        
        // Rediriger vers la page de gestion des utilisateurs
        header('Location: ../dashboardUser.php');
        exit();
    }
}

// Permet la modification du mot de passe
if (isset($_POST['validatePass'])) {

    // Vérification du mot de passe et confirmation
    if ($_POST['password'] != $_POST['password_confirm'] || empty($_POST['password_confirm'])) {
        $_SESSION['flash']['danger'] = "Les mots de passe ne correspondent pas et ne peuvent être vides";
    } else {
        // Hachage du mot de passe
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        require_once '../../include/database.php';  // Inclure à nouveau le fichier de connexion à la base de données
        
        // Préparer et exécuter la requête pour mettre à jour le mot de passe
        $pdo->prepare('UPDATE users SET `password` = ? WHERE id = ?')->execute([$password, $user_id]);
        
        // Ajouter un message de succès à la session
        $_SESSION['flash']['success'] = "Le mot de passe a bien été mis à jour";
    }
}
