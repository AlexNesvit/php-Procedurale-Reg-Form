<?php require_once '../../include/functions.php';
session_start();

if (isset($_POST['validate'])) {

    $errors = array();
    require_once '../../include/database.php'; //appel du fichier relationnel de la base de données

    //nom d'utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['goods'])) {
        $errors['goods'] = "Ce titre ne peut être vide";
    } else {
        $req = $pdo->prepare('SELECT id FROM goods WHERE `name`=?');
        $req->execute([$_POST['title']]);
        $produit = $req->fetch();
    }

    //envoi des données dans la base de données. cryptage du mot de passe
    if (empty($errors)) {
        require_once '../../include/database.php';  //appel du fichier relationnel de la base de donnée
        $req = $pdo->prepare("INSERT INTO goods SET `Title`=?, `user_iduser` = ?");
        $title = htmlspecialchars($_POST['title']);
        $user_id = $_SESSION['auth']->id;
        $req->execute([$title, $user_id]);
        $_SESSION['flash']['success'] = 'Votre produit a bien été créé';
        header('Location: ../dashboardProduit.php');
        exit();
    }
}

