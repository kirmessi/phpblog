-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Фев 01 2019 г., 12:50
-- Версия сервера: 5.7.25-0ubuntu0.18.04.2
-- Версия PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `example`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `slug`, `description`) VALUES
(1, 'Category1', 'category-one', 'Полное описание категории1'),
(5, 'Category2', 'category-two', 'Полное описание категории2');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `text` text NOT NULL,
  `visibility` tinyint(1) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `username`, `slug`, `category_id`, `name`, `description`, `text`, `visibility`, `date`) VALUES
(1, 'test', 'test', 1, 'test', 'description', 'descriptiondescriptiondescriptiondescription', 1, '2019-02-01 10:28:50'),
(2, 'test', 'karina', 5, 'Karina Mamedova', 'karinakarinakarinakarinakarina', 'karinakarinakarinakarinakarinakarina', 1, '2019-02-01 10:30:36'),
(8, 'test', 'second-post', 1, 'Кирилл', 'testtesttesttesttesttest', 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 1, '2019-02-01 10:44:51'),
(10, 'admin', 'second-post131', 5, 'Кирилл123213', 'КириллКириллКириллКириллКирилл', 'КириллКириллКириллКириллКирилл', 1, '2019-02-01 10:47:06');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_registered`) VALUES
(1, 'admin', 'kirmessi2394@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2019-02-01 12:46:48'),
(2, 'test', 'test@bk.ru', '202cb962ac59075b964b07152d234b70', '2019-02-01 12:03:47');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `category_id_2` (`category_id`),
  ADD KEY `username` (`username`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
