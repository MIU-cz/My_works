-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2023 г., 16:36
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `marf-travel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Bookings`
--

CREATE TABLE `Bookings` (
  `id` int NOT NULL,
  `room_id` int NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `nights` int NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Bookings`
--

INSERT INTO `Bookings` (`id`, `room_id`, `room_name`, `start_date`, `end_date`, `nights`, `user_id`, `user_name`) VALUES
(1, 2, 'Luxovy pokoj', '2023-08-25', '2023-08-27', 2, 6, 'Igor'),
(2, 3, '3k pokoj', '2023-08-22', '2023-08-29', 7, 10, 'User Userovich'),
(3, 3, '3k pokoj', '2023-08-23', '2023-09-06', 14, 16, 'test user'),
(4, 4, '1k pokoj', '2023-08-25', '2023-09-02', 8, 21, 'aaaaaa'),
(5, 5, '2k', '2023-08-28', '2023-09-05', 8, 22, 'test'),
(6, 5, '2k', '2023-09-06', '2023-09-12', 6, 23, 'aaaaaa'),
(7, 9, 'studio', '2023-08-28', '2023-09-03', 6, 24, 'aaaaaa'),
(8, 9, 'studio', '2023-08-28', '2023-09-03', 6, 25, 'ss'),
(9, 3, '3k pokoj', '2023-08-23', '2023-08-29', 6, 26, 'zdfa'),
(10, 2, 'Luxovy pokoj', '2023-09-09', '2023-09-15', 6, 24, 'aaaaaa'),
(11, 3, '3k pokoj', '2023-09-09', '2023-09-14', 5, 24, 'aaaaaa'),
(12, 6, 'studio', '2023-09-04', '2023-09-06', 2, 24, 'aaaaaa'),
(13, 3, '3k pokoj', '2023-09-06', '2023-09-08', 2, 30, 'sss');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `Rooms` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
