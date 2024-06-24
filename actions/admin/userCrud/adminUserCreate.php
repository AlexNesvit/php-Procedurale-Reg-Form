<?php require_once '../../include/functions.php';
session_start();

if (isset($_POST['validate'])) {

    $errors = array();
    require_once '../../include/database.php'; //appel du fichier relationnel de la base de données

    //nom d'utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['name']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['name'])) {
        $errors['name'] = "Votre nom n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE `name`=?');
        $req->execute([$_POST['name']]);
        $user = $req->fetch();
    }

    //nom d'utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre pseudo n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username=?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
    }

    //email conditions et implémentation dans la base de données
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "votre email n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE email=?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            $errors['email'] = 'Cet e-mail existe déjà';
        };
    }

    //téléphone conditions et implémentation dans la base de données
    if (empty($_POST['phone']) || !preg_match('/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', $_POST['phone'])) {
        $errors['phone'] = "votre téléphone n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE `phone`=?');
        $req->execute([$_POST['phone']]);
        $user = $req->fetch();
        if ($user) {
            $errors['phone'] = 'Ce téléphone existe déjà';
        };
    }
    //adresse utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['address'])) {
        $errors['address'] = "Votre adresse n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE address=?');
        $req->execute([$_POST['address']]);
        $user = $req->fetch();
    }

    //code postal utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['zipcode']) || !preg_match('/^\\d{5}$/', $_POST['zipcode'])) {
        $errors['zipcode'] = "Votre code postal n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE zipcode=?');
        $req->execute([$_POST['zipcode']]);
        $user = $req->fetch();
    }

    //ville utilisateur conditions et implémentation dans la base de données
    if (empty($_POST['city'])) {
        $errors['city'] = "Votre ville n'est pas valide";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE city=?');
        $req->execute([$_POST['city']]);
        $user = $req->fetch();
    }

    //mot de passe conditions et implémentation dans la base de données
    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Vous devez rentrer un mot de passe valide";
    }

    //envoi des données dans la base de données. cryptage du mot de passe
    if (empty($errors)) {
        require_once '../../include/database.php';  //appel du fichier relationnel de la base de donnée
        $req = $pdo->prepare("INSERT INTO users  SET `name`=?, username=? , phone=?, email=?, address=?, zipcode=?, city=?, `password`=?, `role`=?");
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = htmlspecialchars($_POST['name']);
        $username = htmlspecialchars($_POST['username']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $zipcode = htmlspecialchars($_POST['zipcode']);
        $city = htmlspecialchars($_POST['city']);
        $role = 0;
        $req->execute([$name, $username, $phone, $_POST['email'], $address, $zipcode, $city, $password, $role]);
        $_SESSION['flash']['success'] = 'Votre compte a bien été créé';
        header('Location: ../dashboardUser.php');
        exit();
    }
}
