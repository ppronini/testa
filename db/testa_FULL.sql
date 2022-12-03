-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 23 2022 г., 08:41
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testa`
--

-- --------------------------------------------------------

--
-- Структура таблицы `editjournal`
--

CREATE TABLE `editjournal` (
  `id` int(11) NOT NULL,
  `user` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objcode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jnameold` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jdescrold` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `editjournal`
--

INSERT INTO `editjournal` (`id`, `user`, `objcode`, `jnameold`, `jdescrold`, `date`) VALUES
(2, 'ppronin@gmail.com', 'raoih100', '112q1', 'qqq1', '2022-11-23 13:21:40'),
(3, 'ppronin@gmail.com', 'raoih100', '112q1', 'qqq11', '2022-11-23 13:21:44'),
(4, 'ppronin@gmail.com', 'dqtta176', 'Тестовый 1', 'Описание тестовый 1', '2022-11-23 13:24:07'),
(5, 'ppronin@gmail.com', 'kwocv240', 'Тест 2', '2222 урааа', '2022-11-23 13:32:13'),
(6, 'ppronin@gmail.com', 'kwocv240', 'Тест 2', '2222 урааа4', '2022-11-23 13:38:05');

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descr` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'root',
  `haschild` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ok',
  `statusby` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusdate` datetime DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `level`, `name`, `descr`, `code`, `parent`, `haschild`, `status`, `statusby`, `statusdate`, `date`) VALUES
(1, 1, '11', '11q', 'xgusF231', 'root', 'yes', 'ok', '', NULL, '2022-11-23 11:36:22'),
(2, 1, '111', '111q', 'RJDZN114', 'root', 'no', 'deleted', 'ppronin@gmail.com', '2022-11-23 12:51:07', '2022-11-23 11:36:26'),
(3, 2, '112', '112q', 'DfDGk19', 'xgusF231', 'yes', 'ok', '', NULL, '2022-11-23 11:36:41'),
(4, 3, '1123', '1123q', 'sDivG147', 'DfDGk19', 'yes', 'ok', '', NULL, '2022-11-23 11:37:20'),
(5, 4, '1124', '1124q', 'ZHzIq18', 'sDivG147', 'no', 'ok', '', NULL, '2022-11-23 11:38:58'),
(6, 2, '1112', '1112q', 'Zjty42', 'RJDZN114', 'no', 'deleted', 'ppronin@gmail.com', '2022-11-23 12:51:07', '2022-11-23 11:39:22'),
(7, 3, '11123', '11123q', 'n6Pxp4', 'Zjty42', 'no', 'deleted', 'ppronin@gmail.com', '2022-11-23 12:51:07', '2022-11-23 11:39:39'),
(8, 2, '112q', 'qqq', 'GFNiG78', 'xgusF231', 'yes', 'ok', '', NULL, '2022-11-23 13:00:32'),
(9, 2, '112w', 'www', 'i5w1369', 'xgusF231', 'no', 'ok', '', NULL, '2022-11-23 13:00:58'),
(10, 3, '112q1w', 'qqq11', 'raoih100', 'GFNiG78', 'no', 'ok', '', NULL, '2022-11-23 13:21:34'),
(11, 1, 'Тест 0', 'Тестовый ноль', 'llojy165', 'root', 'yes', 'ok', '', NULL, '2022-11-23 13:23:21'),
(12, 2, 'Тестовый 1', 'Описание тестовый 1111ффф', 'dqtta176', 'llojy165', 'no', 'deleted', 'ppronin@gmail.com', '2022-11-23 13:38:15', '2022-11-23 13:23:38'),
(13, 3, 'Тест 2', '2222 урааа422', 'kwocv240', 'dqtta176', 'no', 'deleted', 'ppronin@gmail.com', '2022-11-23 13:38:15', '2022-11-23 13:32:06'),
(14, 2, 'q1', '111q', 'uslfh5', 'llojy165', 'no', 'ok', '', NULL, '2022-11-23 13:38:26');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_pub` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `fname`, `phone`, `email`, `email_pub`, `password`, `role`, `date_create`) VALUES
(1, 'Павел', 'Пронин', '7059907777', 'ppronin@gmail.com', 'ppronin@gmail.com', '$2y$12$kQL06cJJ45WGQgk9DHngNui6B8ba2efUCrC2uyCA6o3Xr/gHGp8aW', 'admin', '2022-11-22 21:47:01'),
(2, 'Пользователь', 'Обычный', '7077777777', 'imribar@gmail.com', 'imribar@gmail.com', '$2y$12$4.prIw2Cmja9a3UQH9WdVu4jSeSONReAX/.AqIowaoCNfnBNziqSe', 'user', '2022-11-22 22:04:01'),
(3, '111', '222', '123123123', 'a@a.com', 'a@a.com', '$2y$12$25MgFtzUiZxDH..DqTOxzekq2Pzgwbchfw0d2LlAbFpwY.PPjCY8m', 'user', '2022-11-23 13:40:17');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `editjournal`
--
ALTER TABLE `editjournal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_pub` (`email_pub`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `editjournal`
--
ALTER TABLE `editjournal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
