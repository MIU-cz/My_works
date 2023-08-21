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
-- Структура таблицы `Rooms`
--

CREATE TABLE `Rooms` (
  `id` int NOT NULL,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `photo4` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `room` varchar(50) NOT NULL,
  `booking` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Rooms`
--

INSERT INTO `Rooms` (`id`, `photo1`, `photo2`, `photo3`, `photo4`, `name`, `description`, `room`, `booking`) VALUES
(2, './src/img/rooms/room-1.jpeg', './src/img/rooms/room-3.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-9.jpeg', 'Luxovy pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Luxus', 0),
(3, './src/img/rooms/room-4.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', '3k pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Tri', 0),
(4, './src/img/rooms/room-3.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-12.jpeg', '1k pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Jeden', 0),
(5, './src/img/rooms/room-1.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-10.jpeg', './src/img/rooms/room-7.jpeg', '2k', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Dva', 0),
(6, './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-3.jpeg', './src/img/rooms/room-11.jpeg', 'studio', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Studio', 0),
(7, './src/img/rooms/room-10.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-12.jpeg', 'skvely pokoj #1', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse.\r\nHic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Tri', 0),
(9, './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-3.jpeg', './src/img/rooms/room-11.jpeg', 'studio', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Studio', 0),
(10, './src/img/rooms/room-4.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', '3k pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Tri', 0),
(11, './src/img/rooms/room-10.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-12.jpeg', 'skvely pokoj #1', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse.\r\nHic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Tri', 0),
(12, './src/img/rooms/room-1.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-10.jpeg', './src/img/rooms/room-7.jpeg', '2k', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Dva', 0),
(13, './src/img/rooms/room-1.jpeg', './src/img/rooms/room-3.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-9.jpeg', 'Luxovy pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Luxus', 0),
(14, './src/img/rooms/room-4.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', '3k pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Tri', 0),
(15, './src/img/rooms/room-1.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-10.jpeg', './src/img/rooms/room-7.jpeg', '2k', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Dva', 0),
(16, './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-3.jpeg', './src/img/rooms/room-11.jpeg', 'studio', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Studio', 0),
(17, './src/img/rooms/room-10.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-12.jpeg', 'skvely pokoj #1', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse.\r\nHic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Tri', 0),
(18, './src/img/rooms/room-1.jpeg', './src/img/rooms/room-3.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-9.jpeg', 'Luxovy pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Luxus', 0),
(19, './src/img/rooms/room-3.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-12.jpeg', '1k pokoj', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Jeden', 0),
(20, './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-3.jpeg', './src/img/rooms/room-11.jpeg', 'studio', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Studio', 0),
(22, './src/img/rooms/room-1.jpeg', './src/img/rooms/room-2.jpeg', './src/img/rooms/room-10.jpeg', './src/img/rooms/room-7.jpeg', '2k', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse. Hic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Dva', 0),
(23, './src/img/rooms/room-10.jpeg', './src/img/rooms/room-5.jpeg', './src/img/rooms/room-6.jpeg', './src/img/rooms/room-12.jpeg', 'skvely pokoj #1', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere rerum reprehenderit in saepe? Aut quia laudantium quidem, excepturi odit possimus, ducimus nobis deserunt aliquam, reiciendis officia at! Possimus, consectetur esse.\r\nHic facere fugiat nulla sapiente accusantium magni iusto, ad pariatur nihil id voluptates veniam est perferendis, culpa quaerat cumque numquam eum quam molestias dicta vitae explicabo? Laboriosam minus quos quisquam.', 'Tri', 0),
(24, './src/img/rooms/room-4.jpeg', './src/img/rooms/room-12.jpeg', './src/img/rooms/room-11.jpeg', './src/img/rooms/room-6.jpeg', 'ssssssssss', 'sssssssssssssssssss\r\nsssssssssssssssssssssss\r\nssssssssssssssssss\r\nsssssssss\r\nsssssssssssssssssssssssss\r\nsssssssssssssssssssssssssssssssssss', 'Studio', NULL),
(27, './src/img/rooms/room-4.jpeg', './src/img/rooms/room-12.jpeg', './src/img/rooms/room-11.jpeg', './src/img/rooms/room-6.jpeg', 'ssssssssss', 'sssssssssssssssssss\r\nsssssssssssssssssssssss\r\nssssssssssssssssss\r\nsssssssss\r\nsssssssssssssssssssssssss\r\nsssssssssssssssssssssssssssssssssss', 'Studio', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Rooms`
--
ALTER TABLE `Rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Rooms`
--
ALTER TABLE `Rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
