-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db670514794.db.1and1.com
-- Généré le :  Jeu 12 Juillet 2018 à 22:25
-- Version du serveur :  5.5.60-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  db670514794
--

-- --------------------------------------------------------

--
-- Structure de la table comment
--

CREATE TABLE IF NOT EXISTS comment (
  id int(11) NOT NULL AUTO_INCREMENT,
  idPost int(11) NOT NULL,
  idUser int(50) NOT NULL,
  contenu text NOT NULL,
  valide tinyint(1) NOT NULL DEFAULT '0',
  dateAjout datetime NOT NULL,
  PRIMARY KEY (id),
  KEY fk_id_post (idPost) USING BTREE,
  KEY fk_id_user (idUser) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table comment
--

INSERT INTO comment (id, idPost, idUser, contenu, valide, dateAjout) VALUES
(1, 1, 1, 'Bon article, bien documenté.', 1, '2018-05-24 11:37:30'),
(2, 1, 2, 'Bonjour et merci pour cet article', 1, '2018-05-24 11:39:30'),
(18, 4, 1, 'Super article, et merci pour les infos', 1, '2018-05-24 13:57:10'),
(27, 4, 2, 'j’ai en effet adoré cet article, et j’avoue que l’accroche finale m’a incité à commenté alors que je n’allais pas forcement le faire :) !', 1, '2018-06-06 23:08:36');

-- --------------------------------------------------------

--
-- Structure de la table post
--

CREATE TABLE IF NOT EXISTS post (
  id int(11) NOT NULL AUTO_INCREMENT,
  idUser int(11) NOT NULL,
  titre varchar(100) NOT NULL,
  contenu text NOT NULL,
  dateAjout datetime NOT NULL,
  dateModif datetime NOT NULL,
  PRIMARY KEY (id),
  KEY fk_id_author (idUser) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table post
--

INSERT INTO post (id, idUser, titre, contenu, dateAjout, dateModif) VALUES
(1, 1, 'Les bons outils pour développer en HTML5', 'Choisir un bon éditeur de texte est essentiel pour se sentir à l''aise dans le développement web. De par leur principe, les standards du Web (HTML, CSS, JavaScript, XML) qui ne sont en réalité que des fichiers texte, peuvent être édités avec un simple programme tel que le Bloc-notes (Windows), Vim/Emacs (Linux) ou TextEdit (Mac OS X). C''est là un grand avantage qui vous rend libre de choisir votre environnement de développement de A à Z. Les plus aguerris choisiront probablement un éditeur sobre doté de nombreux raccourcis, tandis que les débutants préféreront une interface conviviale possédant une aide à la conception.\r\n\r\nVous avez toujours la possibilité d''utiliser un programme plus évolué proposant un aperçu Wysiwyg (What You See Is What You Get) au fur et à mesure de la rédaction du document HTML, mais n''oubliez pas que pour avoir un contrôle exact du code, il vous faudra pratiquement toujours mettre les mains dans le cambouis.\r\n\r\nPensez aux critères de choix suivants :\r\n\r\n - coloration syntaxique,\r\n-  suggestions de code,\r\n - outils de recherche/remplacement,\r\n - édition multifichier (onglets),\r\n - présence de raccourcis clavier efficaces.\r\n\r\n Source : https://www.journaldunet.com/\r\n', '2018-05-17 00:00:00', '2018-06-15 10:33:26'),
(4, 1, 'SublimeText, et Adobe Edge pour développer en HTML5', 'De nos jours, une pléthore d''outils est disponible sur Internet en téléchargement gratuit ou payant. Chacun d''entre eux dispose de nombreuses qualités, mais aussi de défauts, il vous appartient de faire votre choix en regard de votre système d''exploitation, de vos habitudes et connaissances. \r\n\r\nIl est possible d''adjoindre à la plupart des éditeurs texte dignes de ce nom des extensions facilitant l''écriture de code, notamment une extension nommée Emmet (ex Zen Coding), permettant d''écrire plus rapidement du code HTML à partir d''une chaîne de syntaxe CSS et d''un raccourci clavier. \r\n\r\nPour n''en citer qu''un, qui me tient à cœur : SublimeText a le vent en poupe, et s''est rapidement forgé une solide réputation. Les fonctionnalités qui peuvent y être ajoutées via Package Control sont impressionnantes : multi-onglets, multi-curseurs, recherche et remplacement multiple, affichage des couleurs pointées dans les feuilles de styles, minification du code JavaScript, auto-complétion dans de nombreux langages, coloration syntaxique, gestion de projets et accès rapide aux fichiers, synchronisation FTP, SVN, Git, auto-ouverture des fichiers liés ou accès direct aux sélecteurs CSS, auto-rechargement des pages, etc.\r\n\r\n\r\nRESSOURCE Éditeurs web (HTML/CSS)\r\n\r\n Notepad++ (Windows, gratuit, licence GPL)\r\nB http://notepad-plus-plus.org/\r\n\r\n PsPad (Windows, gratuit, freeware)\r\nhttp://www.pspad.com/fr/\r\n\r\n SublimeText (Multiplateforme, payant)\r\nhttp://www.sublimetext.com/\r\n\r\n Eclipse (Multiplateforme, gratuit, licence EPL)\r\nhttp://www.eclipse.org/\r\n\r\n jEdit (Multiplateforme, gratuit, licence GNU GPL)\r\nhttp://www.jedit.org/\r\n\r\n Bluefish (gratuit, licence GPL)\r\nhttp://bluefish.openoffice.nl/\r\n\r\n Aptana Studio (Multiplateforme, gratuit, licence mixte GPL)\r\nhttp://www.aptana.com/\r\n\r\n gedit (Linux/Gnome et multiplateforme, licence GNU GPL)\r\nhttp://projects.gnome.org/gedit/\r\n\r\n Kate (Linux/KDE et BSD, licence GNU GPL)\r\nB http://kate-editor.org/\r\n\r\n Komodo Edit (Multiplateforme, gratuit, freeware)\r\nhttp://www.activestate.com/komodo-edit\r\n\r\n TextEdit (Mac OS X, licence propriétaire)\r\nhttp://www.apple.com/fr/macosx/\r\n\r\n Smultron (Mac OS X, licence BSD)\r\nhttp://www.peterborgapps.com/smultron/\r\n\r\n Adobe Dreamweaver (Windows, payant)\r\nhttp://www.adobe.com/fr/products/dreamweaver/\r\n\r\n Adobe Edge Tools (outils gratuits et payants)\r\nhttp://html.adobe.com/edge/\r\n\r\n Microsoft Expression Web (Windows, payant)\r\nhttp://www.microsoft.com/france/expression/\r\n\r\n Emmet (ex Zen Coding)\r\nhttp://docs.emmet.io/\r\n\r\nEn ce qui concerne l''un des outils les plus célèbres, Dreamweaver, un pack de création HTML 5 a été mis à disposition par Adobe pour adjoindre des modèles et conseils de code à la vue éditeur.\r\n\r\nAdobe a aussi lancé une collection d''outils orientés vers HTML 5, nommée Adobe Edge Tools & Services. Il s''agit d''un ensemble de nouveaux programmes complémentaires aux suites graphiques qui visent à générer du code universel pour produire des animations, des interfaces en Responsive Web Design, des polices personnalisées via Typekit, un éditeur de code source, un inspecteur pour déboguer, etc.\r\n\r\nSource : https://www.journaldunet.com/\r\n\r\n', '2018-05-17 00:00:00', '2018-06-14 14:13:42');

-- --------------------------------------------------------

--
-- Structure de la table user
--

CREATE TABLE IF NOT EXISTS user (
  id int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(30) COLLATE utf8_bin NOT NULL,
  prenom varchar(30) COLLATE utf8_bin NOT NULL,
  email varchar(50) COLLATE utf8_bin NOT NULL,
  mdp varchar(150) COLLATE utf8_bin NOT NULL,
  role varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table user
--

INSERT INTO user (id, nom, prenom, email, mdp, role) VALUES
(1, 'BRIERE', 'Stéphane', 'stephanebriere@gdpweb.fr', '$2y$10$J0jR5HbBZVLMFLCNelUTTOw5.eRJD5gmQKktyokwOZ9hNQ42T2aA6', '1'),
(2, 'VISITEUR', 'Stéphane', 'stephanebriere@hotmail.fr', '$2y$10$J0jR5HbBZVLMFLCNelUTTOw5.eRJD5gmQKktyokwOZ9hNQ42T2aA6', '0');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table comment
--
ALTER TABLE comment
  ADD CONSTRAINT comment_ibfk_2 FOREIGN KEY (idUser) REFERENCES user (id),
  ADD CONSTRAINT comment_ibfk_3 FOREIGN KEY (idPost) REFERENCES post (id) ON DELETE CASCADE;

--
-- Contraintes pour la table post
--
ALTER TABLE post
  ADD CONSTRAINT post_ibfk_1 FOREIGN KEY (idUser) REFERENCES user (id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
