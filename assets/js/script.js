document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuButton = document.getElementById('mobileMenuOpenButton');
    const closeMenuButton = document.getElementById('closeMobileMenu');
    const menu = document.getElementById('menu');
    const overlay = document.querySelector('.js_overlay');
    const popup = document.querySelector('.popup');
    const buyButtons = document.querySelectorAll('.js_buy');
    const closePopupButton = document.querySelector('.js_close-popup');

    // Ouverture du menu mobile
    if(mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function () {
            menu.classList.add('d-flex');
            menu.classList.remove('d-none');
        });
    }

    // Fermeture du menu mobile
    if (closeMenuButton) {
        closeMenuButton.addEventListener('click', function () {
            menu.classList.remove('d-flex');
            menu.classList.add('d-none');
        });
    }
});

// Timer
document.addEventListener("DOMContentLoaded", function () {

    // Éléments pour l'affichage du temps
    const daysElement = document.querySelector(".days");
    const hoursElement = document.querySelector(".hours");
    const minutesElement = document.querySelector(".minutes");
    const secondsElement = document.querySelector(".seconds");

    function updateTimer() {
        // Date et heure actuelles
        const now = new Date();

        // Date et heure du Nouvel An
        const newYear = new Date(now.getFullYear() + 1, 0, 1);

        // Différence de temps en millisecondes
        const timeRemaining = newYear - now;

        // Convertir les millisecondes en jours, heures, minutes et secondes
        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Mettre à jour les valeurs sur la page
        if (daysElement) {
            daysElement.textContent = days;
        }
        if (hoursElement) {
            hoursElement.textContent = hours;
        }
        if (minutesElement) {
            minutesElement.textContent = minutes;
        }
        if (secondsElement) {
            secondsElement.textContent = seconds;
        }

        // Définir le minuteur pour mettre à jour les valeurs chaque seconde
        setTimeout(updateTimer, 1000);
    }

    // Lancement du minuteur
    updateTimer();
});

// Ajouter au panier
document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.js_add_to_cart');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(form);

            fetch('cart/add_to_cart.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.text())
            .then(response => {
                if (response === 'Données manquantes') {
                    alert('Erreur: données manquantes');
                    return;
                }
                console.log(response);
                // Afficher la fenêtre modale
                const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                cartModal.show();
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});

// Animation neige
document.addEventListener('DOMContentLoaded', function () {
    const body = document.querySelector('body');

    // Tableau de symboles de flocons de neige
    const snowflakeSymbols = ['❅', '❆'];

    // Fonction pour créer un élément flocon de neige
    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');
        snowflake.style.left = `${Math.random() * 100}vw`;
        snowflake.style.animationDuration = `${Math.random() * 5 + 15}s`; // Augmenter la durée de l'animation
        snowflake.textContent = snowflakeSymbols[Math.floor(Math.random() * snowflakeSymbols.length)];
        body.appendChild(snowflake);

        // Supprimer le flocon de neige après sa chute
        setTimeout(() => {
            snowflake.remove();
        }, 15000); // Augmenter le temps de suppression du flocon de neige
    }

    // Créer des flocons de neige toutes les 3000ms
    setInterval(createSnowflake, 3000); // Augmenter l'intervalle de création des flocons de neige
});
