<?php
session_start();
require_once '../include/database.php';
// liste tous les utilisateurs du site
$req = $pdo->prepare('SELECT * FROM categorie');
$req->execute();
$categories = $req->fetchAll();