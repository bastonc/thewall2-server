-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 01 2019 г., 17:51
-- Версия сервера: 8.0.15
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `thewall2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `SPS`
--

CREATE TABLE `SPS` (
  `id` int(10) UNSIGNED NOT NULL,
  `call` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tokenparentuser` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tokenparrentprogram` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `SPS`
--

INSERT INTO `SPS` (`id`, `call`, `mode`, `token`, `tokenparentuser`, `tokenparrentprogram`, `score`, `description`, `password`, `created_at`, `updated_at`) VALUES
(39, 'UR4LGA', '', '6a0cbb471867035b82b90aaef851ee29', '86968841e8c9365c6e6893be64cb3d96', '86968841e8c9365c6e6893be64cb3d96', 20, 'description', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL),
(70, 'UR4LGA', 'SSB', '077defafe080a835c54a856ba8e32e6a', '86968841e8c9365c6e6893be64cb3d96', '86968841e8c9365c6e6893be64cb3d96', 30, 'Додан при редагувані', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL),
(71, 'UR4LGA', 'SSB', '0b32cd1d2b9a866647076987c5e2c295', 'ee917359f9d889369bb6e2722f6eb426', '5a323e8d71d84a701d9b02a3daf2d932', 20, 'Додан при редагувані', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL),
(74, 'RN6XC', 'SSB', '813ba9c9c22795ecc99645908cb88523', '86968841e8c9365c6e6893be64cb3d96', 'c975d9b2f3ac367396b52310d638f2c3', 20, 'Додан при редагувані', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL),
(75, 'UR4LGA', 'SSB', '07d88a62288c93661222e2ed1fcd6658', '86968841e8c9365c6e6893be64cb3d96', 'c975d9b2f3ac367396b52310d638f2c3', 30, 'Додан при редагувані', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL),
(77, 'UR4LGA', 'SSB', '0d0488980e0e39151bccb7238181a597', 'ee917359f9d889369bb6e2722f6eb426', '5c1b671ffb6c41d1ca158c74074b3218', 20, 'Додан при редагувані', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL),
(104, 'US5MAH', 'SSB', '0d0488980e0e39151bccb7238181a597', 'ee917359f9d889369bb6e2722f6eb426', '5c1b671ffb6c41d1ca158c74074b3218', 10, 'Додан при редагувані', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL),
(105, 'RN6XC', 'SSB', '0b32cd1d2b9a866647076987c5e2c295', 'ee917359f9d889369bb6e2722f6eb426', '5a323e8d71d84a701d9b02a3daf2d932', 40, 'Додан при редагувані', '7fa37299c335bb75c43bf9645c215b61', NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `SPS`
--
ALTER TABLE `SPS`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `SPS`
--
ALTER TABLE `SPS`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
