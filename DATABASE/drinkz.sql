-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2017 at 10:14 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `drinkz`
--
CREATE DATABASE IF NOT EXISTS `drinkz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `drinkz`;

-- --------------------------------------------------------

--
-- Table structure for table `tblbars`
--

CREATE TABLE IF NOT EXISTS `tblbars` (
  `barid` int(255) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `gemeente` varchar(255) NOT NULL,
  `postcode` int(255) NOT NULL,
  `straat` varchar(255) NOT NULL,
  `nummer` int(255) NOT NULL,
  `type` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`barid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tblbars`
--

INSERT INTO `tblbars` (`barid`, `naam`, `gemeente`, `postcode`, `straat`, `nummer`, `type`, `image`) VALUES
(1, 'Den osse', 'gullegem', 8560, 'Bankstraat', 2, 0, 'images/bars/bar1.jpg'),
(2, 'Coffeebar Tkofietjen', 'gullegem', 8560, 'Bankstraat', 2, 1, 'images/bars/coffeebar1.jpg'),
(3, 'Tearoom Pannenkoek', 'Gullegem', 8560, 'Bankstraat', 2, 2, 'images/bars/tearoom3.png'),
(4, 'Op den hoek', 'Gullegem', 8560, 'Bankstraat', 2, 3, 'images/bars/studentbar1.jpg'),
(5, 'Den dancing', 'Gent', 3254, 'Beekstraat, 412', 2, 4, 'images/bars/dancebar1.jpg'),
(6, 'De flesse', 'sdsds', 8458, 'tete', 454, 3, 'images/bars/studentbar2.jpg'),
(7, 'Tea room Koffietje', 'ergens', 9600, 'koffiestraat', 25, 2, 'images/bars/tearoom1.png'),
(8, 'Bar Suzy', '', 0, '', 0, 0, 'images/bars/bar2.jpg'),
(9, 'Bar Bar', '', 0, '', 0, 0, 'images/bars/bar3.jpg'),
(10, 'Coffeebar Tisier', '', 0, '', 0, 1, 'images/bars/coffeebar2.jpeg'),
(11, 'Coffeebar ''t Lepelken', '', 0, '', 0, 1, 'images/bars/coffeebar3.jpg'),
(12, 'Tearoom Thee', '', 0, '', 0, 2, 'images/bars/tearoom2.jpg'),
(13, 'Int kuipken', '', 0, '', 0, 3, 'images/bars/studentbar3.jpg'),
(14, 'Decadance', '', 0, '', 0, 4, 'images/bars/studentbar2.jpg'),
(15, 'De geverfde vogel', '', 0, '', 0, 4, 'images/bars/dancebar3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbldranken`
--

