<?php
// Inclure les fonctions nécessaires
include 'include/functions.php';

// Vérifier si le formulaire a été soumis et si les champs 'username' et 'password' ne sont pas vides
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    // Inclure le fichier de connexion à la base de données
    require_once 'include/database.php';

    // Préparer la requête pour sélectionner l'utilisateur par nom d'utilisateur ou par email
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username)');
    $req->execute(['username' => $_POST['username']]);

    // Récupérer l'utilisateur
    $user = $req->fetch();

    // Vérifier si l'utilisateur existe
    if ($user) {
        // Vérifier le mot de passe
        if (password_verify($_POST['password'], $user->password)) {
            // Démarrer la session
            session_start();
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['auth'] = $user;

            // Vérifier le rôle de l'utilisateur
            if($user->role == 0){
                // Ajouter un message de succès à la session
                $_SESSION['flash']['success'] = "Vous êtes bien connecté";
                // Rediriger vers la page de profil utilisateur
                header('Location: vueProfil/profile.php');
            } else {
                // Ajouter un message de succès pour l'admin
                $_SESSION['flash']['success'] = "Bienvenue Admin";
                // Rediriger vers le tableau de bord admin
                header('Location: dashboard.php');
            }
            exit();
        } else {
            // Si le mot de passe est incorrect, ajouter un message d'erreur
            $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect";
        }
    }
}