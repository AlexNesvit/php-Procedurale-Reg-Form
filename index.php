<?php 

session_start();
require "include/database.php"; 

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

    //$stmt = $pdo->prepare("SELECT * FROM goods");
	//$stmt->execute();
	//$result = $stmt->fetchAll();
	$result = $pdo->prepare("SELECT * FROM goods");

    $products = array();

    while ($productInfo = $result->fetch()) {
        $products[] = $productInfo;
    }


	include 'online_store.php';
} else {
	include 'timer.php';
}
