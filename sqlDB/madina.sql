-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 09:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpals`
--

-- --------------------------------------------------------

--
-- Table structure for table `buddys`
--

CREATE TABLE `buddys` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `buddyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buddys`
--

INSERT INTO `buddys` (`id`, `userId`, `buddyId`) VALUES
(1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `chat-messages`
--

CREATE TABLE `chat-messages` (
  `id` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `readed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat-messages`
--

INSERT INTO `chat-messages` (`id`, `senderId`, `receiverId`, `message`, `timestamp`, `readed`) VALUES
(1, 6, 8, 'Test', '2020-04-06 16:00:13', 0),
(2, 8, 6, ':D', '2020-04-06 16:00:47', 1),
(3, 6, 8, 'Tehehe', '2020-04-06 17:21:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `location` varchar(300) NOT NULL,
  `year` int(11) NOT NULL,
  `preference` varchar(300) NOT NULL,
  `genre` varchar(300) NOT NULL,
  `likesToParty` tinyint(1) NOT NULL,
  `userId` int(11) NOT NULL,
  `lookingForBuddy` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `location`, `year`, `preference`, `genre`, `likesToParty`, `userId`, `lookingForBuddy`) VALUES
(1, 'Mechelen', 2, 'Development', 'rock', 0, 1, 0),
(2, 'Antwerpen', 2, 'Development', 'Rock', 0, 6, 1),
(3, 'Brussel', 1, 'Design', 'Pop', 1, 7, 0),
(4, 'Antwerpen', 3, 'Development', 'Pop', 1, 8, 0),
(5, 'Boom', 2, 'Development', 'Rock', 1, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `avatar` varchar(300) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `description`, `avatar`) VALUES
(1, 'Tommy', 'Tester', 'ponpon@gmail.com', '$2y$15$xUDha70a4pEdrHe1rWGlyOiOmrrxOyc1A/7QdWNd0xJPFfe9gmFty', '\'Magic&quot;\'', '11bb83853eb7a21cd31a4bf0cb98b4bd0.jpg'),
(6, 'Test', 'Johnsson', 'test1@student.thomasmore.be', '$2y$14$LgrjvxPv2NUJzum5A72CKehcvrzEbqUzjDjNSz2oJvOBEYcDmNugm', '\"Sheet\"ðŸ˜‚', 'default.jpg'),
(7, 'Joe', 'Johnsson', 'random@student.thomasmore.be', '$2y$14$uUR8YFhGLmGGM6.RcSeyj.Zn9sIVQy93ofYh9.q3O9VZBndhkRor2', 'Cheese', 'default.jpg'),
(8, 'Test', 'Magic', 'magic@student.thomasmore.be', '$2y$14$peDqGxvgHhJgn1whXqg0L.CAXs8SHZZexUu07u8RKSiLtL1ylDSjy', NULL, 'default.jpg'),
(9, 'Max', 'De Witte', 'tester@student.thomasmore.be', '$2y$14$sHEcv8iwy42BThmgsRUkn..7X4b4grPak6EPeWdKOAnMrC9RO8Xbq', 'Magic', 'default.jpg'),
(10, 'testPreference', 'preference', 'preference@student.thomasmore.be', '$2y$14$Tn2Jbl.6uD3LLa9ld05CJOYu6dIfyhOfMHeb6Dcnzub6FjvcJCO12', NULL, 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buddys`
--
ALTER TABLE `buddys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat-messages`
--
ALTER TABLE `chat-messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat-messages`
--
ALTER TABLE `chat-messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
