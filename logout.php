<?php
session_start();

unset($_SESSION['auth']);
session_destroy();

$_SESSION['flash']['success'] = 'Vous êtes bien déconnecté';

header('Location: login.php');