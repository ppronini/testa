-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 06 2022 г., 17:27
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
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`) VALUES
(1, 'User One', 'user.one@domain.com'),
(2, 'User Two', 'user.two@domain.com');

-- --------------------------------------------------------

--
-- Структура таблицы `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_time` datetime NOT NULL,
  `utc_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `duration` int(11) NOT NULL,
  `activity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `user_time`, `utc_time`, `duration`, `activity`) VALUES
(1, 1, '2022-04-20 12:06:24', '2020-04-20 02:06:24', 60, 100),
(2, 1, '2022-04-20 12:07:24', '2020-04-20 02:07:24', 36, 100),
(3, 1, '2022-04-21 12:08:08', '2020-04-20 02:08:08', 60, 62),
(4, 1, '2022-04-21 12:08:12', '2020-04-20 02:08:12', 60, 100),
(5, 2, '2022-04-20 12:09:08', '2020-04-20 02:09:08', 60, 100),
(6, 2, '2022-04-20 12:09:12', '2020-04-20 02:09:12', 60, 100),
(7, 2, '2022-04-20 12:10:08', '2020-04-20 02:10:08', 60, 100),
(8, 2, '2022-04-20 12:10:12', '2020-04-20 02:10:12', 60, 100),
(9, 2, '2022-04-21 12:11:08', '2020-04-20 02:11:08', 60, 100),
(10, 2, '2022-04-21 12:11:12', '2020-04-20 02:11:12', 60, 100),
(12, 2, '2022-04-21 13:11:12', '2020-04-20 03:11:12', 10, 10),
(13, 1, '2022-04-21 12:08:12', '2020-04-20 02:08:12', 110, 0),
(14, 1, '2022-04-20 12:06:24', '2020-04-20 02:06:24', 5, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user_activity_cache`
--

CREATE TABLE `user_activity_cache` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `activity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_activity_cache`
--

INSERT INTO `user_activity_cache` (`id`, `user_id`, `user_date`, `duration`, `activity`) VALUES
(1, 1, '2022-04-20', 101, 203),
(2, 2, '2022-04-20', 240, 400),
(3, 1, '2022-04-21', 230, 162),
(4, 2, '2022-04-21', 130, 210);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-user_activity-user` (`user_id`);

--
-- Индексы таблицы `user_activity_cache`
--
ALTER TABLE `user_activity_cache`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`user_id`,`user_date`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `user_activity_cache`
--
ALTER TABLE `user_activity_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `fk-user_activity-user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_activity_cache`
--
ALTER TABLE `user_activity_cache`
  ADD CONSTRAINT `fk-user_activity_cache-user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
