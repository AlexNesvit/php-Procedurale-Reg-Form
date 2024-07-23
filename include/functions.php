<?php
// Fonction de débogage pour afficher les variables de manière lisible
function debug($variable){
    echo '<pre>' . print_r($variable, true) . '</pre>';
}

// Fonction pour restreindre l'accès aux utilisateurs authentifiés uniquement
function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start(); // Démarrer une session si aucune n'est active
    }
    if(!isset($_SESSION['auth'])){
        // Si l'utilisateur n'est pas authentifié, définir un message d'erreur et rediriger vers la page de connexion
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: ../login.php');
        exit();
    }
}

/**
 * Valide les données du formulaire et remplit le tableau des erreurs si nécessaire
 * @param array $errors
 * @return array
 */
function getArr(array $errors): array
{
    // Vérification du nom d'utilisateur
    if (empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name'])) {
        $errors['name'] = "Votre nom n'est pas valide";
    }

    // Vérification du prénom d'utilisateur
    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre prénom n'est pas valide";
    }

    // Vérification de l'email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    }

    // Vérification du numéro de téléphone
    if (empty($_POST['phone']) || !preg_match('/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', $_POST['phone'])) {
        $errors['phone'] = "Votre téléphone n'est pas valide";
    }

    // Vérification de l'adresse
    if (empty($_POST['address'])) {
        $errors['address'] = "Votre adresse n'est pas valide";
    }

    // Vérification du code postal
    if (empty($_POST['zipcode']) || !preg_match('/^\\d{5}$/', $_POST['zipcode'])) {
        $errors['zipcode'] = "Votre code postal n'est pas valide";
    }

    // Vérification de la ville
    if (empty($_POST['city'])) {
        $errors['city'] = "Votre ville n'est pas valide";
    }
    
    return $errors;
}

/**
 * Met à jour les informations de profil dans la base de données
 * @param PDO $pdo
 * @param mixed $user_id
 * @return array
 */
function extracted(PDO $pdo, mixed $user_id): array
{
    // Préparation de la requête de mise à jour
    $req = $pdo->prepare("UPDATE users SET `name`=?, username=? , phone=?, email=?, `address`=?, `zipcode`=?, `city`=? WHERE id = $user_id");
    
    // Récupération et sécurisation des données du formulaire
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $zipcode = htmlspecialchars($_POST['zipcode']);
    $city = htmlspecialchars($_POST['city']);
    
    // Exécution de la requête avec les données du formulaire
    $req->execute([$name, $username, $phone, $_POST['email'], $address, $zipcode, $city]);
    
    return array($req, $name, $username, $phone, $address, $zipcode, $city);
}
