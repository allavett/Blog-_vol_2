-- phpMyAdmin SQL Dump
-- version 4.1-dev
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2013 kell 11:08 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blogvol2`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_text` varchar(500) CHARACTER SET latin1 NOT NULL,
  `comment_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_author` varchar(25) CHARACTER SET latin1 NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=13 ;

--
-- Andmete tõmmistamine tabelile `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_text`, `comment_created`, `comment_author`, `author_id`) VALUES
(2, 'Huvitav', '2013-10-29 10:09:37', 'demo', 0),
(3, 'Hahahhahah a', '2013-11-03 18:38:11', 'kemo', 0),
(4, 'Hahahhahah a', '2013-11-03 18:41:47', 'kemo', 0),
(5, 'test', '2013-11-07 12:32:03', 'demo', 0),
(6, 'test', '2013-11-07 12:32:15', 'demo', 0),
(7, 'Ouujeee', '2013-11-07 20:35:39', 'kemo', 0),
(8, 'Ouujeee', '2013-11-07 20:41:56', 'kemo', 2),
(9, 'wut', '2013-11-07 21:15:22', 'kemo', 2),
(10, 'wut', '2013-11-07 21:16:11', 'kemo', 2),
(11, 'wut', '2013-11-07 21:16:35', 'kemo', 2),
(12, 'wut', '2013-11-07 21:17:06', 'kemo', 2);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `locale`
--

