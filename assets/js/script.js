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
//     buyButtons.forEach(button => {
//         button.addEventListener('click', function () {
//             overlay.style.display = 'block';
//             popup.style.display = 'block';
//         });
//     });

//     // Закрыть попап
//     closePopupButton.addEventListener('click', function () {
//         overlay.style.display = 'none';
//         popup.style.display = 'none';
//     });

//     // Закрыть попап при нажатии на overlay
//     overlay.addEventListener('click', function () {
//         overlay.style.display = 'none';
//         popup.style.display = 'none';
//     });
// });

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
        form.addEventListener('submit', () => {
            console.log('test');
            //e.preventDefault();

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
                // Показываем модальное окно
                const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                cartModal.show();
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});

//animation snow
document.addEventListener('DOMContentLoaded', function () {
    const body = document.querySelector('body');

    // Массив символов снежинок
    const snowflakeSymbols = ['❅', '❆'];

    // Function to create a snowflake element
    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');
        snowflake.style.left = `${Math.random() * 100}vw`;
        snowflake.style.animationDuration = `${Math.random() * 5 + 15}s`; // Увеличиваем продолжительность анимации
        snowflake.textContent = snowflakeSymbols[Math.floor(Math.random() * snowflakeSymbols.length)];
        body.appendChild(snowflake);

        // Remove snowflake after it falls
        setTimeout(() => {
            snowflake.remove();
        }, 15000); // Увеличиваем время удаления снежинки
    }

    // Create snowflakes every 800ms
    setInterval(createSnowflake, 3000); // Увеличиваем интервал создания снежинок
});




// document.addEventListener('DOMContentLoaded', function () {
//     const addToCartButtons = document.querySelectorAll('.add-to-cart');

//     addToCartButtons.forEach(button => {
//         button.addEventListener('click', function (event) {
//             event.preventDefault();
            
//             // Проверка авторизации
//             fetch('../include/is_logged_in.php')
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.status === 'success') {
//                         // Пользователь авторизован, добавляем товар в корзину
//                         addToCart(this);
//                     } else {
//                         // Пользователь не авторизован, показываем сообщение
//                         alert('Вы должны войти в систему, чтобы добавлять товары в корзину.');
//                         window.location.href = '../login.php';
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Ошибка при проверке авторизации:', error);
//                 });
//         });
//     });

//     function addToCart(button) {
//         const productId = button.dataset.productId;
//         const productName = button.dataset.productName;
//         const productPrice = button.dataset.productPrice;

//         fetch('add_to_cart.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded',
//             },
//             body: `product_id=${productId}&product_name=${encodeURIComponent(productName)}&product_price=${productPrice}`,
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === 'success') {
//                 alert('Товар добавлен в корзину!');
//             } else {
//                 alert('Ошибка при добавлении товара в корзину.');
//             }
//         })
//         .catch(error => {
//             console.error('Ошибка при добавлении товара в корзину:', error);
//         });
//     }
// });
