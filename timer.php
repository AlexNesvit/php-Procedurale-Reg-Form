<body class="online-container">
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
                <div class="small-text">Heures</div>
            </div>
            <div>
                <span class="minutes"></span>
                <div class="small-text">Minutes</div>
            </div>
            <div>
                <span class="seconds"></span>
                <div class="small-text">Secondes</div>
            </div>
        </div>
    </div>
    <script>
        const secondTo = <?=$secondTo?>;
    </script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
