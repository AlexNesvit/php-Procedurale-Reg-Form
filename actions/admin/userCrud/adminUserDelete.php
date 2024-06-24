<?php
session_start();
include ('../../../include/database.php');
$user_id = $_GET['id'];

$pdo->prepare('DELETE FROM users WHERE id = ?')->execute([$user_id]);
$_SESSION['flash']['success'] = "Le compte a bien été supprimé";
header('Location: ../../../vueDashboard/dashboardUser.php');
exit();