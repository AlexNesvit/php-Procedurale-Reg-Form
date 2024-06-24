<?php

session_start();
require_once '../../include/database.php';
$user_id = $_GET['id'];
$reqUser = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$reqUser->execute([$user_id]);
$user = $reqUser->fetch();

//permet la moditification du modification des informations de profil
if (isset($_POST['validateProfil'])) {

    $errors = array();
    require_once '../../include/database.php'; //appel du fichier relationnel de la base de données
    $user_id = $_GET['id'];

    //nom d'utilisateur conditions et implémentation dans la base de données
    $errors = getArr($errors);

    //envoi des données dans la base de données. cryptage du mot de passe
    if (empty($errors)) {
        require_once '../../include/database.php';  //appel du fichier relationnel de la base de donnée
        list($req, $name, $username, $phone, $address, $zipcode, $city) = extracted($pdo, $user_id);
        $_SESSION['flash']['success'] = 'le compte a bien été mis à jour';
        header('Location: ../dashboardUser.php');
        exit();
    }
}
if (isset($_POST['validatePass'])){

        if ($_POST['password'] != $_POST['password_confirm'] || empty($_POST['password_confirm'] )) {
            $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas et ne peuvent être vide";
        } else {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            require_once '../../include/database.php';
            $pdo->prepare('UPDATE users SET `password` =? WHERE id = ?')->execute([$password, $user_id]);
            $_SESSION['flash']['success'] = "Le mot de passe à bien été mise à jour";

        }


}