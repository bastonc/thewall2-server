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
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sergey', 'bastonsv@gmail.com', '$2y$10$Ex.kzL/zh9Kk7UqumgTWReTMSb2IFK.MOptL2G4rX5oLSOUtTP0ju', 'SjVxx8SZR4KPF7DbHVZyM66wLR1sNb7XAfRB2JihgYrqdJcwdUZ8upUMyd4E', '2018-08-04 17:09:14', '2019-02-28 19:12:05'),
(3, 'Сергій', 'bastonc@mail.ru', '$2y$10$RDGatG5IrUq/udud/tQwceol3cVbCU6QoH2aqUlHqshaZ92x/ZqPa', 'jEPDeCiVKIdukouffitQthhiSocabx1OtLwGJ1VJyEYNauyfMl05zIuHfvhL', '2018-11-18 18:47:57', '2019-02-28 19:06:48'),
(4, 'tanya', 'karamushko89@gmail.com', '$2y$10$W6WvBdyG26Kf5AABHjOGoenKU18j6HvuyAPD6XkbM29kuOvA0kBx6', 'BtExUFFgSbT77d5LyKWraVVXOMLC7Dr0rpY7CienypFyfa8KpQ2xTpGDHytR', '2018-11-23 17:43:03', '2018-11-25 17:48:46'),
(5, 'Сергей Бастон', 'bastonc@mail.rui', '$2y$10$wUz8oZGNYtjI8udji19HNuHZMNDNd8nppgHiKSdPSCQplLjBxfLue', '7V3qJLVH0ukLBcamWbWVUOBbPx7LyHRY9ILmwUrK0IxCUOzegxQaotlf2S3p', '2018-11-23 17:54:29', '2018-11-23 18:02:58'),
(6, 'Сержыо', 'bastonc@mail.rus', '$2y$10$K0AjEJiQV8d.rjK0j.c6VOQKgE1aStAn9uvm.Jyr325E7vSmNiXe6', 'WVzX2kYPozqhleT5ctEn2ImICZTrshSZQwTqg34yBqbg3CcQvEh2UzwHC5Nv', '2018-11-23 18:03:45', '2018-11-23 18:05:37'),
(7, 'Ihor Sokorchuk', 'ur3lcm@ukr.net', '$2y$10$nMI5cZlND/FBaJrgpC3oI.1k.C8sNJLHEbs1VO6EcFma82Qvg8Dgi', NULL, '2018-12-05 07:35:40', '2018-12-05 07:35:40'),
(8, 'ur4lga', 'ur4lga@ukr.net', '$2y$10$nbM6qEj/gILALJM6A74xTO9hMN52lL3RcHi/411GASlArd265BsXq', 'TfqdK9nDmqUhTqKlLHOmH0OozDe0tzCRKeAAAoSHtbLylnbIONbqa5u8UFL5', '2018-12-05 07:38:30', '2019-02-28 18:35:13'),
(9, 'Сергійко', 'ur4lga@ukra.net', '$2y$10$ymROPHEHf2DfCvtsJi5QEuGycu11RoNrSMFX9WE.i0yTh88nkIVnW', 'YnswPboobVjiG2FjePX3uJpPwUUHcH0UGTswNNJveQKgSMP401BS2hGucwiO', '2018-12-05 07:46:21', '2018-12-05 07:46:52'),
(10, 'Сергей', 'bastonc@gmail.com', '$2y$10$XN7M9s602RS2.DCfDCLjveapsKVRCBF/2soPcVD9oAt0Q6Kgfj9TO', 'dMtmMuWWJkLRqv1LCpnvDL5x64vRkIODgwyoMQVbdzaZntxsUw0iJDORn2I0', '2018-12-05 10:57:31', '2018-12-05 11:06:33'),
(11, 'Дмитрий', 'test@tempr.email', '$2y$10$pmluNVgHy6kH1pV57Gr8n.0XfI.3zWIII92wphN3KwFbJGkNEh89C', 'whIChnleOD0J2uqDuZIPnon5Xz9vMmiIPiEVa1BNBDYlD5vvIhviHMUgTKpX', '2018-12-05 11:15:40', '2018-12-05 11:16:40'),
(12, 'Володимир', 'us5qlj@gmail.com', '$2y$10$VRaga4v8K64yAfuzV.wTqO2Zc3PmDLTmVeR.lZCV3lMxpMdwwcY1q', NULL, '2018-12-05 13:26:50', '2018-12-05 13:26:50'),
(13, 'Sergiy', 'baa@sat.co', '$2y$10$GEu.LzPiJJakx2XGoMsmcuaF2e/wCOsyNq/FST5vYNfXB/oR3aIEK', 'IeKwTH0pJzP7sRP80SrTvZsqol2YIsGoypeK7ZdlMgn8ZVLCAjSVGLJsXKeS', '2018-12-05 16:58:35', '2018-12-05 16:59:07'),
(14, 'Сергей Бастон', 'bastonsv@gmail.re', '$2y$10$JtyxuUj.wbymkCOH6z8tG.nfJH4rTWHXDa/fFeXIHboGKGq5QvkXC', 'zSdChP9rR3zWBqmhFOErmpQ72bjzyuZJQX2SrWIUH2ReveoCk2Z63BGtls5M', '2018-12-05 16:59:32', '2018-12-05 16:59:39'),
(15, 'Сергей Бастон', 'bastonsv@gmail.coms', '$2y$10$KgZJiE6IDg4U.aQhY4S4N.2xazZdFTBQAR4Z3Caxk4sGSbVZsw4/2', NULL, '2018-12-05 19:56:22', '2018-12-05 19:56:22'),
(16, 'Sergey', 'bas@gmail.com', '$2y$10$jbZG5K8nnVB3LxCQGXizCOSIOpX3Ml4LNuhiKTRapstQOk89FXwH2', NULL, '2018-12-12 18:00:09', '2018-12-12 18:00:09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
