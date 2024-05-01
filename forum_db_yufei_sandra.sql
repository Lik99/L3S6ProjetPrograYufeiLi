-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-01-11 17:10:45
-- 服务器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `forum_db_yufei_sandra`
--

-- --------------------------------------------------------

--
-- 表的结构 `Auteur`
--

CREATE TABLE `Auteur` (
  `IdAuteur` int(11) NOT NULL,
  `nomAuteur` varchar(20) NOT NULL,
  `prenomAuteur` varchar(20) NOT NULL,
  `introAuteur` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Auteur`
--

INSERT INTO `Auteur` (`IdAuteur`, `nomAuteur`, `prenomAuteur`, `introAuteur`) VALUES
(1, 'Victor', 'Hugo', 'Victor Hugo est l\'un des écrivains français les plus célèbres. Avec une carrière de plus de 60 ans, il a tout écrit, de la poésie à la satire, en passant par des essais critiques et des odyssées historiques.'),
(2, 'Alexandre', 'Dumas', 'Alexandre Dumas (dit aussi Alexandre Dumas père) est un écrivain français né le 5 thermidor an X (24 juillet 1802) à Villers-Cotterêts (Aisne) et mort le 5 décembre 1870 au hameau de Puys, ancienne commune de Neuville-lès-Dieppe, aujourd\'hui intégrée à Dieppe (Seine-Maritime).'),
(3, 'Arouet', 'François-Marie', 'Voltaire, de son vrai nom François-Marie Arouet, né le 21 novembre 1694 à Paris où il est mort le 30 mai 1778, est un écrivain, notamment dramaturge et poète, et un philosophen 1 et encyclopédiste français, figure majeure de la philosophie des Lumières, jouissant de son vivant d\'une célébrité internationale.'),
(4, 'Balzac', 'Honoré', 'Honoré de Balzac, nom de plume d\'Honoré Balzacn 1, né le 20 mai 1799 (1er prairial an VII du calendrier républicain) à Tours et mort le 18 août 1850 à Paris, est un écrivain français. Romancier, critique d\'art, dramaturge, critique littéraire, essayiste, journaliste et imprimeur, il a laissé l\'une des plus imposantes œuvres romanesques de la littérature française, avec plus de quatre-vingt-dix romans et nouvelles parus de 1829 à 1855, réunis sous le titre de La Comédie humaine. À cela s\'ajoutent Les Cent Contes drolatiques, ainsi que des romans de jeunesse publiés sous des pseudonymes et quelque vingt-cinq œuvres ébauchées.'),
(5, 'Sand', 'George', 'George Sand, nom de plume d\'Amantine Aurore Lucile Dupin de Francueil, par mariage baronne Dudevant, est une romancière, dramaturge, épistolière, critique littéraire et journaliste française, née le 1er juillet 1804 à Paris et morte le 8 juin 1876 au château de Nohant-Vic. Elle compte parmi les écrivains les plus prolifiques, avec plus de 70 romans à son actif et 50 volumes d\'œuvres diverses dont des nouvelles, des contes, des pièces de théâtre et des textes politiques.'),
(6, 'Zola', 'Emile', 'Émile Zola est un écrivain et journaliste français, né le 2 avril 1840 à Paris et mort le 29 septembre 1902 dans la même ville. Considéré comme le chef de file du naturalisme, c\'est l\'un des romanciers français les plus populaires3, les plus publiés, traduits et commentés dans le monde entier. Il a durablement marqué de son empreinte le monde littéraire français. Ses romans ont connu de très nombreuses adaptations au cinéma et à la télévisionN 1.'),
(7, 'Saint-Exupéry', 'Antoine', 'Antoine de Saint-Exupéry, né le 29 juin 1900 à Lyon2 et disparu en vol le 31 juillet 1944 au large des côtes marseillaises, est un écrivain, poète, aviateur et reporter français.');

-- --------------------------------------------------------

--
-- 表的结构 `Avis`
--

CREATE TABLE `Avis` (
  `IdAvis` int(11) NOT NULL,
  `imageAvis` text NOT NULL,
  `commentaireAvis` text NOT NULL,
  `noteAvis` float NOT NULL,
  `IdEtu` int(11) NOT NULL,
  `IdLivre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Avis`
--

INSERT INTO `Avis` (`IdAvis`, `imageAvis`, `commentaireAvis`, `noteAvis`, `IdEtu`, `IdLivre`) VALUES
(12, 'imageAvis/6596ed5615ded_111.jpeg', 'Pour tester la fonction de “avis“, le titre du livre est le suivant :  La Princesse de Babylone', 8, 1, 12),
(13, 'imageAvis/6596ed648d1cb_111.jpeg', 'Pour tester la fonction de “avis“, le titre du livre est le suivant : Micromégas ', 7, 1, 11),
(14, 'imageAvis/6596ed77df872_111.jpeg', 'Pour tester la fonction de “avis“, le titre du livre est le suivant :Songe de Platon ', 5, 1, 10),
(15, 'imageAvis/6596ed88dd4af_111.jpeg', 'Pour tester la fonction de “avis“, le titre du livre est le suivant : Les Feuilles d_automne ', 5, 1, 3),
(16, 'imageAvis/6596ed989966e_111.jpeg', 'Pour tester la fonction de “avis“, le titre du livre est le suivant : Les Travailleurs de la mer', 6, 1, 6),
(18, 'imageAvis/659703b95c6a7_person-20.png', 'Commentaires: Pour tester la fonction de “avis“, le titre du livre est le suivant : Le Dernier Jour', 8, 1, 2),
(19, 'imageAvis/659703cc23900_Loid.png', 'Commentaires: Pour tester la fonction de “avis“, le titre du livre est le suivant : Miserables', 9, 1, 5);

-- --------------------------------------------------------

--
-- 表的结构 `Emprunter`
--

CREATE TABLE `Emprunter` (
  `IdEmprunt` int(11) NOT NULL,
  `IdEtu` int(11) DEFAULT NULL,
  `IdLivre` int(11) DEFAULT NULL,
  `dateEmprunt` date DEFAULT NULL,
  `dateRetour` date DEFAULT NULL,
  `retourne` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `Emprunter`
--

INSERT INTO `Emprunter` (`IdEmprunt`, `IdEtu`, `IdLivre`, `dateEmprunt`, `dateRetour`, `retourne`) VALUES
(12, 1, 2, '2024-01-03', '2024-01-18', 1),
(13, 1, 4, '2024-01-03', '2024-01-18', 1),
(14, 1, 3, '2024-01-03', '2024-01-18', 1),
(15, 1, 6, '2024-01-03', '2024-01-18', 1),
(16, 1, 2, '2024-01-03', '2024-01-18', 1),
(17, 1, 2, '2024-01-03', '2024-01-18', 1),
(18, 1, 2, '2024-01-03', '2024-01-18', 1),
(19, 1, 4, '2024-01-03', '2024-01-18', 1),
(20, 1, 2, '2024-01-03', '2024-01-18', 1),
(21, 1, 4, '2024-01-03', '2024-01-18', 1),
(22, 1, 2, '2024-01-03', '2024-01-18', 1),
(23, 1, 3, '2024-01-03', '2024-01-18', 1),
(24, 1, 2, '2024-01-03', '2024-01-18', 1),
(25, 1, 4, '2024-01-03', '2024-01-18', 1),
(26, 1, 3, '2024-01-03', '2024-01-18', 1),
(27, 1, 12, '2024-01-04', '2024-01-19', 1),
(28, 1, 11, '2024-01-04', '2024-01-19', 1),
(29, 1, 10, '2024-01-04', '2024-01-19', 1),
(30, 1, 3, '2024-01-04', '2024-01-19', 1),
(31, 1, 6, '2024-01-04', '2024-01-19', 1),
(32, 1, 5, '2024-01-04', '2024-01-19', 1),
(33, 2, 2, '2024-01-04', '2024-01-19', 0),
(34, 2, 4, '2024-01-04', '2024-01-19', 0),
(35, 1, 14, '2024-01-04', '2024-01-19', 1),
(36, 1, 6, '2024-01-04', '2024-01-19', 1),
(37, 1, 5, '2024-01-10', '2024-01-25', 1),
(38, 1, 17, '2024-01-10', '2024-01-25', 1),
(39, 1, 2, '2024-01-10', '2024-01-25', 1),
(40, 1, 19, '2024-01-10', '2024-01-25', 1),
(41, 1, 9, '2024-01-10', '2024-01-25', 0);

-- --------------------------------------------------------

--
-- 表的结构 `Etudiant`
--

CREATE TABLE `Etudiant` (
  `IdEtu` int(11) NOT NULL,
  `nomEtu` varchar(20) NOT NULL,
  `prenomEtu` varchar(20) NOT NULL,
  `passEtu` int(11) NOT NULL,
  `Avatar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Etudiant`
--

INSERT INTO `Etudiant` (`IdEtu`, `nomEtu`, `prenomEtu`, `passEtu`, `Avatar`) VALUES
(1, 'Li', 'Yufei', 123, ''),
(2, 'Forger', 'Anya', 123, 'person-20.png');

-- --------------------------------------------------------

--
-- 表的结构 `Livre`
--

CREATE TABLE `Livre` (
  `IdLivre` int(11) NOT NULL,
  `titreLivre` varchar(100) NOT NULL,
  `anneePubli` int(11) NOT NULL,
  `IdType` int(11) NOT NULL,
  `IdAuteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Livre`
--

INSERT INTO `Livre` (`IdLivre`, `titreLivre`, `anneePubli`, `IdType`, `IdAuteur`) VALUES
(2, 'Le Dernier Jour d_un condamné', 1829, 1, 1),
(3, 'Les Feuilles d_automne ', 1832, 10, 1),
(4, 'Les Chants du crépuscule ', 1835, 10, 1),
(5, 'Misérables', 1862, 1, 1),
(6, 'Les Travailleurs de la mer', 1866, 1, 1),
(7, 'Les Trois Mousquetaires', 1844, 1, 2),
(8, 'Vingt Ans après', 1845, 1, 2),
(9, 'Le Vicomte de Bragelonne', 1847, 1, 2),
(10, 'Songe de Platon', 1756, 11, 3),
(11, 'Micromégas', 1752, 11, 3),
(12, 'La Princesse de Babylone', 1768, 11, 3),
(13, 'Le Vicaire des Ardennes ', 1822, 1, 4),
(14, 'Jésus-Christ en Flandre', 1846, 1, 4),
(15, 'Cosima ou la Haine dans l\'amour ', 1840, 12, 5),
(16, 'Molière ', 1851, 12, 5),
(17, 'Contes à Ninon', 1878, 1, 6),
(18, 'Nantas ', 1878, 1, 6),
(19, 'Le Petit Prince', 1946, 1, 7);

-- --------------------------------------------------------

--
-- 表的结构 `Type`
--

CREATE TABLE `Type` (
  `IdType` int(11) NOT NULL,
  `nomType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Type`
--

INSERT INTO `Type` (`IdType`, `nomType`) VALUES
(1, 'Roman'),
(2, 'BD'),
(3, 'Mangas'),
(4, 'Comics'),
(5, 'Livres jeunesse'),
(6, 'Livres sciences humans'),
(7, 'Livres vie pratique'),
(8, 'Loisirs Nature Voyage'),
(10, 'Poésie'),
(11, 'Philosophiques'),
(12, 'Pièces de théâtre');

--
-- 转储表的索引
--

--
-- 表的索引 `Auteur`
--
ALTER TABLE `Auteur`
  ADD PRIMARY KEY (`IdAuteur`);

--
-- 表的索引 `Avis`
--
ALTER TABLE `Avis`
  ADD PRIMARY KEY (`IdAvis`),
  ADD KEY `IdEtu` (`IdEtu`),
  ADD KEY `IdLivre` (`IdLivre`);

--
-- 表的索引 `Emprunter`
--
ALTER TABLE `Emprunter`
  ADD PRIMARY KEY (`IdEmprunt`);

--
-- 表的索引 `Etudiant`
--
ALTER TABLE `Etudiant`
  ADD PRIMARY KEY (`IdEtu`);

--
-- 表的索引 `Livre`
--
ALTER TABLE `Livre`
  ADD PRIMARY KEY (`IdLivre`),
  ADD KEY `IdType` (`IdType`),
  ADD KEY `IdAuteur` (`IdAuteur`);

--
-- 表的索引 `Type`
--
ALTER TABLE `Type`
  ADD PRIMARY KEY (`IdType`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `Auteur`
--
ALTER TABLE `Auteur`
  MODIFY `IdAuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `Avis`
--
ALTER TABLE `Avis`
  MODIFY `IdAvis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `Emprunter`
--
ALTER TABLE `Emprunter`
  MODIFY `IdEmprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- 使用表AUTO_INCREMENT `Etudiant`
--
ALTER TABLE `Etudiant`
  MODIFY `IdEtu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `Livre`
--
ALTER TABLE `Livre`
  MODIFY `IdLivre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用表AUTO_INCREMENT `Type`
--
ALTER TABLE `Type`
  MODIFY `IdType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
