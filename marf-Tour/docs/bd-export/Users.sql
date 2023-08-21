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
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Admin', 'admin@adminovich.marf', 'admin', 'admin'),
(6, 'Igor', 'Mehal@post.cz', 'aaasssddd', 'user'),
(9, 'test', 'rtwer@fdgsh', 'fffgg', 'user'),
(10, 'User Userovich', 'uer@userovich.usr', 'ddsadgaf', 'user'),
(16, 'test user', 'user@test', '', 'user'),
(17, 'test user', 'user@test', '', 'user'),
(18, 'test user', 'user@test', '', 'user'),
(19, 'test user', 'user@test', '', 'user'),
(20, 'test user', 'user@test', '', 'user'),
(21, 'aaaaaa', 'sdfasdg@dfhgfsh', '', 'user'),
(22, 'test', 'dga@ghfmjtk', '', 'user'),
(23, 'aaaaaa', 'fdssvb@jkkkk', '', 'user'),
(24, 'aaaaaa', 'sss@sss', '', 'user'),
(25, 'ss', 'sss@www', '', 'user'),
(26, 'zdfa', 'fff@rrr', '', 'user'),
(27, 'test', 'ggg@ggg', '', 'user'),
(28, 'sss', 'www@www', '', 'user'),
(29, 'qqq', '222@qqq', '', 'user'),
(30, 'sss', 'rrr@rrr', '', 'user'),
(31, 'test', 'test@user', '', 'user'),
(32, 'jjj', 'jjj@jjj', '', 'user'),
(33, '', 'sfagag@dfgdhs', '', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
