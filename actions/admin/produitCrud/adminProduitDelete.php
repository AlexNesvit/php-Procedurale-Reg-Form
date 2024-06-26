<?php
session_start();
include ('../../../include/database.php');
$produit_id = $_GET['id'];

$pdo->prepare('DELETE FROM goods WHERE id = ?')->execute([$produit_id]);
$_SESSION['flash']['danger'] = "Le produit a bien été supprimée";
header('Location: ../../../vueDashboard/dashboardProduit.php');
exit();