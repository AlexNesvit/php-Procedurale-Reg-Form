<?php
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once '../include/database.php';

// Préparer la requête pour sélectionner tous les produits
$req = $pdo->prepare('SELECT * FROM goods');

// Exécuter la requête
$req->execute();

// Récupérer tous les résultats sous forme de tableau associatif
$produits = $req->fetchAll();
