-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Xerado en: 19 de Maio de 2019 ás 17:07
-- Versión do servidor: 5.1.41
-- Versión do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Datos: `premiosbd`
--
CREATE DATABASE `premiosbd` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `premiosbd`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `actrices`
--

CREATE TABLE IF NOT EXISTS `actrices` (
  `idActriz` int(11) NOT NULL AUTO_INCREMENT,
  `nomeActriz` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idActriz`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=77 ;

--
-- A extrair datos da tabela `actrices`
--

INSERT INTO `actrices` (`idActriz`, `nomeActriz`) VALUES
(1, 'Janet Gaynor'),
(2, 'Mary Pickford'),
(3, 'Norma Shearer'),
(4, 'Marie Dressler'),
(5, 'Helen Hayes'),
(6, 'Katharine Hepburn'),
(7, 'Claudette Colbert'),
(8, 'Bette Davis'),
(9, 'Luise Rainer'),
(10, 'Vivien Leigh'),
(11, 'Ginger Rogers'),
(12, 'Joan Fontaine'),
(13, 'Greer Garson'),
(14, 'Jennifer Jones'),
(15, 'Ingrid Bergman'),
(16, 'Joan Crawford'),
(17, 'Olivia de Havilland'),
(18, 'Loretta Young'),
(19, 'Jane Wyman'),
(20, 'Judy Holliday'),
(21, 'Shirley Booth'),
(22, 'Audrey Hepburn'),
(23, 'Grace Kelly'),
(24, 'Anna Magnani'),
(25, 'Joanne Woodward'),
(26, 'Susan Hayward'),
(27, 'Simone Signoret'),
(28, 'Elizabeth Taylor'),
(29, 'Sophia Loren'),
(30, 'Anne Bancroft'),
(31, 'Patricia Neal'),
(32, 'Julie Andrews'),
(33, 'Julie Christie'),
(34, 'Barbra Streisand'),
(35, 'Maggie Smith'),
(36, 'Glenda Jackson'),
(37, 'Jane Fonda'),
(38, 'Liza Minnelli'),
(39, 'Ellen Burstyn'),
(40, 'Louise Fletcher'),
(41, 'Faye Dunaway'),
(42, 'Diane Keaton'),
(43, 'Sally Field'),
(44, 'Sissy Spacek'),
(45, 'Meryl Streep'),
(46, 'Shirley MacLaine'),
(47, 'Geraldine Pedad'),
(48, 'Marlee Matlin'),
(49, 'Cher'),
(50, 'Jodie Foster'),
(51, 'Jessica Tandy'),
(52, 'Kathy Bates'),
(53, 'Emma Thompson'),
(54, 'Holly Hunter'),
(55, 'Jessica Lange'),
(56, 'Susan Sarandon'),
(57, 'Frances McDormand'),
(58, 'Helen Hunt'),
(59, 'Gwyneth Paltrow'),
(60, 'Hilary Swank'),
(61, 'Julia Roberts'),
(62, 'Halle Berry'),
(63, 'Nicole Kidman'),
(64, 'Charlize Theron'),
(65, 'Reese Witherspoon'),
(66, 'Helen Mirren'),
(67, 'Marion Cotillard'),
(68, 'Kate Winslet'),
(69, 'Sandra Bullock'),
(70, 'Natalie Portman'),
(71, 'Jennifer Lawrence'),
(72, 'Cate Blanchett'),
(73, 'Julianne Moore'),
(74, 'Brie Larson'),
(75, 'Emma Stone'),
(76, 'Olivia Colman');

-- --------------------------------------------------------

--
-- Estrutura da tabela `actrices_oscar`
--

CREATE TABLE IF NOT EXISTS `actrices_oscar` (
  `idActriz` int(11) NOT NULL,
  `idOscar` int(11) NOT NULL,
  `pelicula` varchar(70) CHARACTER SET utf8 NOT NULL,
  `idadeActriz` int(11) NOT NULL,
  PRIMARY KEY (`idActriz`,`idOscar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- A extrair datos da tabela `actrices_oscar`
--

INSERT INTO `actrices_oscar` (`idActriz`, `idOscar`, `pelicula`, `idadeActriz`) VALUES
(1, 1, 'Seventh Heaven, Street Angel and Sunrise: A Song of Two Humans', 22),
(2, 2, 'Coquette', 37),
(3, 3, 'The Divorcee', 28),
(4, 4, 'Min and Bill', 63),
(5, 5, 'The Sin of Madelon Claudet', 32),
(6, 6, 'Morning Glory', 26),
(6, 40, 'Guess Who''s Coming to Dinner', 60),
(6, 41, 'The Lion in Winter', 61),
(6, 54, 'On Golden Pond', 74),
(7, 7, 'It Happened One Night', 31),
(8, 8, 'Dangerous', 27),
(8, 11, 'Jezebel', 30),
(9, 9, 'The Great Ziegfeld', 27),
(9, 10, 'The Good Earth', 28),
(10, 12, 'Gone with the Wind', 26),
(10, 24, 'A Streetcar Named Desire', 38),
(11, 13, 'Kitty Foyle', 29),
(12, 14, 'Suspicion', 24),
(13, 15, 'Mrs. Miniver', 38),
(14, 16, 'The Song of Bernadette', 25),
(15, 17, 'Gaslight', 29),
(15, 29, 'Anastasia', 41),
(16, 18, 'Mildred Pierce', 40),
(17, 19, 'To Each His Own', 30),
(17, 22, 'The Heiress', 33),
(18, 20, 'The Farmer''s Daughter', 35),
(19, 21, 'Johnny Belinda', 32),
(20, 23, 'Born Yesterday', 29),
(21, 25, 'Come Back, Little Sheba', 54),
(22, 26, 'Roman Holiday', 24),
(23, 27, 'The Country Girl', 25),
(24, 28, 'The Rose Tattoo', 48),
(25, 30, 'The Three Faces of Eve', 28),
(26, 31, 'I Want to Live!', 41),
(27, 32, 'Room at the Top', 39),
(28, 33, 'Butterfield 8', 29),
(28, 39, 'Who''s Afraid of Virginia Woolf?', 35),
(29, 34, 'Two Women', 27),
(30, 35, 'The Miracle Worker', 31),
(31, 36, 'Hud', 31),
(32, 37, 'Mary Poppins', 29),
(33, 38, 'Darling', 25),
(34, 41, 'Funny Girl', 26),
(35, 42, 'The Prime of Miss Jean Brodie', 35),
(36, 43, 'Women in Love', 34),
(36, 46, 'A Touch of Class', 37),
(37, 44, 'Klute', 34),
(37, 51, 'Coming Home', 41),
(38, 45, 'Cabaret', 27),
(39, 47, 'Alice Doesn''t Live Here Anymore', 42),
(40, 48, 'One Flew over the Cuckoo''s Nest', 41),
(41, 49, 'Network', 36),
(42, 50, 'Annie Hall', 32),
(43, 52, 'Norma Rae', 33),
(43, 57, 'Places in the Heart', 38),
(44, 53, 'Coal Miner''s Daughter', 31),
(45, 55, 'Sophie''s Choice', 33),
(45, 84, 'The Iron Lady', 62),
(46, 56, 'Terms of Endearment', 49),
(47, 58, 'The Trip to Bountiful', 61),
(48, 59, 'Children of a Lesser God', 21),
(49, 60, 'Moonstruck', 41),
(50, 61, 'The Accused', 26),
(50, 64, 'The Silence of the Lambs', 29),
(51, 62, 'Driving Miss Daisy', 80),
(52, 63, 'Misery', 42),
(53, 65, 'Howards End', 33),
(54, 66, 'The Piano', 36),
(55, 67, 'Blue Sky', 45),
(56, 68, 'Dead Man Walking', 49),
(57, 69, 'Fargo', 39),
(57, 90, 'Three Billboards outside Ebbing, Missouri', 60),
(58, 70, 'As Good as It Gets', 34),
(59, 71, 'Shakespeare in Love', 26),
(60, 72, 'Boys Don''t Cry', 25),
(60, 77, 'Million Dollar Baby', 30),
(61, 73, 'Erin Brockovich', 33),
(62, 74, 'Monster''s Ball', 35),
(63, 75, 'The Hours', 35),
(64, 76, 'Monster', 28),
(65, 78, 'Walk the Line', 29),
(66, 79, 'The Queen', 61),
(67, 80, 'La Vie en rose', 32),
(68, 81, 'The Reader', 33),
(69, 82, 'The Blind Side', 45),
(70, 83, 'Black Swan', 29),
(71, 85, 'Silver Linings Playbook', 22),
(72, 86, 'Blue Jasmine', 44),
(73, 87, 'Still Alice', 54),
(74, 88, 'Room', 26),
(75, 89, 'La La Land', 29),
(76, 91, 'The Favourite', 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `oscar`
--

CREATE TABLE IF NOT EXISTS `oscar` (
  `idOscar` int(11) NOT NULL AUTO_INCREMENT,
  `ano` int(11) NOT NULL,
  PRIMARY KEY (`idOscar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=92 ;

--
-- A extrair datos da tabela `oscar`
--

INSERT INTO `oscar` (`idOscar`, `ano`) VALUES
(1, 1929),
(2, 1930),
(3, 1931),
(4, 1932),
(5, 1933),
(6, 1934),
(7, 1935),
(8, 1936),
(9, 1937),
(10, 1938),
(11, 1939),
(12, 1940),
(13, 1941),
(14, 1942),
(15, 1943),
(16, 1944),
(17, 1945),
(18, 1946),
(19, 1947),
(20, 1948),
(21, 1949),
(22, 1950),
(23, 1951),
(24, 1952),
(25, 1953),
(26, 1954),
(27, 1955),
(28, 1956),
(29, 1957),
(30, 1958),
(31, 1959),
(32, 1960),
(33, 1961),
(34, 1962),
(35, 1963),
(36, 1964),
(37, 1965),
(38, 1966),
(39, 1967),
(40, 1968),
(41, 1969),
(42, 1970),
(43, 1971),
(44, 1972),
(45, 1973),
(46, 1974),
(47, 1975),
(48, 1976),
(49, 1977),
(50, 1978),
(51, 1979),
(52, 1980),
(53, 1981),
(54, 1982),
(55, 1983),
(56, 1984),
(57, 1985),
(58, 1986),
(59, 1987),
(60, 1988),
(61, 1989),
(62, 1990),
(63, 1991),
(64, 1992),
(65, 1993),
(66, 1994),
(67, 1995),
(68, 1996),
(69, 1997),
(70, 1998),
(71, 1999),
(72, 2000),
(73, 2001),
(74, 2002),
(75, 2003),
(76, 2004),
(77, 2005),
(78, 2006),
(79, 2007),
(80, 2008),
(81, 2009),
(82, 2010),
(83, 2011),
(84, 2012),
(85, 2013),
(86, 2014),
(87, 2015),
(88, 2016),
(89, 2017),
(90, 2018),
(91, 2019);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
