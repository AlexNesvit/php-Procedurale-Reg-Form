<?php

    if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
        require_once 'include/database.php';
        $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username)');
        $req->execute(['username' => $_POST['username']]);
        $user = $req->fetch();
        if ($user) {
            if (password_verify($_POST['password'], $user->password)) {
                session_start();
                $_SESSION['auth'] = $user;

                if($user->role == 0){
                    $_SESSION['flash']['success'] = "Vous êtes bien connecté";
                    header('Location: vueProfil/profile.php');
                }else {
                    $_SESSION['flash']['success'] = "Bienvenu Admin";
                    header('Location: dashboard.php');
                }
                exit();
            } else {
                $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect";
            }
        }
    }

