<?php
session_start();
include ('../../../include/database.php');
$category_id = $_GET['id'];

$pdo->prepare('DELETE FROM categorie WHERE idcategorie = ?')->execute([$category_id]);
$_SESSION['flash']['danger'] = "La catégorie a bien été supprimée";
header('Location: ../../../vueDashboard/dashboardCategory.php');
exit();