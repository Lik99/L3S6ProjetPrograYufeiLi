-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-05-10 02:13:02
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
-- 数据库： `L3S6_ProjetProgrammation_film`
--

-- --------------------------------------------------------

--
-- 表的结构 `Avis`
--

CREATE TABLE `Avis` (
  `IdAvis` int(11) NOT NULL,
  `imageAvis` text NOT NULL,
  `commentaireAvis` text NOT NULL,
  `noteAvis` float NOT NULL,
  `IdUser` int(11) NOT NULL,
  `IdFilm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Avis`
--

INSERT INTO `Avis` (`IdAvis`, `imageAvis`, `commentaireAvis`, `noteAvis`, `IdUser`, `IdFilm`) VALUES
(18, 'imageAvis/659703b95c6a7_person-20.png', 'Commentaires: Pour tester la fonction de “avis“, le titre du Film est le suivant : Le Dernier Jour', 8, 1, 2),
(25, 'imageAvis/663cbde89e884_test.png', 'test function', 10, 1, 21),
(27, 'imageAvis/663cbe1cbd7bc_test.png', 'test test function111', 5, 1, 3),
(28, 'imageAvis/663ccdfe2740d_gravatar.jpg', 'TTTest', 10, 3, 4);

-- --------------------------------------------------------

--
-- 表的结构 `DejaVu`
--

CREATE TABLE `DejaVu` (
  `IdDejaVu` int(11) NOT NULL,
  `IdUser` int(11) DEFAULT NULL,
  `IdFilm` int(11) DEFAULT NULL,
  `dateEmprunt` date DEFAULT NULL,
  `dateRetour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `DejaVu`
--

INSERT INTO `DejaVu` (`IdDejaVu`, `IdUser`, `IdFilm`, `dateEmprunt`, `dateRetour`) VALUES
(50, 1, 21, '2024-05-09', '2024-05-24'),
(51, 1, 24, '2024-05-09', '2024-05-24'),
(52, 1, 3, '2024-05-09', '2024-05-24'),
(53, 1, 1, '2024-05-09', '2024-05-24'),
(54, 1, 12, '2024-05-09', '2024-05-24'),
(55, 1, 22, '2024-05-09', '2024-05-24'),
(56, 3, 4, '2024-05-09', '2024-05-24'),
(57, 3, 2, '2024-05-09', '2024-05-24');

-- --------------------------------------------------------

--
-- 表的结构 `Directeur`
--

CREATE TABLE `Directeur` (
  `IdDirecteur` int(11) NOT NULL,
  `nomDirecteur` varchar(20) NOT NULL,
  `prenomDirecteur` varchar(20) NOT NULL,
  `introDirecteur` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Directeur`
--

INSERT INTO `Directeur` (`IdDirecteur`, `nomDirecteur`, `prenomDirecteur`, `introDirecteur`) VALUES
(1, 'Christopher', 'Nolan', 'Ses films ont rapporté plus de 6 milliards de dollars dans le monde et ont obtenu de nombreuses distinctions. En 2015, Time le désigne comme l\'une des cent personnes les plus influentes dans le monde, tandis qu\'en 2019, il est nommé à l\'ordre de l\'Empire britannique par la reine Élisabeth II pour services rendus aux arts cinématographiques.'),
(2, 'Joon-ho', 'Bong', 'Bong Joon-ho est un réalisateur, scénariste et producteur de cinéma sud-coréen. Il est connu pour ses films captivants qui explorent souvent des thèmes sociaux et politiques.'),
(3, 'Tarantino', 'Quentin', 'Quentin Tarantino est un réalisateur, scénariste et producteur de cinéma américain. Il est célèbre pour son style distinctif, ses dialogues percutants et ses références cinématographiques.'),
(4, 'Nolan', 'Jonathan', 'Jonathan Nolan est un scénariste, réalisateur et producteur de cinéma américain. Il est surtout connu pour sa collaboration avec son frère Christopher Nolan sur plusieurs films à succès.'),
(5, 'Spielberg', 'Steven', 'Steven Spielberg est un réalisateur, scénariste et producteur de cinéma américain. Il est l\'un des réalisateurs les plus influents et les plus acclamés de l\'histoire du cinéma.'),
(6, 'Lee', 'Ang', 'Ang Lee est un réalisateur, producteur et scénariste taïwanais-américain. Il est reconnu pour sa diversité de genres cinématographiques et ses techniques innovantes.'),
(7, 'Wong', 'Kar-wai', 'Wong Kar-wai est un réalisateur, scénariste et producteur de cinéma hongkongais. Il est célèbre pour son style visuel distinctif et ses histoires poétiques.');

-- --------------------------------------------------------

--
-- 表的结构 `Film`
--

CREATE TABLE `Film` (
  `IdFilm` int(11) NOT NULL,
  `titreFilm` varchar(100) NOT NULL,
  `anneePubli` int(11) NOT NULL,
  `IdType` int(11) NOT NULL,
  `IdDirecteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Film`
--

INSERT INTO `Film` (`IdFilm`, `titreFilm`, `anneePubli`, `IdType`, `IdDirecteur`) VALUES
(1, 'The Imitation Game', 2014, 1, 1),
(2, 'Memento', 2000, 8, 1),
(3, 'The Host', 2006, 4, 1),
(4, 'Inception', 2010, 4, 1),
(5, 'Memories of Murder', 2003, 2, 2),
(6, 'Mother', 2009, 6, 2),
(7, 'The Spy Gone North', 2018, 8, 2),
(8, 'Parasite', 2019, 1, 2),
(9, 'Inglourious Basterds', 2009, 3, 3),
(10, 'Once Upon a Time in Hollywood', 2019, 6, 3),
(11, 'Reservoir Dogs', 1992, 8, 3),
(12, 'Django Unchained', 2012, 1, 3),
(13, 'The Dark Knight Rises', 2012, 5, 4),
(14, 'Westworld', 2016, 4, 4),
(15, 'Person of Interest', 2011, 8, 4),
(16, 'Interstellar', 2014, 4, 4),
(17, 'Saving Private Ryan', 1998, 3, 5),
(18, 'Jurassic Park', 1993, 4, 5),
(19, 'Schindler\'s List', 1993, 1, 5),
(20, 'E.T. the Extra-Terrestrial', 1982, 4, 5),
(21, 'Life of Pi', 2012, 1, 6),
(22, 'Brokeback Mountain', 2005, 1, 6),
(23, 'Crouching Tiger, Hidden Dragon', 2000, 4, 6),
(24, 'Hulk', 2003, 4, 6),
(25, 'Chungking Express', 1994, 7, 7),
(26, 'In the Mood for Love', 2000, 7, 7),
(27, 'Happy Together', 1997, 6, 7),
(28, '2046', 2004, 4, 7);

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
(1, 'film biographique'),
(2, 'thriller'),
(3, 'film de guerre'),
(4, 'film de science-fiction'),
(5, 'film de super-héros'),
(6, 'comédie'),
(7, 'documentaires pour adultes et enfants'),
(8, 'policier et espionnage'),
(10, 'film musical'),
(11, 'film de casse'),
(12, 'film historique');

-- --------------------------------------------------------

--
-- 表的结构 `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `IdUser` int(11) NOT NULL,
  `nomUser` varchar(20) NOT NULL,
  `prenomUser` varchar(20) NOT NULL,
  `passUser` int(11) NOT NULL,
  `Avatar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 转存表中的数据 `Utilisateur`
--

INSERT INTO `Utilisateur` (`IdUser`, `nomUser`, `prenomUser`, `passUser`, `Avatar`) VALUES
(1, 'Li', 'Yufei', 123, ''),
(2, 'Forger', 'Anya', 123, 'person-20.png'),
(3, 'tony', 'stark', 123, 'gravatar.jpg');

--
-- 转储表的索引
--

--
-- 表的索引 `Avis`
--
ALTER TABLE `Avis`
  ADD PRIMARY KEY (`IdAvis`),
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `IdFilm` (`IdFilm`);

--
-- 表的索引 `DejaVu`
--
ALTER TABLE `DejaVu`
  ADD PRIMARY KEY (`IdDejaVu`);

--
-- 表的索引 `Directeur`
--
ALTER TABLE `Directeur`
  ADD PRIMARY KEY (`IdDirecteur`);

--
-- 表的索引 `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`IdFilm`),
  ADD KEY `IdType` (`IdType`),
  ADD KEY `IdDirecteur` (`IdDirecteur`);

--
-- 表的索引 `Type`
--
ALTER TABLE `Type`
  ADD PRIMARY KEY (`IdType`);

--
-- 表的索引 `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`IdUser`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `Avis`
--
ALTER TABLE `Avis`
  MODIFY `IdAvis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `DejaVu`
--
ALTER TABLE `DejaVu`
  MODIFY `IdDejaVu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- 使用表AUTO_INCREMENT `Directeur`
--
ALTER TABLE `Directeur`
  MODIFY `IdDirecteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `Film`
--
ALTER TABLE `Film`
  MODIFY `IdFilm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用表AUTO_INCREMENT `Type`
--
ALTER TABLE `Type`
  MODIFY `IdType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
