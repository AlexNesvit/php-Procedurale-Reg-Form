<?php
function debug($variable){
    echo '<pre>' . print_r($variable, true) . '</pre>';
}

function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: ../login.php');
        exit();
    }
}
/**
 * @param array $errors
 * @return array
 */
function getArr(array $errors): array
{
    //nom d'utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name'])) {
        $errors['name'] = "Votre nom n'est pas valide";
    }

    //prénom d'utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre prénom n'est pas valide";
    }

    //email conditions et implémentation dans la base de données
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    }

    //téléphone conditions et implémentation dans la base de données
    if (empty($_POST['phone']) || !preg_match('/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', $_POST['phone'])) {
        $errors['phone'] = "Votre téléphone n'est pas valide";
    }

    //adresse utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['address'])) {
        $errors['address'] = "Votre adresse n'est pas valide";
    }
    //code postal utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['zipcode']) || !preg_match('/^\\d{5}$/', $_POST['zipcode'])) {
        $errors['zipcode'] = "Votre code postal n'est pas valide";
    }
    //ville utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['city'])) {
        $errors['city'] = "Votre ville n'est pas valide";
    }
    return $errors;
}
//permet la moditification  des informations de profil
/** 
 * @param PDO $pdo
 * @param mixed $user_id
 * @return array
 */
function extracted(PDO $pdo, mixed $user_id): array
{
    $req = $pdo->prepare("UPDATE users  SET `name`=?, username=? , phone=?, email=?, `address`=?, `zipcode`=?, `city`=? WHERE id = $user_id");
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $zipcode = htmlspecialchars($_POST['zipcode']);
    $city = htmlspecialchars($_POST['city']);
    $req->execute([$name, $username, $phone, $_POST['email'], $address, $zipcode, $city]);
    return array($req, $name, $username, $phone, $address, $zipcode, $city);
}


