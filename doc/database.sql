-- phpMyAdmin SQL Dump
-- version 4.1.0-beta1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 29, 2013 at 09:32 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_text` varchar(500) NOT NULL,
  `comment_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_author` varchar(25) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_text`, `comment_created`, `comment_author`) VALUES
(1, 'Huvitav kommentaar.', '2013-10-28 10:57:03', 'Test1'),
(2, 'testikas\r\n', '2013-10-28 11:29:04', 'test'),
(3, 'Ilus ilm', '2013-10-28 11:50:58', 'test'),
(4, 'Igav uudis', '2013-10-28 13:25:45', 'Igav'),
(5, 'Igav', '2013-10-28 17:32:04', 'jupp'),
(6, 'Kapsapea', '2013-10-28 17:51:12', 'Kapsas'),
(7, 'Roosa padi', '2013-10-28 17:52:45', 'Roosa'),
(8, 'Jalgpall', '2013-10-28 17:56:17', 'Anonüümne'),
(9, 'Test', '2013-10-29 08:29:46', 'Anonüümne');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_subject` varchar(255) NOT NULL,
  `post_text` text NOT NULL,
  `post_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_subject`, `post_text`, `post_created`, `user_id`) VALUES
(2, 'Esimese postituse pealkiri', 'Esimene postitus', '2013-10-03 15:01:03', 1),
(3, 'Teise postituse pealkiri', 'Teine postitus', '2013-10-28 11:23:18', 2),
(4, 'Swedbank: tarbijad on e-kaubanduseks valmis', 'Kuigi Eestis on hetkel veel suhtumine e-kaubandusse suhteliselt leige ja kõik kaupmehed ei võta seda ohtu või võimalust veel päris tõsiselt, siis tegelikult viitab kõik ikkagi e-kaubanduse populaarsuse kasvule ka Eesti elanikkonna hulgas, kirjutab Swedbanki kaubanduse sektorijuhi Maris Peda.\r\n\r\nKodumaise e-kaubanduse kasv jääb väliskaupmeestele veel alla', '2013-10-28 11:53:14', 1),
(6, 'Spain summons US ambassador over claim NSA tracked 60m calls a month', 'The Spanish prime minister, Mariano Rajoy, has summoned the US ambassador to explain the latest revelations to emerge from the files leaked by Edward Snowden, which suggest the National Security Agency tracked more than 60m phone calls in Spain in the space of a month.', '2013-10-28 12:13:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE IF NOT EXISTS `post_comments` (
  `post_id` int(11) unsigned NOT NULL,
  `comment_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`comment_id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`post_id`, `comment_id`) VALUES
(8, 1),
(3, 2),
(2, 3),
(6, 4),
(4, 5),
(2, 6),
(2, 7),
(2, 8),
(6, 9);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
CREATE TABLE IF NOT EXISTS `post_tags` (
  `post_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_tags`
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
(7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(25) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'Tag'),
(2, 'Postitus'),
(3, 'Tag2'),
(4, 'Tekst'),
(5, 'tekst');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `deleted`) VALUES
(1, 'demo', 'demo', 0),
(2, 'test', 'test', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`);
SET FOREIGN_KEY_CHECKS=1;
