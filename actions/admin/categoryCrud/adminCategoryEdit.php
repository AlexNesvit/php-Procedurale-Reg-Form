<?php

session_start();
require_once '../../include/database.php';
$category_id = $_GET['id'];
$reqCategory = $pdo->prepare('SELECT * FROM categorie WHERE idcategorie = ?');
$reqCategory->execute([$category_id]);
$category = $reqCategory->fetch();

if (isset($_POST['validate'])) {

    $errors = array();
    require_once '../../include/database.php'; //appel du fichier relationnel de la base de données

    //nom d'utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['title'])) {
        $errors['title'] = "Ce titre ne peut être vide";
    } else {
        $req = $pdo->prepare('SELECT idcategorie FROM categorie WHERE `Title`=?');
        $req->execute([$_POST['title']]);
        $category = $req->fetch();
    }

    //envoi des données dans la base de données. cryptage du mot de passe
    if (empty($errors)) {
        require_once '../../include/database.php';  //appel du fichier relationnel de la base de donnée
        $req = $pdo->prepare("UPDATE categorie  SET `Title`=? WHERE `idcategorie`=?");
        $title = htmlspecialchars($_POST['title']);
        $req->execute([$title, $category_id]);
        $_SESSION['flash']['success'] = 'Votre categorie a bien été modifiée';
        header('Location: ../dashboardCategory.php');
        exit();
    }
}