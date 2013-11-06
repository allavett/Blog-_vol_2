-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Loomise aeg: Nov 06, 2013 kell 08:40 PM
-- Serveri versioon: 5.5.32
-- PHP versioon: 5.4.19

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Andmebaas: `blogvol2`
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
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=5 ;

--
-- Andmete tõmmistamine tabelile `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_text`, `comment_created`, `comment_author`) VALUES
(2, 'Huvitav', '2013-10-29 10:09:37', 'demo'),
(3, 'Hahahhahah a', '2013-11-03 18:38:11', 'kemo'),
(4, 'Hahahhahah a', '2013-11-03 18:41:47', 'kemo');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=18 ;

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
(16, 'See siin on uus postitus', 'See on postituse tekst', '2013-11-03 21:21:38', 31),
(17, 'See on veel uuem postitus', 'Bbllllbll', '2013-11-03 21:29:39', 31);

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
(7, 4);

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
(17, 1),
(2, 2),
(5, 2),
(7, 2),
(17, 2),
(3, 3),
(6, 3),
(7, 3),
(4, 4),
(6, 4),
(7, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(11, 6),
(12, 6),
(13, 6),
(14, 6),
(16, 7);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(25) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Andmete tõmmistamine tabelile `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'Taggens'),
(2, 'Postitus'),
(3, 'Taggens2'),
(4, 'Tekst'),
(5, ' Taggens'),
(6, ' Uustag'),
(7, 'Postitus, Taggens');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `terms`
--

DROP TABLE IF EXISTS `terms`;
CREATE TABLE IF NOT EXISTS `terms` (
  `terms_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) COLLATE utf8_estonian_ci DEFAULT NULL,
  PRIMARY KEY (`terms_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=17 ;

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
(16, 'password_plh');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci AUTO_INCREMENT=27 ;

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
(17, 1, 12, 'Select lang'),
(18, 2, 12, 'Vali keel'),
(19, 1, 13, 'Sign in'),
(20, 2, 13, 'Logi sisse'),
(21, 1, 14, 'Register'),
(22, 2, 14, 'Registreeri'),
(23, 1, 15, 'User'),
(24, 2, 15, 'Kasutaja'),
(25, 1, 16, 'Password'),
(26, 2, 16, 'Parool');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Andmete tõmmistamine tabelile `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `avatar`, `deleted`) VALUES
(1, 'demo', 'demo', '', 'demodemo.png', 0),
(31, 'kemo', 'kemo', 'kemo@kemo.ee', 'kemoKemo_thumb.jpg', 0);

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