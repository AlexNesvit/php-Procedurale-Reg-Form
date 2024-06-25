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
