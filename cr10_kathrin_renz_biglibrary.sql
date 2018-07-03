-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 03. Jul 2018 um 13:52
-- Server-Version: 10.1.33-MariaDB
-- PHP-Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr10_kathrin_renz_biglibrary`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `author`
--

CREATE TABLE `author` (
  `author_ID` int(11) NOT NULL,
  `authorFirstName` varchar(100) DEFAULT NULL,
  `authorLastName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `author`
--

INSERT INTO `author` (`author_ID`, `authorFirstName`, `authorLastName`) VALUES
(1, 'Wilfried', 'Schanz'),
(2, 'Lisa', 'Bauer'),
(3, 'Vanessa', 'Miller'),
(4, 'Karl Heinz', 'Hofer'),
(5, 'Theresa', 'Lemming');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE `customer` (
  `customer_ID` int(11) NOT NULL,
  `customerFirstName` varchar(100) DEFAULT NULL,
  `customerLastName` varchar(100) DEFAULT NULL,
  `customerZipCode` int(11) DEFAULT NULL,
  `customerAddress` varchar(255) DEFAULT NULL,
  `customerCity` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`customer_ID`, `customerFirstName`, `customerLastName`, `customerZipCode`, `customerAddress`, `customerCity`) VALUES
(1, 'Herbert', 'Maya', 1110, 'Etrichstraße 12', 'Wien'),
(2, 'Patricia', 'Laywer', 1190, 'Döblingerhauptstraße 222', 'Wien'),
(3, 'lena', 'Rupert', 1230, 'Siebenhirten 53', 'Wien'),
(4, 'Jaqueline', 'Tumau', 1210, 'Brünnerstraße 44', 'Wien'),
(5, 'Josef', 'Herzog', 1010, 'Am Graben 1', 'Wien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `genre`
--

CREATE TABLE `genre` (
  `genre_ID` int(11) NOT NULL,
  `genreType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `genre`
--

INSERT INTO `genre` (`genre_ID`, `genreType`) VALUES
(1, 'Education'),
(2, 'Fantasy'),
(3, 'Horror'),
(4, 'Action'),
(5, 'Romance');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE `media` (
  `isbn_ID` int(11) NOT NULL,
  `fk_publisher_ID` int(11) NOT NULL,
  `fk_status_ID` int(11) NOT NULL,
  `fk_genre_ID` int(11) NOT NULL,
  `fk_author_ID` int(11) NOT NULL,
  `fk_user_ID` int(11) NOT NULL,
  `mediaType` varchar(50) DEFAULT NULL,
  `mediaTitle` varchar(100) DEFAULT NULL,
  `mediaImage` varchar(255) DEFAULT NULL,
  `mediaDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `media`
--

INSERT INTO `media` (`isbn_ID`, `fk_publisher_ID`, `fk_status_ID`, `fk_genre_ID`, `fk_author_ID`, `fk_user_ID`, `mediaType`, `mediaTitle`, `mediaImage`, `mediaDescription`) VALUES
(1, 1, 2, 1, 1, 1, 'book', 'Coding 1x1', 'https://images-na.ssl-images-amazon.com/images/I/51sL8y8wRfL._SX258_BO1,204,203,200_.jpg', 'book about 1x1 of coding'),
(2, 4, 2, 2, 3, 3, 'DVD', 'Harry Potter', 'https://images-na.ssl-images-amazon.com/images/I/91y2gB9dgeL._SY445_.jpg', 'Nice movie for the family. A boy is attending a magic school and fights an evil magician'),
(3, 2, 2, 5, 2, 2, 'DVD', 'Titanic', 'https://images-na.ssl-images-amazon.com/images/I/51G3DHMV3AL._SY445_.jpg', 'Titanic is a ship.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `publisher`
--

CREATE TABLE `publisher` (
  `publisher_ID` int(11) NOT NULL,
  `publisherName` varchar(100) DEFAULT NULL,
  `publisherSize` varchar(50) DEFAULT NULL,
  `publisherDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `publisher`
--

INSERT INTO `publisher` (`publisher_ID`, `publisherName`, `publisherSize`, `publisherDate`) VALUES
(1, 'Rheinwerk', 'big', '1994-01-12'),
(2, 'Libri GmbH', 'small', '2010-12-01'),
(3, 'Whyley-VCH', 'medium', '2002-06-04'),
(4, 'DVD-Verlag', 'big', '1990-03-17'),
(5, 'CD-Verlag', 'big', '2017-04-19');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `status`
--

CREATE TABLE `status` (
  `status_ID` int(11) NOT NULL,
  `statusType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `status`
--

INSERT INTO `status` (`status_ID`, `statusType`) VALUES
(1, 'Available'),
(2, 'Reserved');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`user_ID`, `userName`, `userPassword`, `userEmail`) VALUES
(1, 'kata', '123456', '123@test.at');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_ID`);

--
-- Indizes für die Tabelle `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_ID`);

--
-- Indizes für die Tabelle `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_ID`);

--
-- Indizes für die Tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`isbn_ID`),
  ADD KEY `fk_publisher_ID` (`fk_publisher_ID`),
  ADD KEY `fk_status_ID` (`fk_status_ID`),
  ADD KEY `fk_genre_ID` (`fk_genre_ID`),
  ADD KEY `fk_author_ID` (`fk_author_ID`),
  ADD KEY `fk_user_ID` (`fk_user_ID`);

--
-- Indizes für die Tabelle `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_ID`);

--
-- Indizes für die Tabelle `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `author`
--
ALTER TABLE `author`
  MODIFY `author_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `media`
--
ALTER TABLE `media`
  MODIFY `isbn_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisher_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `status`
--
ALTER TABLE `status`
  MODIFY `status_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`customer_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints der Tabelle `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`fk_publisher_ID`) REFERENCES `publisher` (`publisher_ID`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`fk_status_ID`) REFERENCES `status` (`status_ID`),
  ADD CONSTRAINT `media_ibfk_3` FOREIGN KEY (`fk_genre_ID`) REFERENCES `genre` (`genre_ID`),
  ADD CONSTRAINT `media_ibfk_4` FOREIGN KEY (`fk_author_ID`) REFERENCES `author` (`author_ID`),
  ADD CONSTRAINT `media_ibfk_5` FOREIGN KEY (`fk_user_ID`) REFERENCES `user` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
