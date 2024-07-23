<?php
// Démarrer la session
session_start();

// Permet la modification du mot de passe en vérifiant les différentes conditions
if (isset($_POST['validatePass'])) {
    if (!empty($_POST)) {
        // Vérifier si les mots de passe ne correspondent pas
        if ($_POST['password'] != $_POST['password_confirm']) {
            $_SESSION['flash']['danger'] = "Les mots de passe ne correspondent pas";
        } else {
            // Récupérer l'ID de l'utilisateur à partir de la session
            $user_id = $_SESSION['auth']->id;
            
            // Hacher le mot de passe
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // Inclure le fichier de connexion à la base de données
            require_once '../include/database.php';
            
            // Préparer et exécuter la requête de mise à jour du mot de passe
            $pdo->prepare('UPDATE users SET `password` = ? WHERE id = ?')->execute([$password, $user_id]);
            
            // Ajouter un message de succès à la session
            $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
        }
    }
}

// Permet la modification du profil utilisateur
if (isset($_POST['validateProfil'])) {
    // Initialiser un tableau pour les erreurs
    $errors = array();
    
    // Inclure le fichier de connexion à la base de données
    require_once '../include/database.php';
    
    // Récupérer l'ID de l'utilisateur à partir de la session
    $user_id = $_SESSION['auth']->id;
    
    // Valider les entrées du formulaire et remplir le tableau d'erreurs
    $errors = getArr($errors);
    
    // Si aucune erreur de validation, envoi des données dans la base de données
    if (empty($errors)) {
        require_once '../include/database.php';
        
        // Préparer et exécuter la mise à jour des données utilisateur
        list($req, $name, $username, $phone, $address, $zipcode, $city) = extracted($pdo, $user_id);
        
        // Mettre à jour les informations de l'utilisateur dans la session
        $_SESSION['auth']->name = $name;
        $_SESSION['auth']->username = $username;
        $_SESSION['auth']->phone = $phone;
        $_SESSION['auth']->address = $address;
        $_SESSION['auth']->zipcode = $zipcode;
        $_SESSION['auth']->city = $city;
        
        // Ajouter un message de succès à la session
        $_SESSION['flash']['success'] = 'Votre compte a bien été mis à jour';
    }
}

// Permet d'effacer le compte utilisateur
if (isset($_POST['eraseAccount'])) {
    // Inclure le fichier de connexion à la base de données
    require_once '../include/database.php';
    
    // Récupérer l'ID de l'utilisateur à partir de la session
    $user_id = $_SESSION['auth']->id;
    
    // Préparer et exécuter la requête de suppression de l'utilisateur
    $pdo->prepare('DELETE FROM users WHERE id = ?')->execute([$user_id]);
    
    // Ajouter un message de succès à la session
    $_SESSION['flash']['success'] = "Votre compte a bien été supprimé";
    
    // Rediriger vers la page d'inscription
    header('Location: register.php');
    exit();
}
