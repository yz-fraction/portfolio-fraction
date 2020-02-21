-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2012 at 02:36 AM
-- Server version: 5.1.40
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cat`
--

-- --------------------------------------------------------

--
-- Table structure for table `books_book`
--

CREATE TABLE IF NOT EXISTS `books_book` (
  `ID` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `books_book`
--

INSERT INTO `books_book` (`ID`, `author`, `title`) VALUES
(1, 'Бер Бибо, Иегуда Кац', 'jQuery. Подробное руководство по продвинутому JavaScript'),
(2, 'Дейв Крейн, Бер Бибо, Джордон Сонневельд', 'Ajax на практике'),
(3, 'Кристиан Дари, Богдан Бринзаре, Филип Черчез-Тоза, Михай Бусика', 'AJAX и PHP. Разработка динамических веб-приложений'),
(4, 'Джон Резиг', 'Профессиональные приёмы программирования'),
(5, 'Дэвид Флэнаган', 'Javascript. Подробное руководство'),
(6, 'Поль Дюбуа', 'MySQL'),
(7, 'Мэтта Зандстра', 'PHP Объекты, шаблоны и методики программирования'),
(8, 'Дмитрий Котеров, Алексей Костарев', 'PHP 5'),
(9, 'Леон Аткинсон, Зеев Сураски', 'PHP 5. Библиотека профессионала'),
(10, 'Эрик А. Мейер', 'Каскадные таблицы стилей. Подробное руководство'),
(11, 'Кристофер Шмитт', 'CSS. Рецепты программирования'),
(12, 'Чак Муссиано и Билл Кеннеди', 'HTML и XHTML. Подробное руководство'),
(13, 'Киссейн Эрин', 'Основы контентной стратегии'),
(14, 'Люк Вроблевски', 'Сначала мобильные!'),
(15, 'Эл Райс и Джек Траут', 'Маркетинговые войны'),
(16, 'Филипп Котлер', 'Маркетинг менеджмент'),
(17, 'Игорь Манн', 'Маркетинг на 100%. Ремикс'),
(18, 'Ролф Йенсен', 'Общество мечты'),
(19, 'Анджей Ясинский', 'Ник'),
(20, 'Вадим Панов', 'Анклавы'),
(21, 'Руслан Ароматов', 'Объектный подход'),
(22, 'Братья Стругацкие', 'Понедельник начинается в субботу');

-- --------------------------------------------------------

--
-- Table structure for table `books_rubric`
--

CREATE TABLE IF NOT EXISTS `books_rubric` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rubric` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `books_rubric`
--

INSERT INTO `books_rubric` (`ID`, `rubric`) VALUES
(1, 'jQuery'),
(2, 'AJAX'),
(3, 'Javascript'),
(4, 'MySQL'),
(5, 'PHP'),
(6, 'CSS'),
(7, 'SEO'),
(8, 'Художественное'),
(9, 'SMM');

-- --------------------------------------------------------

--
-- Table structure for table `books_rubriclink`
--

CREATE TABLE IF NOT EXISTS `books_rubriclink` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_ID` int(11) NOT NULL,
  `rubric_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `books_rubriclink`
--

INSERT INTO `books_rubriclink` (`ID`, `book_ID`, `rubric_ID`) VALUES
(111, 11, 6),
(114, 8, 5),
(110, 12, 6),
(108, 13, 7),
(107, 15, 9),
(106, 16, 9),
(47, 20, 8),
(42, 21, 8),
(135, 22, 8),
(105, 17, 9),
(112, 10, 6),
(109, 14, 7),
(104, 18, 9),
(103, 19, 8),
(113, 9, 5),
(115, 7, 5),
(116, 6, 4),
(117, 5, 3),
(118, 4, 3),
(119, 3, 2),
(120, 2, 2),
(133, 1, 1);
