<?php
session_start();
//permet la moditification du mot de passe en vérifiant les différentes conditions
if (isset($_POST['validatePass'])){
    if (!empty($_POST)) {
        if ($_POST['password'] != $_POST['password_confirm']) {
            $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
        } else {
            $user_id = $_SESSION['auth']->id;
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            require_once '../include/database.php';
            $pdo->prepare('UPDATE users SET `password` =? WHERE id = ?')->execute([$password, $user_id]);
            $_SESSION['flash']['success'] = "votre mot de passe à bien été mise à jour";
        }
    }
}




if (isset($_POST['validateProfil'])) {

    $errors = array();
    require_once '../include/database.php'; //appel du fichier relationnel de la base de données
    $user_id = $_SESSION['auth']->id;

    $errors = getArr($errors);

    //envoi des données dans la base de données.
    if (empty($errors)) {
        require_once '../include/database.php';  //appel du fichier relationnel de la base de donnée
        list($req, $name, $username, $phone, $address, $zipcode, $city) = extracted($pdo, $user_id);
        $_SESSION['auth']->name = $name;
        $_SESSION['auth']->username = $username;
        $_SESSION['auth']->phone = $phone;
        $_SESSION['auth']->address = $address;
        $_SESSION['auth']->zipcode = $zipcode;
        $_SESSION['auth']->city = $city;
        $_SESSION['flash']['success'] = 'Votre compte a bien été mis à jour';
    }
}
// //permet d'afficher ma liste de dons (volontairement sans possibilité de modification)
// $user_id = $_SESSION['auth']->id;
// require_once '../include/database.php';
// $req = $pdo->prepare('SELECT `Title`, `Date`, `value` FROM don RIGHT JOIN donation ON iddon = don_iddon WHERE `donation`.`user_iduser` = ?');
// $req->execute([$user_id]);
// $allDonations = $req->fetchAll();


//permet d'effacer le compte utilisateur
if (isset($_POST['eraseAccount'])){
    require_once '../include/database.php';
    $pdo->prepare('DELETE FROM users WHERE id = ?')->execute([$user_id]);
    $_SESSION['flash']['success'] = "Votre compte a bien été supprimé";
    header('Location: register.php');
    exit();
}
