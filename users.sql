-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 05:04 PM
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
-- Database: `apple`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` char(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `archive` enum('Y','N') NOT NULL DEFAULT 'N',
  `role` int(1) DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `country`, `date`, `archive`, `role`) VALUES
(0, 'User1', 'User1', 'user1@vvg.hr', 'user1', '$2y$12$KrTIjyQJaJ38M2EnmSNDieQURor3CqUsRe70RPa2iaurWyQNnqHjy', 'HR', '2023-05-30 09:07:09', 'N', 3),
(1, 'Admin', 'Admin', 'admin@gmail.com', 'admin', '$2y$12$Wcb.8PLSwcQuTee0BDUU7ub9CFrfYDyjSLd7.cAeHV6DXZ7xrGpdu', 'HR', '2023-05-30 08:29:15', 'N', 2),
(2, 'Pero', 'Peric', 'pperic@vvg.hr', 'perky', '$2y$12$qY5U0Yr9F2fO7f42YSlf3e/s2CnKr1pmJkBEaj0o3UZyNpfh0oGcq', 'BB', '2023-05-30 09:32:30', 'Y', 1),
(3, 'test', 'test', 'test@gmail.com', 'test123', '$2y$12$c715vAVNimJRgsztI1KFHOTQca7/1T9PxWTmcK2zuH14TjX.0APcW', 'AT', '2023-05-30 09:42:56', 'N', 3),
(4, 'Nikolina', 'Marinic', 'nmarinic@vvg.hr', 'nmarinic', '$2y$12$zMaT5QcP874TOI8L4QS2Tu.7GVsX0f0bcHvCUyESKN6qaHi17CywK', 'HR', '2023-05-30 09:48:17', 'N', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
