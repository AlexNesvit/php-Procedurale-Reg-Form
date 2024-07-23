<?php 
// Démarrer la session
session_start();

// Inclure le fichier de connexion à la base de données
require "include/database.php"; 

// Récupérer le message de session s'il existe, sinon définir comme null
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;

// Supprimer le message de la session
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plongez dans la magie de Noël avec notre boutique en ligne ! 🎄🎅 Des cadeaux et décorations aux délices festifs, nous avons tout pour rendre vos fêtes inoubliables. 🌟 Livraison rapide dans tout le pays et offres spéciales pour nos clients préférés.">

    <title>Boutique en ligne de décoration de Noël</title>
    
    <!-- Favicons -->
    <link href="assets/img/iconfav.jpg" rel="icon">

    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    // Fonction pour calculer les secondes jusqu'à une date spécifique
    function secondToDate($mounth, $day) {
        // Obtenir la date actuelle
        $currentDate = date('Y.m.d.H.i.s', time());
        $currentDateArray = explode('.', $currentDate);

        // Vérifier si le mois et le jour sont passés
        if ($currentDateArray[1] > $mounth || ($currentDateArray[1] == $mounth && $currentDateArray[2] > $day)) {
            // Si la date est passée, fixer l'année à l'année prochaine
            $year = $currentDateArray[0] + 1;
        } elseif ($currentDateArray[1] == $mounth && $currentDateArray[2] == $day) {
            // Si la date est aujourd'hui, retourner 0 secondes
            return 0;
        } else {
            // Sinon, utiliser l'année actuelle
            $year = $currentDateArray[0];
        }

        // Créer des objets de date pour les calculs
        $dateFrom = date_create($currentDateArray[0] . "-" . $currentDateArray[1] . "-" . $currentDateArray[2] . " " . $currentDateArray[3] . ":" . $currentDateArray[4] . ":" . $currentDateArray[5]);
        $dateTo = date_create($year . "-" . $mounth . "-" . $day);

        // Calculer la différence entre les deux dates
        $diff = date_diff($dateTo, $dateFrom);

        // Retourner la différence en secondes
        return  ($diff->y * 365 * 24 * 60 * 60) +
                ($diff->m * 30 * 24 * 60 * 60) +
                ($diff->d * 24 * 60 * 60) +
                ($diff->h * 60 * 60) +
                ($diff->i * 60) +
                $diff->s;
    }

    // Calculer les secondes jusqu'au 24 décembre
    $secondTo = secondToDate(12, 24);

    // Obtenir le mois et le jour actuels
    $currentDate = date('m.d', time());
    $currentDateArray = explode('.', $currentDate);

    $currentMounth = $currentDateArray[0];
    $currentDay = $currentDateArray[1];

    // Pour les tests, fixer le mois et le jour au 24 décembre
     $currentMounth = 12; // décommenter pour le test
     $currentDay = 24; // décommenter pour le test

    // Vérifier si la date actuelle est le 24 décembre ou plus tard
    if ($currentMounth == 12 && $currentDay >= 24) {

        // Préparer et exécuter la requête SQL pour obtenir les produits
        $result = $pdo->prepare("SELECT * FROM goods");
        $result->execute();
        
        // Initialiser un tableau pour les produits
        $products = array();
        
        // Récupérer les informations des produits et les ajouter au tableau
        while ($productInfo = $result->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $productInfo;
        }

        // Inclure le fichier pour afficher la boutique en ligne
        include 'online_store.php';
    } else {
        // Inclure le fichier pour afficher le compte à rebours
        include 'timer.php';
    }
    ?>

    <!-- Inclure le fichier de scripts du pied de page -->
    <?php include 'include/footer_js.php'; ?>
</body>
</html>
