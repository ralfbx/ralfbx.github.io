-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 14, 2022 at 10:06 PM
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
-- Database: `pizzeria`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelId` int(10) NOT NULL,
  `klantId` int(10) DEFAULT NULL,
  `datumEnTijdstip` datetime NOT NULL,
  `totaalPrijs` float NOT NULL,
  `informatie` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestellingen`
--

INSERT INTO `bestellingen` (`bestelId`, `klantId`, `datumEnTijdstip`, `totaalPrijs`, `informatie`) VALUES
(4, 13, '2022-03-14 19:54:11', 0, 'Veggie a.u.b !'),
(5, 13, '2022-03-14 19:58:37', 8, 'Veggie a.u.b !'),
(6, 13, '2022-03-14 19:59:58', 8, 'Veggie a.u.b !'),
(7, 13, '2022-03-14 20:01:54', 8, 'Veggie a.u.b !'),
(8, 13, '2022-03-14 20:02:49', 8, 'Veggie a.u.b !'),
(11, 3, '2022-03-14 20:16:50', 10, '/'),
(12, 10, '2022-03-14 20:30:15', 8, '/'),
(13, 10, '2022-03-14 21:18:19', 8, '/'),
(14, 10, '2022-03-14 21:19:07', 8, '/'),
(19, 10, '2022-03-14 21:46:44', 10, '/'),
(20, 10, '2022-03-14 21:48:58', 10, '/');

-- --------------------------------------------------------

--
-- Table structure for table `bestelregels`
--

