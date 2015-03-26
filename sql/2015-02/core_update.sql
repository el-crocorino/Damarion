-- 2015-03-25 - Database init

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `damarion`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `answer_question_id` int(10) unsigned NOT NULL,
  `answer_text` varchar(255) NOT NULL,
  `answer_right` tinyint(1) NOT NULL,
  `answer_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_question_id`, `answer_text`, `answer_right`, `answer_active`) VALUES
(5, 1, 'Un marron', 1, 1),
(6, 1, 'Un ours', 0, 1),
(7, 1, 'Une hermine', 0, 1),
(8, 1, 'Un nuage', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `game_title` varchar(25) NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `game`
--

INSERT INTO `game` (`game_id`, `game_title`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_game_id` int(10) unsigned NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `question_order` int(10) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`question_id`, `question_game_id`, `question_text`, `question_order`) VALUES
(1, 1, 'Qu''est-ce qui est petit et marron ?', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_username` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_username`) VALUES
(1, 'olivier');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `vote_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vote_user_id` int(10) unsigned NOT NULL,
  `vote_question_id` int(10) unsigned NOT NULL,
  `vote_answer_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `vote`
--

INSERT INTO `vote` (`vote_id`, `vote_user_id`, `vote_question_id`, `vote_answer_id`) VALUES
(1, 1, 1, 1);
