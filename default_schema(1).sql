-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июл 12 2024 г., 17:42
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `default_schema`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `isPaid` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `basket_has_goods`
--

CREATE TABLE `basket_has_goods` (
  `basket_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `price`, `image`) VALUES
(1, 'Couronne de Noël', '44.99 €', 'assets/img/product-1.jpg'),
(2, 'Père Noël en chocolat', '1.39 €', 'assets/img/product-2.png'),
(3, 'Sapin de Noël', '29.99 €', 'assets/img/product-3.jpg'),
(4, 'Boîte de bonbons', '14.99 €', 'assets/img/product-4.jpg'),
(5, 'Père Noël sur échelle', '24.99 €', 'assets/img/product-5.jpg'),
(6, 'Boule à Neige', '4.99 €', 'assets/img/product-6.jpg'),
(7, 'Boule de Noël', '1.99 €', 'assets/img/product-7.jpg'),
(8, 'Guirlande en tinsel', '2.99 €', 'assets/img/product-8.jpg'),
(9, 'Guirlande électrique', '7.99 €', 'assets/img/product-9.jpg'),
(10, 'Champagne de Nouvel An', '7.49 €', 'assets/img/product-10.jpg'),
(11, 'Boîte de bonbons Ferrero', '6.99 €', 'assets/img/product-11.jpg'),
(12, 'Cadeau \'Surprise\'', '19.99 €', 'assets/img/product-12.jpg'),
(13, 'Décoration Noël extérieur ', '133.59 €', 'assets/img/product-13.jpg'),
(14, 'Bonnet de Noël', '1.44 €', 'assets/img/product-14.jpg'),
(15, 'Feux de Bengale', '2.99 €', 'assets/img/product-15.jpg'),
(16, 'Cracker', '0.89 €', 'assets/img/product-16.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `city` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `basket_has_goods`
--
ALTER TABLE `basket_has_goods`
  ADD PRIMARY KEY (`basket_id`,`goods_id`),
  ADD KEY `fk_basket_has_goods_goods1_idx` (`goods_id`),
  ADD KEY `fk_basket_has_goods_basket1_idx` (`basket_id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `basket_has_goods`
--
ALTER TABLE `basket_has_goods`
  ADD CONSTRAINT `fk_basket_has_goods_basket1` FOREIGN KEY (`basket_id`) REFERENCES `basket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_basket_has_goods_goods1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
