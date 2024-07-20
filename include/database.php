<?php
// Connexion à la base de données

// Crée une instance de la classe PDO pour se connecter à la base de données MySQL
$pdo = new PDO('mysql:dbname=default_schema;host=localhost', 'root', 'root');

// Configure PDO pour générer des exceptions en cas d'erreurs SQL
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

// Configure PDO pour récupérer les résultats des requêtes sous forme d'objets
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
