-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 28. Mrz 2015 um 16:49
-- Server Version: 5.5.41
-- PHP-Version: 5.5.21-1~dotdeb.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `damarion`

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `game_title` varchar(25) NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `game`
--

INSERT INTO `game` (`game_id`, `game_title`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_game_id` int(10) unsigned NOT NULL,
  `question_active` tinyint(1) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `question_order` int(10) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`question_id`, `question_game_id`, `question_active`, `question_text`, `question_order`) VALUES
(1, 1, 1, 'Qu\'est-ce qui est petit et marron ?', 1),
(2, 1, 0, 'Oú est Charlie ?', 2);
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer_question_id` int(10) unsigned NOT NULL,
  `answer_text` varchar(255) NOT NULL,
  `answer_right` tinyint(1) NOT NULL,
  `answer_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_question_id`, `answer_text`, `answer_right`, `answer_active`) VALUES
(1, 1, 'Un marron', 1, 1),
(2, 1, 'Un ours', 0, 1),
(3, 1, 'Une hermine', 0, 1),
(4, 1, 'Un nuage', 0, 1);

INSERT INTO `answer` (`answer_id`, `answer_question_id`, `answer_text`, `answer_right`, `answer_active`) VALUES
(5, 2, 'Au Népal', 1, 1),
(6, 2, 'In ze kitcheun', 0, 1),
(7, 2, 'Derrière toi, c\'est affreux', 0, 1),
(8, 2, 'Au ski', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_username` varchar(60) NOT NULL,
  `user_password` varchar(88) NOT NULL,
  `user_salt` varchar(23) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_salt`, `user_role`) VALUES
-- Raw password is john
(1, 'olivier', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(2, 'estelle', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(3, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
-- Raw password is jane
(4, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');

-- Raw password is <?admin?>
INSERT INTO `user` ( `user_username` , `user_password` , `user_salt` , `user_role` )
VALUES (
'admin', 'odcRJHrXoehTyFydjKy/bZHjPnjOa+QRc0VBwlRsbedQnfaL+2EdJdhqa6EtAImi6gf8M7+Y7cmJYKRTyZfi0w==', '%qUgq3NAYfC1MKwrW?yevbE', 'ROLE_ADMIN'
)

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `vote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vote_user_id` int(10) unsigned NOT NULL,
  `vote_question_id` int(10) unsigned NOT NULL,
  `vote_answer_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `vote`
--

INSERT INTO `vote` (`vote_id`, `vote_user_id`, `vote_question_id`, `vote_answer_id`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 3),
(3, 2, 1, 2),
(4, 2, 2, 4),
(5, 3, 1, 4),
(6, 3, 2, 3),
(7, 4, 1, 2),
(8, 4, 2, 1);
