<!DOCTYPE html>
<html>
	<head>
		<title>Bientôt le Nouvel An!</title>
		<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Favicons -->
		<link href="assets/img/iconfav.jpg" rel="icon">
		
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    	<link href="assets/css/styles.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--<div class="vein"></div>-->
		<div class="container main timer-main">
			<span class="title">Il reste jusqu'au Nouvel An:</span>
			<div id="timer" class="timer">
				<div>
					<span class="days"></span>
					<div class="small-text">Jours</div>
				</div>
				<div>
					<span class="hours"></span>
					<div class="small-text">Heurs</div>
				</div>
				<div>
					<span class="minutes"></span>
					<div class="small-text">Minutes</div>
				</div>
				<div>
					<span class="seconds"></span>
					<div class="small-text">Secundes</div>
				</div>
			</div>
		</div>
		<script>
			const secondTo = <?=$secondTo?>;
		</script>
		<script src="assets/js/script.js"></script>
	</body>
</html>
