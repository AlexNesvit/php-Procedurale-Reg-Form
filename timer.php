<!-- Conteneur principal du timer -->
<div class="timer-container">
    <div class="timer-main">
        <!-- Titre du timer -->
        <span class="title">Il reste jusqu'au Nouvel An:</span>
        
        <!-- Conteneur du timer -->
        <div id="timer" class="timer">
            <!-- Affichage des jours restants -->
            <div>
                <span class="days"></span>
                <div class="small-text">Jours</div>
            </div>
            <!-- Affichage des heures restantes -->
            <div>
                <span class="hours"></span>
                <div class="small-text">Heures</div>
            </div>
            <!-- Affichage des minutes restantes -->
            <div>
                <span class="minutes"></span>
                <div class="small-text">Minutes</div>
            </div>
            <!-- Affichage des secondes restantes -->
            <div>
                <span class="seconds"></span>
                <div class="small-text">Secondes</div>
            </div>
        </div>
    </div>
</div>
<script>
    const secondTo = <?=$secondTo?>;
</script>
