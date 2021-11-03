-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 30 2021 г., 14:30
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `First_name` varchar(20) DEFAULT NULL,
  `Last_name` varchar(20) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Company_name` varchar(40) DEFAULT NULL,
  `Position` varchar(40) DEFAULT NULL,
  `Mobile_Phone` varchar(20) DEFAULT NULL,
  `Home_Phone` varchar(20) DEFAULT NULL,
  `Additional_Phone` varchar(20) DEFAULT NULL,
  `del` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`ID`, `First_name`, `Last_name`, `Email`, `Company_name`, `Position`, `Mobile_Phone`, `Home_Phone`, `Additional_Phone`, `del`) VALUES
(1, 'danil21', 'sheptalin21', 'danil-sheptalin@mail.ru21', 'zimlab21', 'jun121', '88000000000121', '83830000000121', '89000000000121', 0),
(2, 'danil1', 'sheptalin1', 'danil-sheptalin@mail.ru1', 'zimlab1', 'jun1', '880000000002', '880000000002', '890000000002', 0),
(3, 'danil2', 'sheptalin2', 'danil-sheptalin@mail.ru2', 'zimlab2', 'jun2', '', '', '', 0),
(4, 'danil3', 'sheptalin3', 'danil-sheptalin@mail.ru3', 'zimlab3', 'jun3', '25252521113', '9812312321311113', '99383834741113', 0),
(5, 'danil4', 'sheptalin4', 'danil-sheptalin@mail.ru4', 'zimlab4', 'jun4', '25252524', '9812312321311114', '99383834741114', 0),
(6, 'danil5', 'sheptalin5', 'danil-sheptalin@mail.ru5', 'zimlab5', 'jun5', '2525252', '981231232131', '99383834741', 0),
(7, 'danil6', 'sheptalin6', 'danil-sheptalin@mail.ru6', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(8, 'danil', 'sheptalin', 'danil-sheptalin@mail.ru', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(9, 'danil8', 'sheptalin8', 'danil-sheptalin@mail.ru8', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(10, 'danil9', 'sheptalin9', 'danil-sheptalin@mail.ru9', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(11, 'danil10', 'sheptalin10', 'danil-sheptalin@mail.ru10', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(12, 'danil11', 'sheptalin11', 'danil-sheptalin@mail.ru11', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(13, 'danil12', 'sheptalin12', 'danil-sheptalin@mail.ru12', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(14, 'danil13', 'sheptalin13', 'danil-sheptalin@mail.ru13', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(15, 'danil14', 'sheptalin14', 'danil-sheptalin@mail.ru14', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(16, 'danil15', 'sheptalin15', 'danil-sheptalin@mail.ru15', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(17, 'danil16', 'sheptalin16', 'danil-sheptalin@mail.ru16', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(18, 'danil17', 'sheptalin17', 'danil-sheptalin@mail.ru17', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(19, 'danil18', 'sheptalin18', 'danil-sheptalin@mail.ru19', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(20, 'danil19', 'sheptalin19', 'danil-sheptalin@mail.ru19', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0),
(21, 'danil20', 'sheptalin20', 'danil-sheptalin@mail.ru20', 'jfsdahkj ', 'junior developer', '2525252', '981231232131', '99383834741', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
