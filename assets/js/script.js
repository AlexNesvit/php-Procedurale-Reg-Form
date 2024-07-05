document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuButton = document.getElementById('mobileMenuOpenButton');
    const closeMenuButton = document.getElementById('closeMobileMenu');
    const menu = document.getElementById('menu');
    const overlay = document.querySelector('.js_overlay');
    const popup = document.querySelector('.popup');
    const buyButtons = document.querySelectorAll('.js_buy');
    const closePopupButton = document.querySelector('.js_close-popup');

    // Открытие мобильного меню
    mobileMenuButton.addEventListener('click', function () {
        menu.classList.add('d-flex');
        menu.classList.remove('d-none');
    });

    // Закрытие мобильного меню
    closeMenuButton.addEventListener('click', function () {
        menu.classList.remove('d-flex');
        menu.classList.add('d-none');
    });

    // Показать попап при нажатии на "Acheter"
    buyButtons.forEach(button => {
        button.addEventListener('click', function () {
            overlay.style.display = 'block';
            popup.style.display = 'block';
        });
    });

    // Закрыть попап
    closePopupButton.addEventListener('click', function () {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });

    // Закрыть попап при нажатии на overlay
    overlay.addEventListener('click', function () {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });
});

//Timer
document.addEventListener("DOMContentLoaded", function () {

    // Элементы для отображения времени
    const daysElement = document.querySelector(".days");
    const hoursElement = document.querySelector(".hours");
    const minutesElement = document.querySelector(".minutes");
    const secondsElement = document.querySelector(".seconds");

    function updateTimer() {
        // Текущая дата и время
        const now = new Date();

        // Дата и время Нового года
        const newYear = new Date(now.getFullYear() + 1, 0, 1);

        // Разница во времени в миллисекундах
        const timeRemaining = newYear - now;

        // Переводим миллисекунды в дни, часы, минуты и секунды
        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Обновляем значения на странице
        daysElement.textContent = days;
        hoursElement.textContent = hours;
        minutesElement.textContent = minutes;
        secondsElement.textContent = seconds;

        // Устанавливаем таймер для обновления значений каждую секунду
        setTimeout(updateTimer, 1000);
    }

    // Запуск таймера
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

                // Показываем модальное окно
                const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                cartModal.show();
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});


// // Ajouter au panier v2.0
// document.addEventListener('DOMContentLoaded', () => {
//     const forms = document.querySelectorAll('.js_add_to_cart');

//     forms.forEach(form => {
//         form.addEventListener('submit', (e) => {
//             e.preventDefault();

//             const formData = new FormData(form);

//             fetch('add_to_cart.php', {
//                 method: 'POST',
//                 body: formData,
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === 'error') {
//                     alert(`Erreur: ${data.message}`);
//                     return;
//                 }

//                 // Показать модальное окно с сообщением
//                 const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
//                 document.getElementById('cartModalMessage').textContent = data.message;
//                 cartModal.show();

//                 // Обновить flash сообщения на главной странице
//                 const flashContainer = document.getElementById('flashMessages');
//                 const alertDiv = document.createElement('div');
//                 alertDiv.className = 'alert alert-success';
//                 alertDiv.textContent = data.message;
//                 flashContainer.appendChild(alertDiv);

//                 // Скрыть сообщение через несколько секунд
//                 setTimeout(() => {
//                     alertDiv.remove();
//                 }, 3000);
//             })
//             .catch(error => console.error('Erreur:', error));
//         });
//     });
// });

