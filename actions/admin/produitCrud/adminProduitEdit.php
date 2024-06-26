<?php
session_start();
require_once '../../include/database.php';
$produit_id = $_GET['id'];
$reqProduit = $pdo->prepare('SELECT * FROM goods WHERE id = ?');
$reqProduit->execute([$produit_id]);
$produit = $reqProduit->fetch();