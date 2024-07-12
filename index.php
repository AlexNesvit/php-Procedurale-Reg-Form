<?php 
session_start();


require "include/database.php"; 
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en ligne de décoration de Noël</title>
    
    <!-- Favicons -->
    <link href="assets/img/iconfav.jpg" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
		
	</div>
	<?php
function secondToDate($mounth, $day) {

	$currentDate = date('Y.m.d.H.i.s', time());
	$currentDateArray = explode('.', $currentDate);

	if ($currentDateArray[1] > $mounth || ($currentDateArray[1] == $mounth && $currentDateArray[2] > $day)) {
		$year = $currentDateArray[0] + 1;
	} elseif ($currentDateArray[1] == $mounth && $currentDateArray[2] == $day) {
		return 0;
	} else {
		$year = $currentDateArray[0];
	}

	$dateFrom = date_create($currentDateArray[0] . "-" . $currentDateArray[1] . "-" . $currentDateArray[2] . " " . $currentDateArray[3] . ":" . $currentDateArray[4] . ":" . $currentDateArray[5]);
	$dateTo = date_create($year . "-" . $mounth . "-" . $day);

	$diff = date_diff($dateTo, $dateFrom);

	return  ($diff->y * 365 * 24 * 60 * 60) +
			($diff->m * 30 * 24 * 60 * 60) +
			($diff->d * 24 * 60 * 60) +
			($diff->h * 60 * 60) +
			($diff->i * 60) +
			$diff->s;
}

$secondTo = secondToDate(12, 24);

$currentDate = date('m.d', time());
$currentDateArray = explode('.', $currentDate);

$currentMounth = $currentDateArray[0];
$currentDay = $currentDateArray[1];


$currentMounth = 12; // decommenter pour la test
$currentDay = 24; // decommenter pour la test


if ($currentMounth == 12 && $currentDay >= 24) {

	$result = $pdo->prepare("SELECT * FROM goods");
	$result->execute();
	
    $products = array();
	
    while ($productInfo = $result->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $productInfo;
    }

	include 'online_store.php';
} else {
	include 'timer.php';
}
	?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
