<?php
session_start();
require_once '../../include/database.php';
$produit_id = $_GET['id'];
$reqProduit = $pdo->prepare('SELECT * FROM goods WHERE id = ?');
$reqProduit->execute([$produit_id]);
$produit = $reqProduit->fetch();

if (isset($_POST['validate'])) {

    $errors = array();
    require_once '../../include/database.php'; //appel du fichier relationnel de la base de données

if (empty($errors)) {
    require_once '../../include/database.php';  //appel du fichier relationnel de la base de donnée
    $req = $pdo->prepare("UPDATE goods  SET `name` = ?, `price` = ?, `image` = ? WHERE `id` = ?");
    $req->execute([$name, $price, $image, $id]);
    $_SESSION['flash']['success'] = 'Votre produit a bien été modifiée';
    header('Location: ../dashboardProduit.php');
    exit();
    } else {
        $_SESSION['flash']['errors'] = $errors;
    }
}

// affichage des errors
if (!empty($errors)) {
    $_SESSION['flash']['errors'] = $errors;
    header("Location: ../modifierProduit.php?id=$produit_id");
    exit();
}
