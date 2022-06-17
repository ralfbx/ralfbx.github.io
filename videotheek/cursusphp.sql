-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 24, 2022 at 01:57 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cursusphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cursisten`
--

CREATE TABLE `cursisten` (
  `cursistId` int(11) NOT NULL,
  `familienaam` varchar(50) NOT NULL,
  `voornaam` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gastenboek`
--

CREATE TABLE `gastenboek` (
  `id` int(10) UNSIGNED NOT NULL,
  `auteur` varchar(45) NOT NULL,
  `boodschap` varchar(250) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gastenboek`
--

INSERT INTO `gastenboek` (`id`, `auteur`, `boodschap`, `datum`) VALUES
(2, 'Bezoeker', 'Even testen of het gastenboek werkt...', '2010-05-11 09:22:44'),
(3, 'Admin', 'Het werkt inderdaad.', '2010-05-11 09:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(10) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `gebruikersnaam`, `wachtwoord`) VALUES
(1, 'Tom', 'GYjfhd89'),
(2, 'Dirk', 'fdjhlkm'),
(3, 'Lars', 'hgljkhgfg'),
(4, 'Linda', 'fdghjj'),
(5, 'Martha', 'qgtrhj'),
(6, 'Gert', 'cdcfs'),
(7, 'Susan', 'lgfgbdfvd'),
(8, 'Francis', 'ghfgkfhgdsq'),
(9, 'Michiel', 'lefghsfe'),
(10, 'Max', 'cscvsve'),
(11, 'Steve', 'dffsdv'),
(12, 'Sonia', 'ghjshll'),
(13, 'Bert', 'dsfgdhf');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `naam` varchar(50) NOT NULL,
  `prijs` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `naam`, `prijs`) VALUES
(1, 'Programmatielogica', 75),
(2, 'Computers en netwerken', 130),
(4, 'SQL', 99.9),
(5, 'Objectgeoriënteerde principes', 85),
(6, 'Javascript / DOM', 140),
(7, 'JQuery', 120),
(8, 'UML', 90),
(9, 'PHP', 140),
(11, 'XHTML/CSS', 120);

-- --------------------------------------------------------

--
-- Table structure for table `mvc_boeken`
--

CREATE TABLE `mvc_boeken` (
  `id` int(3) NOT NULL,
  `titel` varchar(100) NOT NULL,
  `genre_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mvc_boeken`
--

INSERT INTO `mvc_boeken` (`id`, `titel`, `genre_id`) VALUES
(2, 'Het verrotte leven van Floortje Bloem', 1),
(3, 'In hechtenis', 2),
(4, 'Spiegelbeeld', 6),
(5, 'De avonturen van een jonge bioloog', 8),
(6, 'Hij hoort bij jou', 10),
(7, 'Het verraad van Anne Frank', 9),
(8, 'De lijst van de rechter', 6),
(9, 'Moord in de Oriënt-Expres', 2),
(11, 'Duin', 3),
(12, 'De zonde waard', 6),
(13, 'Het Bucketlist boek voor koppels', 7),
(14, 'Barbarossa', 9),
(15, 'Het negende huis', 5),
(16, 'Het Spel Der Tronen', 4),
(17, 'Al Capone', 8),
(18, 'Het (It)', 5),
(19, 'Rood, wit en koningsblauw', 10),
(21, 'The Expanse 1 - Leviathan ontwaakt', 3),
(22, 'Hoe dan?', 7),
(23, ' Het Laatste Rijk', 4),
(24, 'Gentleman Burglar', 2),
(25, '1984', 3),
(27, 'Vlammen', 10),
(28, 'Het dagboek van Bridget Jones', 7);

-- --------------------------------------------------------

--
-- Table structure for table `mvc_genres`
--

CREATE TABLE `mvc_genres` (
  `id` int(3) NOT NULL,
  `genre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mvc_genres`
--

INSERT INTO `mvc_genres` (`id`, `genre`) VALUES
(1, 'liefdesverhalen'),
(2, 'detective'),
(3, 'science fiction'),
(4, 'fantasy'),
(5, 'horrorverhalen'),
(6, 'thrillers'),
(7, 'humor'),
(8, 'biografie'),
(9, 'oorlog'),
(10, 'young adult');

-- --------------------------------------------------------

--
-- Table structure for table `oef_films`
--

CREATE TABLE `oef_films` (
  `id` int(10) UNSIGNED NOT NULL,
  `titel` varchar(150) NOT NULL,
  `duurtijd` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oef_films`
--

INSERT INTO `oef_films` (`id`, `titel`, `duurtijd`) VALUES
(1, 'Shawshank Redemption, The', 142),
(2, 'Godfather, The', 168),
(3, 'Green Mile, The', 188),
(4, 'Pulp Fiction', 154),
(5, 'Once Upon a Time in the West', 165),
(6, 'Lord of the Rings: The Return of the King, The', 201),
(7, 'Se7en', 127),
(8, 'Schindler\'s List', 195),
(9, 'Forrest Gump', 142);

-- --------------------------------------------------------

--
-- Table structure for table `personen`
--

CREATE TABLE `personen` (
  `id` int(10) UNSIGNED NOT NULL,
  `familienaam` varchar(50) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `geboortedatum` date NOT NULL,
  `geslacht` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personen`
--

INSERT INTO `personen` (`id`, `familienaam`, `voornaam`, `geboortedatum`, `geslacht`) VALUES
(1, 'Peeters', 'Bram', '1976-01-19', 'M'),
(2, 'Van Dessel', 'Rudy', '1969-10-05', 'M'),
(3, 'Vereecken', 'Marie', '1981-05-23', 'V'),
(4, 'Maes', 'Eveline', '1983-08-16', 'V'),
(5, 'Vangeel', 'Joke', '1976-05-22', 'V'),
(6, 'Van Heule', 'Pieter', '1968-03-02', 'M'),
(7, 'Naessens', 'Katleen', '1984-05-12', 'V'),
(8, 'Sleeuwaert', 'Koen', '1957-02-25', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `spaarders`
--

CREATE TABLE `spaarders` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `spaarpot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spaarders`
--

INSERT INTO `spaarders` (`id`, `naam`, `spaarpot`) VALUES
(1, 'Jan', 0),
(2, 'Piet', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `wachtwoord`) VALUES
(1, 'tomanders@gmail.com', '$2y$10$DGaKTBCsdrV.kVLtImrLUOaugFifLIfRLNX5ggcWSl3n7xSUrXE/.');

-- --------------------------------------------------------

--
-- Table structure for table `VID_Ex`
--

CREATE TABLE `VID_Ex` (
  `exemplaarId` int(11) NOT NULL,
  `aanwezig` tinyint(4) NOT NULL DEFAULT '0',
  `filmId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `VID_Ex`
--

INSERT INTO `VID_Ex` (`exemplaarId`, `aanwezig`, `filmId`) VALUES
(1, 1, 2),
(2, 0, 1),
(3, 0, 2),
(4, 1, 2),
(6, 1, 1),
(7, 1, 10),
(8, 0, 8),
(9, 1, 7),
(10, 1, 9),
(11, 0, 8),
(12, 1, 13),
(13, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `VID_films`
--

CREATE TABLE `VID_films` (
  `filmId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `VID_films`
--

INSERT INTO `VID_films` (`filmId`, `title`) VALUES
(1, 'Monos'),
(2, 'The Lighthouse'),
(7, 'Victoria'),
(8, 'La Grande Bellazza'),
(9, 'Dealer'),
(10, 'First Reformed'),
(13, 'The Neon Demon');

-- --------------------------------------------------------

--
-- Table structure for table `vieropeenrij_spelbord`
--

CREATE TABLE `vieropeenrij_spelbord` (
  `rijnummer` smallint(5) UNSIGNED NOT NULL,
  `kolomnummer` smallint(5) UNSIGNED NOT NULL,
  `status` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vieropeenrij_spelbord`
--

INSERT INTO `vieropeenrij_spelbord` (`rijnummer`, `kolomnummer`, `status`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 0),
(1, 6, 0),
(1, 7, 0),
(2, 1, 0),
(2, 2, 0),
(2, 3, 0),
(2, 4, 0),
(2, 5, 0),
(2, 6, 0),
(2, 7, 0),
(3, 1, 0),
(3, 2, 0),
(3, 3, 0),
(3, 4, 0),
(3, 5, 0),
(3, 6, 0),
(3, 7, 0),
(4, 1, 0),
(4, 2, 0),
(4, 3, 0),
(4, 4, 0),
(4, 5, 0),
(4, 6, 0),
(4, 7, 0),
(5, 1, 0),
(5, 2, 0),
(5, 3, 0),
(5, 4, 0),
(5, 5, 0),
(5, 6, 0),
(5, 7, 0),
(6, 1, 0),
(6, 2, 0),
(6, 3, 0),
(6, 4, 0),
(6, 5, 0),
(6, 6, 0),
(6, 7, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cursisten`
--
ALTER TABLE `cursisten`
  ADD PRIMARY KEY (`cursistId`);

--
-- Indexes for table `gastenboek`
--
ALTER TABLE `gastenboek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mvc_boeken`
--
ALTER TABLE `mvc_boeken`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_genreid` (`genre_id`);

--
-- Indexes for table `mvc_genres`
--
ALTER TABLE `mvc_genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oef_films`
--
ALTER TABLE `oef_films`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personen`
--
ALTER TABLE `personen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spaarders`
--
ALTER TABLE `spaarders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `VID_Ex`
--
ALTER TABLE `VID_Ex`
  ADD PRIMARY KEY (`exemplaarId`),
  ADD KEY `filmId` (`filmId`);

--
-- Indexes for table `VID_films`
--
ALTER TABLE `VID_films`
  ADD PRIMARY KEY (`filmId`);

--
-- Indexes for table `vieropeenrij_spelbord`
--
ALTER TABLE `vieropeenrij_spelbord`
  ADD PRIMARY KEY (`rijnummer`,`kolomnummer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cursisten`
--
ALTER TABLE `cursisten`
  MODIFY `cursistId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gastenboek`
--
ALTER TABLE `gastenboek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mvc_boeken`
--
ALTER TABLE `mvc_boeken`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `mvc_genres`
--
ALTER TABLE `mvc_genres`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `oef_films`
--
ALTER TABLE `oef_films`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personen`
--
ALTER TABLE `personen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `spaarders`
--
ALTER TABLE `spaarders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `VID_Ex`
--
ALTER TABLE `VID_Ex`
  MODIFY `exemplaarId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `VID_films`
--
ALTER TABLE `VID_films`
  MODIFY `filmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mvc_boeken`
--
ALTER TABLE `mvc_boeken`
  ADD CONSTRAINT `FK_genreid` FOREIGN KEY (`genre_id`) REFERENCES `mvc_genres` (`id`);

--
-- Constraints for table `VID_Ex`
--
ALTER TABLE `VID_Ex`
  ADD CONSTRAINT `vid_ex_ibfk_1` FOREIGN KEY (`filmId`) REFERENCES `VID_films` (`filmId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
