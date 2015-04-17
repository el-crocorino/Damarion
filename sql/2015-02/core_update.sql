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

GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER ON *.* TO 'damarion_master'@'%' IDENTIFIED BY PASSWORD '*3B01AC4F513E83388566BF6F0172BC7D797AC918';

GRANT ALL PRIVILEGES ON `damarion`.* TO 'damarion_master'@'%';

GRANT SELECT ON *.* TO 'damarion_slave'@'%' IDENTIFIED BY PASSWORD '*24729F4E99510EF2111D9831F7FBE528055BE13F';

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Daten für Tabelle `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_question_id`, `answer_text`, `answer_right`, `answer_active`) VALUES
(22, 1, 'Cacharel', 0, 1),
(23, 1, 'Levi''s', 0, 1),
(24, 1, 'Le slip français', 1, 1),
(25, 1, 'Petit bateau', 0, 1),
(26, 11, '2130m', 0, 1),
(27, 11, '3465m', 1, 1),
(28, 11, '2580', 0, 1),
(29, 11, '2613m', 0, 1),
(30, 12, 'De sa première guitare', 0, 1),
(31, 12, 'De l''euphonium', 0, 1),
(32, 12, 'Du violoncelle', 1, 1),
(33, 12, 'De la viole de gambe', 0, 1),
(34, 13, 'On ne voit que ses mains', 0, 1),
(35, 13, 'À gauche', 0, 1),
(36, 13, 'Au milieu', 1, 1),
(37, 13, 'À droite', 0, 1),
(38, 14, 'Baltique', 0, 1),
(39, 14, 'Méditerranée', 1, 1),
(40, 14, 'Atlantique', 0, 1),
(41, 14, 'Lac Kir à Dijon', 0, 1),
(42, 15, 'Une perruque', 0, 1),
(43, 15, 'Un poulpe', 0, 1),
(44, 15, 'Un facehugger', 0, 1),
(45, 15, 'Une araignée de mer', 1, 1),
(46, 16, '7', 0, 1),
(47, 16, '11', 1, 1),
(48, 16, '15', 0, 1),
(49, 16, '3', 0, 1),
(50, 19, '6 assiettes', 0, 1),
(51, 19, '17 assiettes', 0, 1),
(52, 19, '24 assiettes', 1, 1),
(53, 19, '40 assiettes', 0, 1),
(54, 20, 'De la mayonnaise industrielle', 1, 1),
(55, 20, 'Du tabasco', 0, 1),
(56, 20, 'Du guacamole', 0, 1),
(57, 20, 'Du Mont d''or', 0, 1),
(58, 21, 'Oui', 0, 1),
(59, 21, 'Non', 1, 1),
(60, 21, 'Peut-être ?', 0, 1),
(61, 21, 'Sol majeur 7', 0, 1),
(62, 22, 'Dans les Alpes', 0, 1),
(63, 22, 'À l''Aquaboulevard', 0, 1),
(64, 22, 'Aux chutes du Niagara', 0, 1),
(65, 22, 'Au parc Montsouris', 1, 1),
(66, 23, 'Avec un casque', 0, 1),
(67, 23, 'En tenue de marathon', 0, 1),
(68, 23, 'En forçant la première avant un rond-point', 1, 1),
(69, 23, 'En trajectant soigneusement', 0, 1),
(70, 24, 'Damien et Philippe', 0, 1),
(71, 24, 'Damien et Thomas', 0, 1),
(72, 24, 'Marion et Coralie', 0, 1),
(73, 24, 'Tous les amis de Damien', 1, 1),
(74, 25, '21', 0, 1),
(75, 25, '10', 0, 1),
(76, 25, '15', 1, 1),
(77, 25, '7', 0, 1),
(78, 26, 'Oui, si l''enfant à endormir a plus de 25 ans', 1, 1),
(79, 26, 'Non, elle n''a aucun succès', 1, 1),
(80, 26, 'Seulement si elle a fait son jogging', 0, 1),
(81, 26, 'Aucune idée', 0, 1),
(82, 27, 'Une barrière', 0, 1),
(83, 27, 'Une vache', 0, 1),
(84, 27, 'Un camping-car', 0, 1),
(85, 27, 'Le seul arbre du pré', 1, 1),
(86, 28, 'Au salon de l''agriculture', 0, 1),
(87, 28, 'À une soirée déguisée pour Halloween', 0, 1),
(88, 28, 'À un matche de la coupe du monde en 1998', 1, 1),
(89, 28, 'À une fête un peu trop arrosée', 0, 1),
(90, 29, 'Un saint-nectaire, doux et suave', 0, 1),
(91, 29, 'Un roquefort, puissant et généreux', 0, 1),
(92, 29, 'Un époisse (quel caractère !)', 1, 1),
(93, 29, 'Un camembert pasteurisé', 0, 1),
(94, 30, 'Une sonate de Schubert', 0, 1),
(95, 30, 'Un tube de Lady Gaga', 0, 1),
(96, 30, 'Un album de Motorhead', 0, 1),
(97, 30, 'Une sérénade du XVIIe siècle', 1, 1),
(98, 31, 'Olivier lui chatouille les pieds', 0, 1),
(99, 31, 'Le biberon arrive', 0, 1),
(100, 31, 'Son papa arrive', 1, 1),
(101, 31, 'Il a vu un chat passer', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int(10) NOT NULL AUTO_INCREMENT,
  `game_title` varchar(25) NOT NULL,
  `game_friend` tinyint(1) DEFAULT NULL,
  `game_public` tinyint(1) DEFAULT NULL,
  `game_fifty` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `game`
--

INSERT INTO `game` (`game_id`, `game_title`, `game_friend`, `game_public`, `game_fifty`) VALUES
(1, 'Damarion', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_game_id` int(10) unsigned NOT NULL,
  `question_active` tinyint(1) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `question_has_picture_after` tinyint(1) NOT NULL DEFAULT '0',
  `question_order` int(10) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`question_id`, `question_game_id`, `question_active`, `question_text`, `question_has_picture_after`, `question_order`) VALUES
(1, 1, 0, 'Quelle marque vestimentaire française vous réunit de façon très romantique ?', 1, 1),
(11, 1, 0, 'Quelle est l''altitude de ce glacier en face des Deux Alpes ?', 0, 2),
(12, 1, 0, 'De quel instrument joue Damien ?', 0, 3),
(13, 1, 0, 'Où est Damien sur la photo ?', 0, 4),
(14, 1, 0, 'Dans quelle mer la photo a-t-elle été prise ?', 0, 5),
(15, 1, 0, 'Que tient Damien ?', 0, 6),
(16, 1, 0, 'Combien de fois Damien a-t-il déménagé ?', 0, 7),
(19, 1, 0, 'Quel est le record de Damien au défi Carpaccio ?', 0, 8),
(20, 1, 0, 'Quel est l''assaisonnement naturel d''une croûte de pizza ? ?', 0, 9),
(21, 1, 1, 'Sont-ils toujours d''accord ?', 1, 10),
(22, 1, 0, 'Où se déroule cette scène du mois de Mars ?', 0, 11),
(23, 1, 0, 'Comment Damien conduit-il de façon sportive ?', 0, 12),
(24, 1, 0, 'Qui a participé aux enlévements de nains de jardin ?', 0, 13),
(25, 1, 0, 'Combien Damien a-t-il de cousins ?', 0, 14),
(26, 1, 0, 'Marion sait-elle bien raconter les histoires pour s''endormir le soir ?', 1, 15),
(27, 1, 0, 'Qu''a percuté cette voiture ?', 0, 16),
(28, 1, 0, 'A quelle occasion a été prise cette photo ?', 0, 17),
(29, 1, 0, 'Si Damien était un fromage, il serait...', 0, 18),
(30, 1, 0, 'Si Marion était une chanson, elle serait...', 0, 19),
(31, 1, 0, 'Pourquoi Damien rit-il ?', 0, 20);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_username` varchar(60) NOT NULL,
  `user_password` varchar(88) NOT NULL,
  `user_salt` varchar(23) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_salt`, `user_role`) VALUES
(1, 'olivier', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(2, 'estelle', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(3, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(4, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER'),
(5, 'admin', 'odcRJHrXoehTyFydjKy/bZHjPnjOa+QRc0VBwlRsbedQnfaL+2EdJdhqa6EtAImi6gf8M7+Y7cmJYKRTyZfi0w==', '%qUgq3NAYfC1MKwrW?yevbE', 'ROLE_ADMIN'),
(6, 'Test', '39yCfv8oHtqaW5g+L8x9o/5toqALl3pFcmqADkd3VM+oJTLljqbpfU/71xDd03EKkNLIjPSq83wQ8uxNYSbXKA==', 'c3bc80b1c45f02402ef874b', 'ROLE_USER'),
(7, 'damarion', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(8, '1', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(9, '2', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(10, '3', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(11, '4', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(12, '5', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(13, '6', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(14, '7', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(15, '8', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(16, '9', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(17, '10', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(18, '11', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(19, '12', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(20, '13', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(21, '14', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(22, '15', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(23, '16', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(24, '17', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(25, '18', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(26, '19', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(27, '20', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(28, '21', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(29, '22', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(30, '23', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(31, '24', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(32, '25', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(33, '26', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(34, '27', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(35, '28', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(36, '29', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(37, '30', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(38, '31', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(39, '32', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(40, '33', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(41, '34', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(42, '35', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(43, '36', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(44, '37', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(45, '38', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(46, '39', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(47, '40', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(48, '41', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(49, '42', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(50, '43', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(51, '44', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(52, '45', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(53, '46', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(54, '47', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(55, '48', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(56, '49', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(57, '50', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(58, '51', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(59, '52', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(60, '53', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(61, '54', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER'),
(62, '55', 'dRKJ03VGg9cwQ68zODJffuct/b1TYiO2FBTGpzwPecG+OUFpkjkXZOVbcc/yYkh08oCQ+NlEEqOWAHbSwZF1+w==', 'c36f2f67ba4df291c18d133', 'ROLE_USER');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

