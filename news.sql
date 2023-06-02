-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 05:05 PM
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
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `picture` varchar(255) NOT NULL,
  `archive` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `date`, `picture`, `archive`) VALUES
(1, 'iPhone 14 Pro Max\r\n', 'iPhone 14 Pro Max. Capture incredible detail with the 48 MP main camera. Experience iPhone in a whole new way with Dynamic Island and Always-On Display. The new Crash Detection safety feature calls for help when you can t. 6.7-inch Super Retina XDR2 display with Always-On and ProMotion.\r\n', '2023-05-29 21:11:50', 't1.png', 'N'),
(2, 'MacBook', 'All-new strikingly thin design so you can work, play, or create just about anything — anywhere.Get more done faster with the next-generation Apple M2 chip — and go all day and into the night with up to 18 hours of battery life¹.Fanless design means MacBook Air stays completely silent no matter how intense the task.\r\n', '2023-05-29 20:47:22', 'MacBookAir.png\r\n', 'N'),
(3, 'Apple Watch Series 8\r\n', 'Bright Always-On Retina display with an expansive edge-to-edge design.Take an ECG³ to check for AFib? — anytime, anywhere.Experience improved ways to train with the enhanced Workout app.\r\n', '2023-05-29 21:26:11', 'Apple Watch.png\r\n', 'N'),
(4, 'AirPods', 'Wireless. Effortless. Magical.\r\nWith plenty of talk and listen time, voice-activated Siri access, and an available wireless charging case, AirPods deliver an incredible wireless headphone experience. Simply take them out and they’re ready to use with all your devices. Put them in your ears and they connect immediately, immersing you in rich, high-quality sound. Just like magic.', '2023-05-29 21:27:20', 'AirPods.png\r\n', 'N'),
(5, 'iPad Pro \r\n', 'The Apple M2 chip powers a massive leap in performance for pro workflows and all-day battery life. Pro cameras with LiDAR Scanner, and Ultra Wide front camera with Center Stage. Compatible with Apple Pencil (2nd generation), Magic Keyboard, and Smart Keyboard Folio footnote.\r\n', '2023-05-29 21:38:43', 'iPad Pro.png\r\n', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
