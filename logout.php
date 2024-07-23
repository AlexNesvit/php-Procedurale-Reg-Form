<?php
// Ce fichier est destiné à terminer la session de l'utilisateur et à vider son panier

// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require 'include/database.php';

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['auth'])) {
    // Si l'utilisateur n'est pas authentifié, le rediriger vers la page de connexion
    header('Location: login.php');
    exit;
}

// Récupérer l'ID de l'utilisateur depuis la session
$user_id = $_SESSION['auth']->id;

// Supprimer tous les enregistrements de la table basket_has_goods associés à l'utilisateur
$req = $pdo->prepare('DELETE bhg FROM basket_has_goods bhg
                      JOIN basket b ON bhg.basket_id = b.id
                      WHERE b.user_id = :user_id AND b.isPaid = FALSE');
$req->bindParam(':user_id', $user_id);
$req->execute();

// Supprimer tous les paniers de l'utilisateur qui ne sont pas payés
$req = $pdo->prepare('DELETE FROM basket WHERE user_id = :user_id AND isPaid = FALSE');
$req->bindParam(':user_id', $user_id);
$req->execute();

// Détruire toutes les données de la session
$_SESSION = [];
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header('Location: login.php');
exit;