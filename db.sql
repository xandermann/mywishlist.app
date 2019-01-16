SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liste_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `descr` text,
  `img` text,
  `url` text,
  `tarif` decimal(5,2) DEFAULT NULL,
  `participant` varchar(255),
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `item` (`id`, `liste_id`, `nom`, `descr`, `img`, `url`, `tarif`) VALUES
(1, 2,  'Champagne',  'Bouteille de champagne + flutes + jeux à gratter', 'champagne.jpg',  '', 20.00),
(2, 2,  'Musique',  'Partitions de piano à 4 mains',  'musique.jpg',  '', 25.00),
(3, 2,  'Exposition', 'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel', 'poirelregarder.jpg', '', 14.00),
(4, 3,  'Goûter', 'Goûter au FIFNL',  'gouter.jpg', '', 20.00),
(5, 3,  'Projection', 'Projection courts-métrages au FIFNL',  'film.jpg', '', 10.00),
(6, 2,  'Bouquet',  'Bouquet de roses et Mots de Marion Renaud',  'rose.jpg', '', 16.00),
(7, 2,  'Diner Stanislas',  'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)',  'bonroi.jpg', '', 60.00),
(8, 3,  'Origami',  'Baguettes magiques en Origami en buvant un thé', 'origami.jpg',  '', 12.00),
(9, 3,  'Livres', 'Livre bricolage avec petits-enfants + Roman',  'bricolage.jpg',  '', 24.00),
(10,  2,  'Diner  Grand Rue ',  'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)', 'grandrue.jpg', '', 59.00),
(11,  0,  'Visite guidée',  'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas', 'place.jpg',  '', 11.00),
(12,  2,  'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil',  'bijoux.jpg', '', 29.00),
(19,  0,  'Jeu contacts', 'Jeu pour échange de contacts', 'contact.jpg',  '', 5.00),
(22,  0,  'Concert',  'Un concert à Nancy', 'concert.jpg',  '', 17.00),
(23,  1,  'Appart Hotel', 'Appart’hôtel Coeur de Ville, en plein centre-ville', 'apparthotel.jpg',  '', 56.00),
(24,  2,  'Hôtel d\'Haussonville',  'Hôtel d\'Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas', 'hotel_haussonville_logo.jpg',  '', 169.00),
(25,  1,  'Boite de nuit',  'Discothèque, Boîte tendance avec des soirées à thème & DJ invités',  'boitedenuit.jpg',  '', 32.00),
(26,  1,  'Planètes Laser', 'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.', 'laser.jpg',  '', 15.00),
(27,  1,  'Fort Aventure',  'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l\'élastique inversé, Toboggan géant... et bien plus encore.',  'fort.jpg', '', 25.00);

DROP TABLE IF EXISTS `liste`;
CREATE TABLE `liste` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `expiration` date DEFAULT NULL,
  `estPublique` TINYINT DEFAULT 0,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `liste` (`no`, `user_id`, `titre`, `description`, `expiration`, `token`) VALUES
(1, 1,  'Pour fêter le bac !',  'Pour un week-end à Nancy qui nous fera oublier les épreuves. ',  '2018-06-27', 'nosecure1'),
(2, 2,  'Liste de mariage d\'Alice et Bob', 'Nous souhaitons passer un week-end royal à Nancy pour notre lune de miel :)',  '2018-06-30', 'nosecure2'),
(3, 3,  'C\'est l\'anniversaire de Charlie',  'Pour lui préparer une fête dont il se souviendra :)',  '2017-12-12', 'nosecure3');


