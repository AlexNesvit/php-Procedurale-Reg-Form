<?php
// Inclure les fonctions nécessaires
require_once 'include/functions.php';

// Démarrer la session
session_start();

if (isset($_POST['validate'])) {

    // Initialiser un tableau pour les erreurs
    $errors = array();
    
    // Inclure le fichier de connexion à la base de données
    require_once 'include/database.php'; // appel du fichier relationnel de la base de données

    // Vérification du nom d'utilisateur
    if (empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name'])) {
        $errors['name'] = "Votre nom n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE `name`=?');
        $req->execute([$_POST['name']]);
        $user = $req->fetch();
    }

    // Vérification du pseudo (username)
    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre pseudo n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username=?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
    }

    // Vérification de l'email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email=?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = 'Cet e-mail existe déjà';
        }
    }

    // Vérification du numéro de téléphone
    if (empty($_POST['phone']) || !preg_match('/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', $_POST['phone'])) {
        $errors['phone'] = "Votre téléphone n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE `phone`=?');
        $req->execute([$_POST['phone']]);
        $user = $req->fetch();
        if ($user) {
            $errors['phone'] = 'Ce téléphone existe déjà';
        }
    }

    // Vérification de l'adresse
    if (empty($_POST['address'])) {
        $errors['address'] = "Votre adresse n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE address=?');
        $req->execute([$_POST['address']]);
        $user = $req->fetch();
    }

    // Vérification du code postal
    if (empty($_POST['zipcode']) || !preg_match('/^\\d{5}$/', $_POST['zipcode'])) {
        $errors['zipcode'] = "Votre code postal n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE zipcode=?');
        $req->execute([$_POST['zipcode']]);
        $user = $req->fetch();
    }

    // Vérification de la ville
    if (empty($_POST['city'])) {
        $errors['city'] = "Votre ville n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE city=?');
        $req->execute([$_POST['city']]);
        $user = $req->fetch();
    }

    // Vérification du mot de passe
    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Vous devez rentrer un mot de passe valide";
    }

    // Si aucune erreur de validation, envoi des données dans la base de données
    if (empty($errors)) {
        require_once 'include/database.php';  // appel du fichier relationnel de la base de donnée
        
        // Préparation de la requête d'insertion
        $req = $pdo->prepare("INSERT INTO users SET `name`=?, username=?, phone=?, email=?, address=?, zipcode=?, city=?, `password`=?, `role`=?");
        
        // Hachage du mot de passe
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Récupération et nettoyage des données du formulaire
        $name = htmlspecialchars($_POST['name']);
        $username = htmlspecialchars($_POST['username']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $zipcode = htmlspecialchars($_POST['zipcode']);
        $city = htmlspecialchars($_POST['city']);
        $role = 0;
        
        // Exécution de la requête avec les données du formulaire
        $req->execute([$name, $username, $phone, $_POST['email'], $address, $zipcode, $city, $password, $role]);
        
        // Ajouter un message de succès à la session
        $_SESSION['flash']['success'] = 'Votre compte a bien été créé, merci de vous connecter';
        
        // Rediriger vers la page de connexion
        header('Location: login.php');
        exit();
    }
}