DROP TABLE IF EXISTS `locale`;
CREATE TABLE IF NOT EXISTS `locale` (
  `locale_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) COLLATE utf8_estonian_ci DEFAULT NULL,
  PRIMARY KEY (`locale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=3 ;

--
-- Andmete tõmmistamine tabelile `locale`
--

INSERT INTO `locale` (`locale_id`, `value`) VALUES
(1, 'English'),
(2, 'Estonian');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_subject` varchar(255) COLLATE utf8_estonian_ci NOT NULL,
  `post_text` text COLLATE utf8_estonian_ci NOT NULL,
  `post_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=9 ;

--
-- Andmete tõmmistamine tabelile `post`
--

INSERT INTO `post` (`post_id`, `post_subject`, `post_text`, `post_created`, `user_id`) VALUES
(1, 'Test1', 'Postituse tekst 1', '2013-10-26 08:31:59', 1),
(2, 'Test2', 'Postituse tekst 2.\r\nReavahetus..', '2013-10-26 08:32:59', 1),
(3, 'Test 3', 'Postituse tekst 4', '2013-10-26 08:33:59', 1),
(4, 'Test4', 'Postituse tekst 4', '2013-10-26 08:34:59', 1),
(5, 'Test5', 'Postituse tekst 5', '2013-10-26 08:35:59', 1),
(6, 'Test6', 'Postituse tekst 6', '2013-10-26 08:36:59', 1),
(7, 'Anekdoot', 'Eesti talumees sõidab reega kodu poole. Mehel ka kaks poega kaasas. Mingil hetkel jookseb jänes üle tee.\r\nMöödub pool tundi ja esimene poeg hüüatab: «Näe, jänes!»\r\nMöödub veel pool tundi ja teine poeg nähvab: «Ei olnud jänes, sa lollpea!»\r\nMöödub järgmine pooltund ning talumees sõnab lepitavalt: «Mis te tulised eesti poisid nüüd selle tühja-tähja pärast tüli kisute.»', '2013-10-27 12:10:49', 1),
(8, 'Uus postitus', 'Postituse tekst', '2013-11-07 12:57:56', 1);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE IF NOT EXISTS `post_comments` (
  `post_id` int(11) unsigned NOT NULL,
  `comment_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`comment_id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Andmete tõmmistamine tabelile `post_comments`
--

INSERT INTO `post_comments` (`post_id`, `comment_id`) VALUES
(7, 3),
(7, 4),
(8, 7),
(8, 8),
(7, 9),
(7, 10),
(7, 11),
(7, 12);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE IF NOT EXISTS `post_tags` (
  `post_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Andmete tõmmistamine tabelile `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(1, 1),
(5, 1),
(7, 1),
(2, 2),
(5, 2),
(7, 2),
(3, 3),
(6, 3),
(7, 3),
(4, 4),
(6, 4),
(7, 4),
(8, 5);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(25) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Andmete tõmmistamine tabelile `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'Taggens'),
(2, 'Postitus'),
(3, 'Taggens2'),
(4, 'Tekst'),
(5, 'Silt');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `terms`
--

DROP TABLE IF EXISTS `terms`;
CREATE TABLE IF NOT EXISTS `terms` (
  `terms_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) COLLATE utf8_estonian_ci DEFAULT NULL,
  PRIMARY KEY (`terms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=44 ;

--
-- Andmete tõmmistamine tabelile `terms`
--

INSERT INTO `terms` (`terms_id`, `value`) VALUES
(3, 'welcome_blurb'),
(8, 'posts_link'),
(9, 'posts_add'),
(10, 'tags_link'),
(11, 'logout_link'),
(12, 'lang_link'),
(13, 'signin_btn'),
(14, 'register_btn'),
(15, 'user_plh'),
(16, 'password_plh'),
(17, 'posted'),
(18, 'posted_by'),
(19, 'comment_txt'),
(20, 'comment_btn'),
(21, 'comment'),
(22, 'comment_by'),
(23, 'register_username'),
(24, 'register_label'),
(25, 'register_username_txt'),
(26, 'register_email_txt'),
(27, 'register_password'),
(28, 'register_password_txt'),
(29, 'register_password_confirm'),
(30, 'register_password_confirm_txt'),
(31, 'avatar'),
(32, 'avatar_dimensions'),
(33, 'comment_empty'),
(34, 'comment_no_text'),
(35, 'comment_no_auth'),
(36, 'comment_ok'),
(37, 'new_post'),
(38, 'new_post_title'),
(39, 'new_post_txt'),
(40, 'new_post_tags'),
(41, 'new_post_close'),
(42, 'new_post_save'),
(43, 'new_post_tags_txt');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `locale_id` int(11) NOT NULL,
  `terms_id` int(11) NOT NULL,
  `value` varchar(128) COLLATE utf8_estonian_ci DEFAULT NULL,
  PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=81 ;

--
-- Andmete tõmmistamine tabelile `translations`
--

INSERT INTO `translations` (`translation_id`, `locale_id`, `terms_id`, `value`) VALUES
(5, 1, 3, 'Welcome to blog!'),
(6, 2, 3, 'Tere tulemast blogisse!'),
(9, 1, 8, 'Posts'),
(10, 2, 8, 'Postitused'),
(11, 1, 9, 'Add new post'),
(12, 2, 9, 'Lisa uus postitus'),
(13, 1, 10, 'Tags'),
(14, 2, 10, 'Sildid'),
(15, 1, 11, 'Logout'),
(16, 2, 11, 'Logi välja'),
(17, 1, 12, 'Select language'),
(18, 2, 12, 'Vali keel'),
(19, 1, 13, 'Sign in'),
(20, 2, 13, 'Logi sisse'),
(21, 1, 14, 'Register'),
(22, 2, 14, 'Registreeri'),
(23, 1, 15, 'User'),
(24, 2, 15, 'Kasutaja'),
(25, 1, 16, 'Password'),
(26, 2, 16, 'Parool'),
(27, 1, 17, 'Posted on '),
(28, 2, 17, 'Postitatud '),
(29, 1, 18, ' by '),
(30, 2, 18, ' Postitas: '),
(31, 1, 19, 'Your comment..'),
(32, 2, 19, 'Sinu kommentaar..'),
(33, 1, 20, 'Submit'),
(34, 2, 20, 'Kommenteeri'),
(35, 1, 21, 'Comment posted on '),
(36, 2, 21, 'Kommentaar on postitatud '),
(37, 1, 22, 'by '),
(38, 2, 22, 'Kommenteeris:  '),
(39, 1, 23, 'Username'),
(40, 2, 23, 'Kasutajanimi'),
(41, 1, 24, 'Register'),
(42, 2, 24, 'Registreerimine'),
(43, 1, 25, 'Username can contain any letters or numbers, without spaces'),
(44, 2, 25, 'Kasutajanimes tohib kasutada ainult tähti ja numbreid ilma tühikuteta'),
(45, 1, 26, 'Please provide your E-mail'),
(46, 2, 26, 'Palun sisesta oma E-maili aadress'),
(47, 1, 27, 'Password'),
(48, 2, 27, 'Parool'),
(49, 1, 28, 'Password should be at least 4 characters'),
(50, 2, 28, 'Parool peaks olema vähemalt 4 tähemärki'),
(51, 1, 29, 'Password (Confirm)'),
(52, 2, 29, 'Parool (Kinnitus)'),
(53, 1, 30, 'Please confirm password'),
(54, 2, 30, 'Palun kinnita parool'),
(55, 1, 31, 'Avatar'),
(56, 2, 31, 'Pilt'),
(57, 1, 32, 'Avatar max dimensions are 100x100'),
(58, 2, 32, 'Pildi maksimaalsed mõõtmed on 100x100'),
(59, 1, 33, 'Your comment is empty!'),
(60, 2, 33, 'Sinu kommentaar on tühi!'),
(61, 1, 34, 'Your comment is empty!'),
(62, 2, 34, 'Sinu kommentaar on tühi!'),
(63, 1, 35, 'How the hell did you insert comment without logging in?!'),
(64, 2, 35, 'Kuidas sul õnnestus lisada kommentaar ilma sisse logimata?!'),
(65, 1, 36, 'Comment submitted successfully!'),
(66, 2, 36, 'Kommentaar edukalt lisatud!'),
(67, 1, 37, 'Add new post'),
(68, 2, 37, 'Lisa uus postitus'),
(69, 1, 38, 'Post title'),
(70, 2, 38, 'Postituse pealkiri'),
(71, 1, 39, 'Post text'),
(72, 2, 39, 'Postituse tekst'),
(73, 1, 40, 'Tags'),
(74, 2, 40, 'Sildid'),
(75, 1, 41, 'Close'),
(76, 2, 41, 'Sulge'),
(77, 1, 42, 'Save post'),
(78, 2, 42, 'Salvesta'),
(79, 1, 43, 'Example: weather; news; beer'),
(80, 2, 43, 'Näidiseks: ilm, uudised, õlu');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Andmete tõmmistamine tabelile `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `avatar`, `deleted`) VALUES
(1, 'demo', 'demo', '', 'demodemo.png', 0),
(2, 'kemo', 'kemo', 'kemo@kemo.ee', '', 0);

--
-- Tõmmistatud tabelite piirangud
--

--
-- Piirangud tabelile `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Piirangud tabelile `post_comments`
--
ALTER TABLE `post_comments`
ADD CONSTRAINT `post_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
ADD CONSTRAINT `post_comments_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`);
SET FOREIGN_KEY_CHECKS=1;