DROP TABLE IF EXISTS `messageliste`;
CREATE TABLE `messageliste` (
  `idmess` int(11) not null AUTO_INCREMENT,
  `liste_id` int(11) NOT NULL,
  `message` varchar(200),
  `pseudo` varchar(200),

  PRIMARY KEY (`idmess`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'a@a.a',  '$2a$10$wbEcZj9/19Mo0PpNBPujBeKMcYNqhEDd/f7Mc0ATsuAGvnpUlYrTS'), /* a */
(2, 'tstanton@hotmail.com', 'L0\'Wtse?3'),
(3, 'COUCOUEmailTest@hotmail.com', 'L0\'Wtse?3'),
(4, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(5, 'tstanton@hotmail.com', 'L0\'Wtse?3'),
(6, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(7, 'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(8, 'tstanton@hotmail.com', 'L0\'Wtse?3'),
(9, 'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(10,  'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(11,  'dcollins@yahoo.com', '7`1D*0\"'),
(12,  'tstanton@hotmail.com', 'L0\'Wtse?3'),
(13,  'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(14,  'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(15,  'dcollins@yahoo.com', '7`1D*0\"'),
(16,  'unienow@powlowski.biz',  'WPI?GeR4tR\'Z8=uw'),
(17,  'tstanton@hotmail.com', 'L0\'Wtse?3'),
(18,  'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(19,  'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(20,  'dcollins@yahoo.com', '7`1D*0\"'),
(21,  'unienow@powlowski.biz',  'WPI?GeR4tR\'Z8=uw'),
(22,  'hodkiewicz.hoyt@gmail.com',  'u[lOM<Gyfa&gX)&op'),
(23,  'tstanton@hotmail.com', 'L0\'Wtse?3'),
(24,  'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(25,  'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(26,  'dcollins@yahoo.com', '7`1D*0\"'),
(27,  'unienow@powlowski.biz',  'WPI?GeR4tR\'Z8=uw'),
(28,  'hodkiewicz.hoyt@gmail.com',  'u[lOM<Gyfa&gX)&op'),
(29,  'ylang@hotmail.com',  '6iQvQ0v|!pUL,9RP@=R6'),
(30,  'tstanton@hotmail.com', 'L0\'Wtse?3'),
(31,  'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(32,  'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(33,  'dcollins@yahoo.com', '7`1D*0\"'),
(34,  'unienow@powlowski.biz',  'WPI?GeR4tR\'Z8=uw'),
(35,  'hodkiewicz.hoyt@gmail.com',  'u[lOM<Gyfa&gX)&op'),
(36,  'ylang@hotmail.com',  '6iQvQ0v|!pUL,9RP@=R6'),
(37,  'carissa.turner@crist.biz', '@\'<^.(+S)$'),
(38,  'tstanton@hotmail.com', 'L0\'Wtse?3'),
(39,  'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(40,  'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(41,  'dcollins@yahoo.com', '7`1D*0\"'),
(42,  'unienow@powlowski.biz',  'WPI?GeR4tR\'Z8=uw'),
(43,  'hodkiewicz.hoyt@gmail.com',  'u[lOM<Gyfa&gX)&op'),
(44,  'ylang@hotmail.com',  '6iQvQ0v|!pUL,9RP@=R6'),
(45,  'carissa.turner@crist.biz', '@\'<^.(+S)$'),
(46,  'justina65@blanda.com', 'AG2mJy>k9>IOOE-'),
(47,  'tstanton@hotmail.com', 'L0\'Wtse?3'),
(48,  'king.marquise@funk.com', 'xXq*F!YOxCWh3'),
(49,  'grimes.geovanni@leuschke.com', '[6K*8grwO)'),
(50,  'dcollins@yahoo.com', '7`1D*0\"'),
(51,  'unienow@powlowski.biz',  'WPI?GeR4tR\'Z8=uw'),
(52,  'hodkiewicz.hoyt@gmail.com',  'u[lOM<Gyfa&gX)&op'),
(53,  'ylang@hotmail.com',  '6iQvQ0v|!pUL,9RP@=R6'),
(54,  'carissa.turner@crist.biz', '@\'<^.(+S)$'),
(55,  'justina65@blanda.com', 'AG2mJy>k9>IOOE-'),
(56,  'kelvin.kerluke@yahoo.com', '`F{3Aq');

CREATE TABLE image(
  idImage INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  path VARCHAR(100) NOT NULL
);

CREATE TABLE message(
  idMessage INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
  contenu VARCHAR(200) NOT NULL
);

CREATE TABLE decris(
  image_idImage INTEGER NOT NULL,
  item_id INTEGER NOT NULL
);

ALTER TABLE decris
    ADD PRIMARY KEY (image_idImage,item_id),
    ADD FOREIGN KEY (image_idImage) REFERENCES image(idImage),
    ADD FOREIGN KEY (item_id) REFERENCES items(id);
