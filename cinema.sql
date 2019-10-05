-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2019 at 10:23 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `MovieId` int(11) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ReleaseYear` year(4) NOT NULL,
  `Genre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Director` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LeadingActor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Summary` longtext COLLATE utf8_unicode_ci,
  `ImdbRating` decimal(2,0) NOT NULL,
  `ImageUrl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`Email`, `token`, `expDate`) VALUES
('ljubica@gmail.com', 'sw0dffihhj', '2019-10-06 21:20:30'),
('marko@gmail.com', '67hpls2foc', '2019-10-06 22:23:12'),
('petar@gmail.com', '780m5o4fkf', '2019-10-06 22:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `RegistrationDate` date NOT NULL,
  `ProfilePicture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Token` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`UserId`, `FirstName`, `LastName`, `UserName`, `Email`, `Password`, `RegistrationDate`, `ProfilePicture`, `Token`) VALUES
(3, 'Ljubica', 'Zeravic', 'ljubica_zeravic', 'ljubica@gmail.com', 'a3bf9648867756398784b458496abd09', '2019-09-15', 'images/profile_pictures/head_alizarin.png', 'wf38o2xafc'),
(4, 'Ljubica', 'Zeravic', 'ljubica_zeravic_1', 'ljubica1@gmail.com', '59593f7f0164c0aeddaf393c670bc321', '2019-09-15', 'images/profile_pictures/head_belize_hole.png', ''),
(5, 'Mickey', 'Mouse', 'mickey_mouse', 'mickey@gmail.com', '4d5257e5acc7fcac2f5dcd66c4e78f9a', '2019-09-15', 'images/profile_pictures/head_belize_hole.png', ''),
(7, 'Petar', 'Petrovic', 'petar_petrovic', 'petar@gmail.com', '597e3b12820151caa6062612caec8056', '2019-09-15', 'images/profile_pictures/head_belize_hole.png', ''),
(8, 'Marko', 'Markovic', 'marko_markovic', 'marko@gmail.com', 'c28aa76990994587b0e907683792297c', '2019-09-18', 'images/profile_pictures/head_alizarin.png', ''),
(11, 'Ljubica', 'Zeravic', 'ljubica_zeravic_1_2', 'ljubicazeravic@gmail.com', '59593f7f0164c0aeddaf393c670bc321', '2019-09-27', 'images/profile_pictures/head_alizarin.png', '8fcfhkcip4'),
(15, 'Petar', 'Petrovic', 'petar_petrovic_1', 'petarp@gmail.com', 'ac0cec0839270d344bda468cb14f3190', '2019-10-03', 'images/profile_pictures/head_belize_hole.png', ''),
(18, 'Marko', 'Markovic', 'marko_markovic_1', 'fdsaaf@gmail.com', 'fa3e98adb3b88f10d29e494232b1e5f8', '2019-10-05', 'images/profile_pictures/head_alizarin.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_movies`
--

CREATE TABLE `users_movies` (
  `UserId` int(11) NOT NULL,
  `MovieId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`MovieId`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `users_movies`
--
ALTER TABLE `users_movies`
  ADD PRIMARY KEY (`UserId`,`MovieId`),
  ADD KEY `Movie_idx` (`MovieId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `MovieId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `users_data` (`Email`);

--
-- Constraints for table `users_movies`
--
ALTER TABLE `users_movies`
  ADD CONSTRAINT `MovieFK` FOREIGN KEY (`MovieId`) REFERENCES `movies` (`MovieId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserFK` FOREIGN KEY (`UserId`) REFERENCES `users_data` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
