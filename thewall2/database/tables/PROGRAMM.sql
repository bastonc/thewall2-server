-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 01 2019 г., 17:50
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
-- Структура таблицы `PROGRAMM`
--

CREATE TABLE `PROGRAMM` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tokenparrentuser` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `repeat` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `scoreDefault` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `scoreFinal` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_manager` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_at` timestamp NULL DEFAULT NULL,
  `finish_at` timestamp NULL DEFAULT NULL,
  `start_for_page` timestamp NULL DEFAULT NULL,
  `finish_for_page` timestamp NULL DEFAULT NULL,
  `cordinatex` int(5) DEFAULT NULL,
  `cordinatey` int(5) DEFAULT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `method_recieve` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `PROGRAMM`
--

INSERT INTO `PROGRAMM` (`id`, `name`, `token`, `tokenparrentuser`, `repeat`, `scoreDefault`, `scoreFinal`, `image`, `description`, `status`, `email_manager`, `start_at`, `finish_at`, `start_for_page`, `finish_for_page`, `cordinatex`, `cordinatey`, `color`, `method_recieve`) VALUES
(71, 'Знайомство с функціоналом', '86968841e8c9365c6e6893be64cb3d96', '86968841e8c9365c6e6893be64cb3d96', '1', '1', '40', '\\image\\rm110raem.jpg', 'Це спеціальна програма, за допомогою якої познайомтесь з функціоналом порталу.\r\nВикористовуйте позивний DL1BCL для того щоб подивитись результат виконання дипломної програми. \r\nДоречі, ця система не веде жодних логів, та не записуємо Ващі Email до бази. \r\nВикористовуйте позивний DL7LDT якщо треба подивитись на проміжковий результат.\r\nВикористовуйте будь який позивний, щоб подивітись коли нічого не знайдено (hi-hi).\r\n\r\nЗареєструйтесь як дипломний менеджер, створіть свою дипломну програму, та завантажуйте  Log\'s.\r\n\r\nКожна СПС може самостійно та безпечно завантажувати свої Log\'s!\r\n\r\n', 'open', 'bastonsv@gmail.com', '2019-02-28 15:36:17', NULL, '2018-12-06 11:36:00', '2018-12-22 11:36:00', 0, 0, NULL, 1),
(73, 'А це ще одна тестова дипломна програма', '5a323e8d71d84a701d9b02a3daf2d932', 'ee917359f9d889369bb6e2722f6eb426', '1', '1', '40', '\\image\\ur4mjk.jpg', 'Опис програми буде відображатись на головній сторінці. Тут можна привести опис дипломної програми. \r\nНадалі, планую додати редактор, щоб можна було форматувати опис програми. Та внести декілька правок, що до юзабіліті сайту. Але це все дрібниці, найголовніше було для мене виконати логику, та навчитись програмувати) у межах моделі MVC', 'open', 'bastonsv@gmail.com', '2018-12-02 17:13:00', NULL, '2018-12-13 15:07:00', '2018-12-29 15:07:00', 46, 193, 'white', 1),
(97, 'Тест : : Лонгрид. Как выглядит диплом с длинным описанием', 'c975d9b2f3ac367396b52310d638f2c3', '86968841e8c9365c6e6893be64cb3d96', '1', '2', '60', '\\image\\73.jpg', 'УВАГА! Зображення взято для прикладу. Зображення є власністю  Обособленного підразділу ГС ВРЛ Мелітопольский радіоклуб\r\n\r\nДалі наведен примірник текста. Так буде виглядати сторінка дипломної сторінки, що має велику кількість тексту.\r\n\r\nвидається Мелітопольським радіоклубом \"73!\" та присвячений визволенню міста Мелітополя Запорізької області від німецько-фашистських загарбників під час Другої світової війни.\r\n\r\nДиплом видається за радіозв’язки з радіоаматорами міста Мелітополя та Запорізької області у період з 10 по 28 жовтня 2018р. включно, на всіх радіоаматорських діапазонах різними видами радіозв’язку (телефон, телеграф, цифрові види зв’язку).\r\nДля отримання диплома необхідно набрати 75 очок.\r\nРадіозв’язки зі спеціальною радіостанцією EM75QM та з радіостанцією US4QWA/p, яка буде працювати з місця штурму німецької лінії оборони «Вотан» поруч з містом Мелітополем, дають 20 очок. Фрагмент штурму цієї лінії оборони зображений на діорамі в Мелітопольському міському музеї і є основою дизайну диплома.\r\nРадіозв’язки з членами Мелітопольського радіоклубу \"73!\" дають 10 очок.\r\nРадіозв’язки з радіоаматорами Запорізької області дають 5 очок.\r\nПовторні радіозв’язки зараховуються на різних діапазонах, а на одному диапазоні -  різними видами випромінювання.\r\nРадіоаматори Запорізької області отримують диплом автоматично, якщо їх позивний буде наведено не менш ніж у 10 заявах здобувачів або на підставі їх заяви на загальних умовах.\r\nРадіоспостерегачам диплом видається на загальних умовах.\r\nДиплом видається на підставі заяви здобувача тільки в електронному форматі та висилається на електронну адресу, вказану у заяві на диплом.\r\nДля радіоаматорів Запорізької області можлива видача дипломів в паперовому форматі.\r\nЗаявка на диплом висилається не пізніше 30 листопада 2018 року на електронну адресу дипломного менеджера UR5QBB:ur5qbb@gmail.com\r\n\r\nСписок членів Мелітопольського радіоклубу \"73!\":\r\nUR3QAY, UR3QBM, UR3QCJ, UR3QDB, UR3QEC, UR3QFB, UR3QFH, UR3QFN, UR3QL, UR4QGG, UR4QIX, UR4QJE, UR4QJW, UR4QLD, UR4QMH, UR4QNJ, UR4QNP, UR4QOL, UR4QOM, UR4QTO, UR4QUD, UR4QUE, UR5QBB, UR5QFJ, UR5QFM, UR5QKL, UR5QLX, UR5QPI, UR5QPJ, UR5QQI, UR6QC, UR6QE, UR6QG, UR7QJ, UR7QM, UR7QU, UR7QV, UR8QA, UR8QD, UR8QL, UR8QMK, UR8QMM, UR8QU, UR8QY, UR8QZ, UR9QT, US1QA, US3QM, US3QQ, US3QZ, US5QCD, US5QK, US5QPL, US5QTS, US7QQ, US7QY, UT1QK, UT1QM, UV5QA, UV5QAS, UV5QAW, UV5QAX, UV5QAZ, UV5QBA, UV5QF, UV5QH, UV5QI, UV5QL, UV5QP, UV5QQ, UV5QR, UV5QS, UV5QU, UV5QY, UV5QZ, UV6QA, UV6QAB, UV6QAE, UV6QAG, UV6QAN, UV6QAW, UV7QA, UV7QAE, UV7QAI, UV7QAL, UV7QAM, UV7QAS, UV7QAT, UV7QAU, UV7QAV, UV7QD, UV7QG, UV7QK, UV7QMN, UV7QO, UV7QQ, UY7QY,UY8QQ\r\n\r\n\r\n', 'open', 'bastonsv@gmail.com', '2018-12-08 15:59:19', NULL, '2018-12-15 17:50:00', '2018-12-16 17:50:00', 572, 387, 'white', 1),
(103, '90 Років Харківській секції коротких хвиль', '5c1b671ffb6c41d1ca158c74074b3218', 'ee917359f9d889369bb6e2722f6eb426', '1', '1', '20', '\\image\\Diplom90-2.jpg', 'Опис програми буде відображатись на головній сторінці. \r\nЦей опис є лише примірником того ща саме тут буде розмущуватися текст опису диполомної програми 90 Років Харківскій секції коротких хвиль', 'open', 'bastonsv@gmail.com', '2018-12-22 13:26:48', NULL, '2018-12-02 17:04:00', '2018-12-06 17:04:00', 424, 1375, 'black', 1),
(130, 'ewe', 'd5fce2360545b076ed27cb4dcc03641f', 'a2b33e2853d189cb7eb0a952ba73e92d', '1', '1', '20', 'NONE', 'Опис програми буде відображатись на головній сторінці', 'new', 'bastonsv@gmail.com', NULL, NULL, '2018-12-01 20:44:00', '2018-12-21 17:08:00', NULL, NULL, NULL, 1),
(131, 'ewe1', '7dde4775e8f123d7189ed31d220f87c1', 'a2b33e2853d189cb7eb0a952ba73e92d', '1', '1', '20', 'NONE', 'Опис програми буде відображатись на головній сторінці', 'new', 'bastonsv@gmail.com', NULL, NULL, '2018-12-01 20:44:00', '2018-12-21 17:08:00', NULL, NULL, NULL, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `PROGRAMM`
--
ALTER TABLE `PROGRAMM`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `PROGRAMM`
--
ALTER TABLE `PROGRAMM`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
