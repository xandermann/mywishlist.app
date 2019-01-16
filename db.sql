SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `hublau2u`
--

-- --------------------------------------------------------

--
-- Structure de la table `decris`
--

CREATE TABLE IF NOT EXISTS `decris` (
  `image_idImage` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`image_idImage`,`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `decris`
--

INSERT INTO `decris` (`image_idImage`, `item_id`) VALUES
(1, 29),
(2, 23),
(3, 23),
(4, 4),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY (`idImage`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`idImage`, `path`) VALUES
(1, '001.jpg'),
(2, 'hotel_haussonville_logo.jpg'),
(4, 'gouter.jpg'),
(5, 'champagne.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `descr` text,
  `img` text,
  `url` text,
  `tarif` decimal(5,2) DEFAULT NULL,
  `participant` varchar(255) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `liste_id`, `nom`, `descr`, `img`, `url`, `tarif`, `participant`, `message`) VALUES
(1, 2, 'Champagne', 'Bouteille de champagne + flutes + jeux à gratter', 'champagne.jpg', '', '20.00', NULL, NULL),
(2, 2, 'Musique', 'Partitions de piano à 4 mains', 'musique.jpg', '', '25.00', NULL, NULL),
(3, 2, 'Exposition', 'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel', 'poirelregarder.jpg', '', '14.00', NULL, NULL),
(4, 3, 'Goûter', 'Goûter au FIFNL', 'gouter.jpg', '', '20.00', NULL, NULL),
(5, 3, 'Projection', 'Projection courts-métrages au FIFNL', 'film.jpg', '', '10.00', NULL, NULL),
(6, 2, 'Bouquet', 'Bouquet de roses et Mots de Marion Renaud', 'rose.jpg', '', '16.00', NULL, NULL),
(7, 2, 'Diner Stanislas', 'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)', 'bonroi.jpg', '', '60.00', NULL, NULL),
(8, 3, 'Origami', 'Baguettes magiques en Origami en buvant un thé', 'origami.jpg', '', '12.00', NULL, NULL),
(9, 3, 'Livres', 'Livre bricolage avec petits-enfants + Roman', 'bricolage.jpg', '', '24.00', NULL, NULL),
(10, 2, 'Diner  Grand Rue ', 'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)', 'grandrue.jpg', '', '59.00', NULL, NULL),
(11, 0, 'Visite guidée', 'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas', 'place.jpg', '', '11.00', NULL, NULL),
(12, 2, 'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil', 'bijoux.jpg', '', '29.00', NULL, NULL),
(19, 0, 'Jeu contacts', 'Jeu pour échange de contacts', 'contact.png', '', '5.00', NULL, NULL),
(22, 0, 'Concert', 'Un concert à Nancy', 'concert.jpg', '', '17.00', NULL, NULL),
(23, 1, 'Appart Hotel', 'Appart’hôtel Coeur de Ville, en plein centre-ville', 'apparthotel.jpg', '', '56.00', NULL, NULL),
(24, 2, 'Hôtel d''Haussonville', 'Hôtel d''Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas', 'hotel_haussonville_logo.jpg', '', '169.00', NULL, NULL),
(25, 1, 'Boite de nuit', 'Discothèque, Boîte tendance avec des soirées à thème & DJ invités', 'boitedenuit.jpg', '', '32.00', NULL, NULL),
(26, 1, 'Planètes Laser', 'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.', 'laser.jpg', '', '15.00', NULL, NULL),
(27, 1, 'Fort Aventure', 'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l''élastique inversé, Toboggan géant... et bien plus encore.', 'fort.jpg', '', '25.00', NULL, NULL),
(28, 4, 'Un super ballon', 'Pour jouer au foot', NULL, NULL, '15.00', NULL, NULL),
(29, 5, 'flute', 'ff', NULL, NULL, '1.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE IF NOT EXISTS `liste` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `expiration` date DEFAULT NULL,
  `estPublique` tinyint(4) DEFAULT '0',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `liste`
--

INSERT INTO `liste` (`no`, `user_id`, `titre`, `description`, `expiration`, `estPublique`, `token`) VALUES
(1, 1, 'Pour fêter le bac !', 'Pour un week-end à Nancy qui nous fera oublier les épreuves. ', '2018-06-27', 1, 'nosecure1'),
(3, 3, 'C''est l''anniversaire de Charlie', 'Pour lui préparer une fête dont il se souviendra :)', '2017-12-12', 1, 'nosecure3'),
(4, 1, 'Ma liste d&#39;exemple', 'Mon super description', '2021-12-12', 0, NULL),
(5, 1, 'Test', 'azz', '2019-01-18', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(200) NOT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `messageliste`
--

CREATE TABLE IF NOT EXISTS `messageliste` (
  `idmess` int(11) NOT NULL AUTO_INCREMENT,
  `liste_id` int(11) NOT NULL,
  `message` varchar(200) DEFAULT NULL,
  `pseudo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idmess`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `messageliste`
--

INSERT INTO `messageliste` (`idmess`, `liste_id`, `message`, `pseudo`) VALUES
(1, 4, 'Message pour la liste d&#39;exemple', 'a@a.a'),
(2, 1, 'message 1', 'a@a.a');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'a@a.a', '$2a$10$wbEcZj9/19Mo0PpNBPujBeKMcYNqhEDd/f7Mc0ATsuAGvnpUlYrTS'),
(2, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(3, 'COUCOUEmailTest@hotmail.com', 'L0''Wtse?3'),
(4, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(5, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(6, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(7, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(8, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(9, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(10, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(11, 'dcollins@yahoo.com', '7`1D*0"'),
(12, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(13, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(14, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(15, 'dcollins@yahoo.com', '7`1D*0"'),
(16, 'unienow@powlowski.biz', 'WPI?GeR4tR''Z8=uw'),
(17, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(18, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(19, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(20, 'dcollins@yahoo.com', '7`1D*0"'),
(21, 'unienow@powlowski.biz', 'WPI?GeR4tR''Z8=uw'),
(22, 'hodkiewicz.hoyt@gmail.com', 'u[lOM<Gyfa&gX)&op'),
(23, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(24, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(25, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(26, 'dcollins@yahoo.com', '7`1D*0"'),
(27, 'unienow@powlowski.biz', 'WPI?GeR4tR''Z8=uw'),
(28, 'hodkiewicz.hoyt@gmail.com', 'u[lOM<Gyfa&gX)&op'),
(29, 'ylang@hotmail.com', '6iQvQ0v|!pUL,9RP@=R6'),
(30, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(31, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(32, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(33, 'dcollins@yahoo.com', '7`1D*0"'),
(34, 'unienow@powlowski.biz', 'WPI?GeR4tR''Z8=uw'),
(35, 'hodkiewicz.hoyt@gmail.com', 'u[lOM<Gyfa&gX)&op'),
(36, 'ylang@hotmail.com', '6iQvQ0v|!pUL,9RP@=R6'),
(37, 'carissa.turner@crist.biz', '@''<^.(+S)$'),
(38, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(39, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(40, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(41, 'dcollins@yahoo.com', '7`1D*0"'),
(42, 'unienow@powlowski.biz', 'WPI?GeR4tR''Z8=uw'),
(43, 'hodkiewicz.hoyt@gmail.com', 'u[lOM<Gyfa&gX)&op'),
(44, 'ylang@hotmail.com', '6iQvQ0v|!pUL,9RP@=R6'),
(45, 'carissa.turner@crist.biz', '@''<^.(+S)$'),
(46, 'justina65@blanda.com', 'AG2mJy>k9>IOOE-'),
(47, 'tstanton@hotmail.com', 'L0''Wtse?3'),
(48, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(49, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(50, 'dcollins@yahoo.com', '7`1D*0"'),
(51, 'unienow@powlowski.biz', 'WPI?GeR4tR''Z8=uw'),
(52, 'hodkiewicz.hoyt@gmail.com', 'u[lOM<Gyfa&gX)&op'),
(53, 'ylang@hotmail.com', '6iQvQ0v|!pUL,9RP@=R6'),
(54, 'carissa.turner@crist.biz', '@''<^.(+S)$'),
(55, 'justina65@blanda.com', 'AG2mJy>k9>IOOE-'),
(56, 'kelvin.kerluke@yahoo.com', '`F{3Aq');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
