-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2023 at 02:48 PM
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
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `creator_name` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `field` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `instructor` varchar(128) NOT NULL,
  `ins_invitation` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL,
  `student_list` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `creator_name`, `title`, `field`, `description`, `start_date`, `end_date`, `instructor`, `ins_invitation`, `status`, `student_list`) VALUES
(3, 'Aiman', 'Programming Fundamentals', 'Education', 'Learn C++ in 10 days.', '2023-06-16', '2023-06-26', 'Fahim', 'Accept', 'Publish', ''),
(6, 'Alif', 'Computer Network', 'Education', 'Learn static routing', '2023-06-14', '2023-06-21', 'Fahim', 'Reject', 'Draft', ''),
(7, 'Alif', 'Software Design', 'Education', 'Learn about the concepts of Gang Of Four', '2023-06-21', '2023-06-23', 'Fahim', 'Pending', 'Draft', ''),
(8, 'Aiman', 'Python for Beginners', 'Education', 'Learn basic of python programming language.', '2023-06-15', '2023-06-20', 'Fahim', 'Accept', 'Publish', ''),
(9, 'Aiman', 'React Crash Course', 'Education', 'Learn the course from scratch. Hope you enjoy', '2023-06-14', '2023-06-15', 'Fahim', 'Accept', 'Draft', ''),
(11, 'Aiman', 'Digital System', 'Education', 'Learn about JK Flip Flops', '2023-06-29', '2023-07-08', 'Harith', 'Accept', 'Publish', ' rafie ,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