CREATE TABLE IF NOT EXISTS `tbldranken` (
  `drankID` int(10) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `alcohol` varchar(20) NOT NULL,
  `soort` int(20) NOT NULL,
  `cafeID` int(10) NOT NULL,
  `image` varchar(124) NOT NULL,
  PRIMARY KEY (`drankID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldranken`
--

INSERT INTO `tbldranken` (`drankID`, `naam`, `alcohol`, `soort`, `cafeID`, `image`) VALUES
(0, 'Spa', '', 1, 0, 'images\\drinks\\cocacola.jpg'),
(3, 'Gin', '12', 3, 0, 'images\\drinks\\gin.jpg'),
(11, 'Stella', '', 2, 0, 'images\\drinks\\stella.png'),
(13, 'Choco', '0', 0, 0, 'images\\drinks\\chocomelk.jpg'),
(14, 'Fanta', '0', 1, 0, 'images\\drinks\\fanta.jpg'),
(15, 'Koffie', '0', 0, 0, 'images\\drinks\\koffie.jpg'),
(16, 'Icetea', '0', 1, 0, 'images\\drinks\\icetea.jpg'),
(17, 'Jupiler', '4', 2, 0, 'images\\drinks\\jupiler.jpg'),
(18, 'Maes', '4', 2, 0, 'images\\drinks\\maes.png'),
(19, 'Thee', '0', 0, 0, 'images\\drinks\\thee.jpg'),
(20, 'White lady', '36', 3, 0, 'images\\drinks\\Whitelady.jpg'),
(21, 'Woo Woo', '45', 3, 0, 'images\\drinks\\WooWoo.jpg'),
(22, 'Mint Julep', '12', 3, 0, 'images\\drinks\\MintJulep.jpg'),
(23, 'Apple Martini', '9', 3, 0, 'images\\drinks\\AppleMartini.jpg'),
(24, 'Caraibos appelsap', '0', 1, 0, 'images\\drinks\\Caraibos.jpg'),
(25, 'Aquarius lemon', '0', 1, 0, 'images\\drinks\\Aquarius.jpg'),
(26, 'Vittel ', '0', 1, 0, 'images\\drinks\\vittel.jpg'),
(27, 'Leffe Blond ', '4', 2, 0, 'images\\drinks\\leffe.jpg'),
(28, 'Filou', '9', 2, 0, 'images\\drinks\\filou.jpg'),
(29, 'Kwaremont Blond', '8', 2, 0, 'images\\drinks\\karemont.jpg'),
(30, 'La Chouffe', '6', 2, 0, 'images\\drinks\\LaChouffe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblgebruiker`
--

CREATE TABLE IF NOT EXISTS `tblgebruiker` (
  `gebruikerid` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(20) NOT NULL,
  `vnaam` varchar(20) NOT NULL,
  `gender` int(1) NOT NULL,
  `login` varchar(9) NOT NULL,
  `paswoord` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `gebdatum` date NOT NULL,
  `aantalCoins` int(10) NOT NULL,
  `drankID` int(11) NOT NULL,
  `barid` int(11) NOT NULL,
  `groepID` int(255) NOT NULL,
  `image` varchar(224) NOT NULL,
  PRIMARY KEY (`gebruikerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tblgebruiker`
--

INSERT INTO `tblgebruiker` (`gebruikerid`, `naam`, `vnaam`, `gender`, `login`, `paswoord`, `email`, `gebdatum`, `aantalCoins`, `drankID`, `barid`, `groepID`, `image`) VALUES
(0, 'Karen', 'Voorne', 1, 'karen', 'ba952731f97fb058035aa399b1cb3d5c', 'Karen@hotmail.com', '1995-12-22', 0, 15, 11, 1, 'images\\profile\\karen.jpg'),
(1, 'arno', 'ramon', 0, 'arno', 'd25237016cf1a8c419d2c7984085751a', 'ramonarno@hotmail.com', '1995-12-22', 0, 15, 1, 0, 'images/profile/arno.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblgroepen`
--

CREATE TABLE IF NOT EXISTS `tblgroepen` (
  `groepID` int(255) NOT NULL AUTO_INCREMENT,
  `potID` int(255) NOT NULL,
  `gebruikerID` int(255) NOT NULL,
  `groepnaam` varchar(255) NOT NULL,
  PRIMARY KEY (`groepID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblgroepen`
--

INSERT INTO `tblgroepen` (`groepID`, `potID`, `gebruikerID`, `groepnaam`) VALUES
(1, 0, 0, 'groep1'),
(2, 0, 0, 'groep2'),
(3, 0, 0, 'groep3'),
(4, 0, 0, 'groep4');

-- --------------------------------------------------------

--
-- Table structure for table `tblheeftgedronken`
--

CREATE TABLE IF NOT EXISTS `tblheeftgedronken` (
  `heeftGedronkenID` int(11) NOT NULL AUTO_INCREMENT,
  `gebruikerid` int(10) NOT NULL,
  `drankID` int(10) NOT NULL,
  PRIMARY KEY (`heeftGedronkenID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `tblheeftgedronken`
--

INSERT INTO `tblheeftgedronken` (`heeftGedronkenID`, `gebruikerid`, `drankID`) VALUES
(1, 1, 13),
(2, 1, 0),
(3, 1, 11),
(4, 1, 3),
(5, 2, 13),
(6, 2, 0),
(7, 2, 11),
(8, 2, 3),
(118, 1, 13),
(119, 1, 0),
(120, 1, 11),
(121, 1, 3),
(122, 0, 13),
(123, 0, 15),
(124, 0, 19),
(125, 0, 16),
(126, 0, 26),
(127, 0, 0),
(128, 0, 14),
(129, 0, 24),
(130, 0, 24),
(131, 0, 25),
(132, 0, 11),
(133, 0, 20),
(134, 0, 21),
(135, 0, 23);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
