-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2012 at 08:13 PM
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
-- Table structure for table `varchar300_country`
--

CREATE TABLE IF NOT EXISTS `varchar300_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ru` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `varchar300_country`
--

INSERT INTO `varchar300_country` (`id`, `ru`) VALUES
(1, 'Российская Федерация'),
(2, 'Украина');

-- --------------------------------------------------------

--
-- Table structure for table `varchar300_groups`
--

CREATE TABLE IF NOT EXISTS `varchar300_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `varchar300_groups`
--

INSERT INTO `varchar300_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `varchar300_login_attempts`
--

CREATE TABLE IF NOT EXISTS `varchar300_login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `varchar300_login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `varchar300_message`
--

CREATE TABLE IF NOT EXISTS `varchar300_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(300) NOT NULL,
  `user_id` int(2) unsigned NOT NULL,
  `tag_id` int(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `varchar300_message`
--

INSERT INTO `varchar300_message` (`id`, `date`, `message`, `user_id`, `tag_id`) VALUES
(51, '2012-08-03 18:42:33', 'Код не должен быть компактным, код должен быть читаемым. Писать надо красиво, быстро — но без фанатизма. Ибо легче 100 руб за ресурсы доплатить, чем менять switch-и на if-ы.', 1, 0),
(52, '2012-07-25 19:11:28', 'Клиенту неважно насколько красив ваш код, но ему важен результат. Качественный код нужен фирме, т.к. он надёжней и в будущем его будет легче поддерживать.', 2, 0),
(53, '2012-07-31 21:50:17', 'Программист не должен помнить все функции назубок. Его основное умение — структурирование и «разложение по полочкам». А принцип действия той или иной функции всегда можно узнать из мануалов.', 3, 0),
(54, '2012-08-03 18:42:33', 'Зачем брать чужой код, который будет перегружен спецификой проекта, под который писался и стараться подпиливать его под свои реалии, если свой код под свои задачи пишется за более чем разумное время?', 4, 0),
(60, '2012-11-07 16:50:52', 'Один из моих преподавателей говорил, что сначала ты делаешь просто и убого, затем сложно и убого. После, поднаторев, сложно и хорошо, а вершина мастерства — просто и гениально.', 1, 0),
(61, '2012-08-07 16:55:56', 'Есть два типа программистов: 1. Те, кто пишут для охрененно крупных проектов охрененно рабочие вещи. 2. Те, кто хвалится ультра-агиле-юниттестовым-красивым кодом, который пишется для проектов или своих, или которые никто не знает.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `varchar300_meta`
--

CREATE TABLE IF NOT EXISTS `varchar300_meta` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `age` int(4) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` int(2) NOT NULL,
  `socium` varchar(30) NOT NULL,
  `lng` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `varchar300_meta`
--

INSERT INTO `varchar300_meta` (`id`, `user_id`, `name`, `surname`, `sex`, `age`, `city`, `country`, `socium`, `lng`) VALUES
(52, 4, 'Людмила', 'Бойко', 0, 1986, 'Одесса', 2, 'Педагог', ''),
(51, 3, 'Ростислав', 'Вишневский', 1, 1982, 'Львов', 2, 'Инженер', ''),
(50, 2, 'Богдан', 'Лановский', 1, 1984, 'Тверь', 1, 'Инженер', ''),
(1, 1, 'Владимир', 'Полтавский', 1, 1982, 'Астрахань', 1, 'Инженер', '');

-- --------------------------------------------------------

--
-- Table structure for table `varchar300_users`
--

CREATE TABLE IF NOT EXISTS `varchar300_users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `varchar300_users`
--

INSERT INTO `varchar300_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`) VALUES
(1, '\0\0', 'Владимир Полтавский', '10193c631d3b69c114ec91c8f17705b7fcef36a6', NULL, 'vladimir@example.com', NULL, NULL, NULL, '7290ffada2d2d659ae1b92955b8c0ad358039760', 1352297215, 1352306686, 1),
(2, '\0\0', 'Богдан Лановой', 'cfdbfec36b04f0e8714c42eb6ae7ec976d170f3f', NULL, 'bogdan@example.com', NULL, NULL, NULL, NULL, 1352298484, 1352303740, 1),
(3, '\0\0', 'Ростислав Вишневский', '391392d3dc568fd8fcffb16e0ef7b433bb9a1326', NULL, 'rostislav@example.com', NULL, NULL, NULL, NULL, 1352298554, 1352304794, 1),
(4, '\0\0', 'Людмила Бойко', 'eba4b8b51a7efb2edb692d01f4b3c244c68a5006', NULL, 'lyudmila@example.com', NULL, NULL, NULL, NULL, 1352298703, 1352298703, 1);

-- --------------------------------------------------------

--
-- Table structure for table `varchar300_users_groups`
--

CREATE TABLE IF NOT EXISTS `varchar300_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `varchar300_users_groups`
--

INSERT INTO `varchar300_users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(50, 4, 2),
(49, 3, 2);