CREATE TABLE `bestelregels` (
  `bestelregelId` int(10) NOT NULL,
  `bestelId` int(10) NOT NULL,
  `productId` int(10) NOT NULL,
  `aantal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestelregels`
--

INSERT INTO `bestelregels` (`bestelregelId`, `bestelId`, `productId`, `aantal`) VALUES
(1, 4, 1, 1),
(2, 5, 1, 1),
(3, 6, 1, 1),
(4, 7, 1, 1),
(5, 8, 1, 1),
(6, 11, 2, 1),
(7, 12, 1, 1),
(8, 13, 1, 1),
(9, 14, 1, 1),
(10, 19, 2, 1),
(11, 20, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int(10) NOT NULL,
  `klantNaam` varchar(50) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `straat` varchar(50) NOT NULL,
  `straatnummer` int(10) NOT NULL,
  `plaatsId` int(10) NOT NULL,
  `telefoon` varchar(20) NOT NULL,
  `bemerkingen` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `korting` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`klantId`, `klantNaam`, `voornaam`, `straat`, `straatnummer`, `plaatsId`, `telefoon`, `bemerkingen`, `email`, `wachtwoord`, `korting`) VALUES
(2, 'Nidas', 'Leo', 'Kleingentstraat', 6, 3, '0492 56 87 19', 'Geen tomaten a.u.b.', 'leonidas@gmail.com', '$2y$10$JtxP8L6k5516pLahge/xa.tkUpeNRotblOG00S1kS9w3/GL40J34.', 1),
(3, 'Symons', 'Barbara', 'Domien Geerstraat', 14, 11, '0493 38 41 06', '/', 'symonsbarbara@gmail.com', '$2y$10$43Vxg0PeMhAk4XJ3YgF91OWUHb0wKDoWsvT1qXE/yH9LY/sAJ05LK', 1),
(4, 'Donker', 'Mark', 'Maurits Sabbestraat ', 12, 5, '089 838 875', '/', 'markdonker@hotmail.com', '$2y$10$lJwNhWBR3xGhEBxr6x/cPu8DuS5/rDW/8UlR4wWyXQrKS.x/WddWq', 0),
(5, 'Vanden Bussche', 'Dirk', 'Kleine Kerkstraat', 10, 6, '0645 67 98 35', 'Geen mozzarella !!', 'vandenbussche.d@gent.com', '$2y$10$VoELNBE/u8owAwwjXfpyoOXe2oaHhGmWZhqOlQ5zJOJ48FTTXtK7q', 0),
(6, 'Janssens', 'Veerle', 'Damaststraat', 56, 8, '078 628 935', '/', 'veerlejanssens@gmail.com', '$2y$10$bIF/Zpo0rjlqa3Nh0TNmeOtErqna//2Pr5vCbuBPzbDBSfOfd5CWa', 1),
(7, 'De Rijck', 'Jan', 'Driesstraat', 67, 4, '0956 29 76 48', 'Glutenvrij !!! ', 'derijckjan@gmail.com', '$2y$10$v1EjmS1TOETjjybUKrAkkeZSDAIEZ0a4gAT/1cqOqMs5l3ZmOrBXK', 0),
(8, 'de Witte', 'Karl', 'Onderstraat', 7, 1, '089 639 311', '/', 'kdewittesss@gmail.com', '$2y$10$E7KIKgYGwLmUeGaHtC3.luKriNue0qAxN5rN3LWzrkQrve56URqEq', 0),
(9, 'Bruggemans', 'Anne', 'Lepenstraat', 44, 1, '0761 455 754', '/', 'annebruggemans@protonmail.com', '$2y$10$DC21jKSoqAa47LJyJnooXeoiMt8wfaZg75s9BRQ6fLLkP2qzOt7aW', 1),
(10, 'Johnson', 'Lewis', 'Dapperheidstraat', 15, 1, '0892 53 87 56', '/', 'johnsonlewis@gmail.com', '$2y$10$JJMTms34vXzcWsfW.uxSg.ZiruAOVbSt.tIFCuuoQSmCovfZgn4ze', 0),
(11, 'Eda', 'Sam', 'Schoolstraat', 67, 2, '0496 73 51 11', 'Veggie versie ???', 'sameda@gmail.com', '$2y$10$cVwBlezIiK0IFVVNnC41Pu4aTDh5AwOp4tqiAr0l8LLsDZtVDASs6', 0),
(12, 'Dickens', 'Sebastien', 'Destelbergenstraat', 67, 2, '0878 675 923', '/', 'dickenssebastien@hotmail.com', '$2y$10$.7yGdQy3pxCxRzTZvMXfiOb008LoqaZorBAUSkN5Y.J2ynVs7qKDe', 0),
(13, 'Francis', 'Erik', 'Kortrijksesteenweg', 564, 1, '0943 76 34 04', 'Veggie a.u.b !', 'erikfrancis@gmail.com', '$2y$10$xx2kT546qndYIGX4bBf04.50nl24TM1Olxu1gazSzDeZB.WlZ9cNm', 0),
(14, 'Devuyst', 'Cedric', 'Drongenplein', 89, 9, '098 54 76 20', '/', 'cedricdevuyst@gmail.com', '$2y$10$d.uBolld2.9RivL3/mOeH.3OqcNsBkluPjrQm4YsQx59UykxctkrO', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plaatsen`
--

CREATE TABLE `plaatsen` (
  `plaatsId` int(10) NOT NULL,
  `postcode` int(10) NOT NULL,
  `gemeente` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plaatsen`
--

INSERT INTO `plaatsen` (`plaatsId`, `postcode`, `gemeente`) VALUES
(1, 9000, 'Gent'),
(2, 9040, 'Sint-Amandsberg'),
(3, 9070, 'Destelbergen'),
(4, 9090, 'Melle'),
(5, 9820, 'Merelbeke'),
(6, 9050, 'Gentbrugge'),
(7, 9051, 'Afsnee'),
(8, 9030, 'Mariakerke'),
(9, 9031, 'Drongen'),
(10, 9032, 'Wondelgem'),
(11, 9041, 'Oostakker'),
(12, 9042, 'Desteldonk'),
(13, 9052, 'Zwijnaarde');

-- --------------------------------------------------------

--
-- Table structure for table `producten`
--

CREATE TABLE `producten` (
  `productId` int(10) NOT NULL,
  `productNaam` varchar(50) NOT NULL,
  `beeldNaam` varchar(50) NOT NULL,
  `kostPrijs` float NOT NULL,
  `promo` float NOT NULL,
  `samenstelling` varchar(250) NOT NULL,
  `voedingswaarde` varchar(50) NOT NULL,
  `beschikbaarheid` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producten`
--

INSERT INTO `producten` (`productId`, `productNaam`, `beeldNaam`, `kostPrijs`, `promo`, `samenstelling`, `voedingswaarde`, `beschikbaarheid`) VALUES
(1, 'MARINARA', 'marinara', 8, 7, 'tomaat - knoflook - oregano - extra vergine olijfolie', '650 kcal', 1),
(2, 'COSACCA', 'cosacca', 10, 8, 'tomaat - oregano - dubbele pecorino romano - basilicum', '700 kcal', 1),
(3, 'MARGHERITA', 'margherita', 10, 8, 'tomaat - mozzarella - verse basilicum - extra vergine olijfolie', '800 kcal', 1),
(4, 'NAPOLI', 'napoli', 14, 12, 'tomaat - mozzarella - ansjovis in olie - Extra Vierge Olijfolie', '900 kcal', 1),
(5, 'CAPRICCIOSA', 'capricciosa', 16, 14, 'tomaat - mozzarella - verse champignons - Parmaham - zwarte olijven - heel hardgekookt ei', '850 kcal', 1),
(6, 'DIAVOLA', 'diavola', 16, 14, 'tomaat - mozzarella - pikante salami - Spilinga n’duja - zwarte olijven - basilicum', '950 kcal', 1),
(7, 'STRACCIATA', 'stracciata', 16, 14, 'tomaat - stracciatella - basilicum', '800 kcal', 1),
(8, 'BURRATA E ALICI', 'burrata_e_alici', 18, 16, 'tomaat - burrata - ansjovis in olie - basilicum', '900 kcal', 1),
(9, 'PROSCIUTTO CRUDO', 'prosciuttocrudo', 14, 12, 'tomaat - mozzarella - rauwe ham', '750 kcal', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelId`),
  ADD KEY `klantId` (`klantId`);

--
-- Indexes for table `bestelregels`
--
ALTER TABLE `bestelregels`
  ADD PRIMARY KEY (`bestelregelId`),
  ADD KEY `bestelId` (`bestelId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`),
  ADD KEY `plaatsId` (`plaatsId`);

--
-- Indexes for table `plaatsen`
--
ALTER TABLE `plaatsen`
  ADD PRIMARY KEY (`plaatsId`);

--
-- Indexes for table `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `beeldNaam_2` (`beeldNaam`),
  ADD KEY `beeldNaam` (`beeldNaam`(10)) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bestelregels`
--
ALTER TABLE `bestelregels`
  MODIFY `bestelregelId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `plaatsen`
--
ALTER TABLE `plaatsen`
  MODIFY `plaatsId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `producten`
--
ALTER TABLE `producten`
  MODIFY `productId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klanten` (`klantId`);

--
-- Constraints for table `bestelregels`
--
ALTER TABLE `bestelregels`
  ADD CONSTRAINT `bestelregels_ibfk_1` FOREIGN KEY (`bestelId`) REFERENCES `bestellingen` (`bestelId`),
  ADD CONSTRAINT `bestelregels_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `producten` (`productId`);

--
-- Constraints for table `klanten`
--
ALTER TABLE `klanten`
  ADD CONSTRAINT `klanten_ibfk_1` FOREIGN KEY (`plaatsId`) REFERENCES `plaatsen` (`plaatsId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
