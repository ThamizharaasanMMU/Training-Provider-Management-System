-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 02:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `usertype` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `passwords` varchar(64) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `institute` varchar(128) DEFAULT NULL,
  `field_of_study` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `usertype`, `username`, `passwords`, `date_of_birth`, `phone`, `email`, `institute`, `field_of_study`) VALUES
(1, 'Thamizharaasan', 'Chandran', 3, 'Thamizh02', 'tham020626', '2002-06-26', 195521627, '1201101703@student.mmu.edu.my', 'Multimedia University', 'Computer Science Specialization in Software Engineering'),
(19, 'Aiman', 'Haziq', 2, 'aiman11', 'aiman11', NULL, NULL, NULL, NULL, NULL),
(23, 'Rafie', 'Rauzan', 3, 'rafie', 'abc123', '2002-03-15', 196004828, '', 'Multimedia University', 'Software Engineering'),
(24, 'abu', 'ali', 4, 'abuali', 'abuali', NULL, NULL, NULL, NULL, NULL),
(25, 'Fahim', 'Anwar', 4, 'fahim98', 'root', NULL, NULL, NULL, NULL, NULL),
(26, 'Harith', 'Najmi', 4, 'harith02', 'hi', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
