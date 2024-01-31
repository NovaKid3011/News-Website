-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 11:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title_name` varchar(255) NOT NULL,
  `category` enum('Business','Entertainment','Sports','Technology') NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` mediumblob NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title_name`, `category`, `description`, `image`, `date_uploaded`) VALUES
(7, 'fafafaff', 'Technology', 'fafafafa', 0x34343039353034303664326238626336653534346436666439616236326435652e6a7067, '2024-01-30 17:28:32'),
(8, 'Cat', 'Entertainment', 'This is my cat', 0x35303533323730396563636432646165353138363965336237346632623038652e6a7067, '2024-01-30 17:40:15'),
(10, 'ttfftyf', 'Sports', 'dgrdgdrdr', 0x31363361376664613530613332386132376566663833343139383635616238642e6a7067, '2024-01-30 17:50:20'),
(12, '14141', 'Sports', 'xrdctfvygbuhnij', 0x39646630353936353063303138646638623436386163653530386365386264352e706e67, '2024-01-30 18:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Regular') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(1, 'Markjohn', 'Agravante', 'marky@gmail.com', '$2y$10$qG1L0hWztfu.DsY8hW3Wc.Xc0n1nKj5xfhaq04G5sgSBwOElpunY.', 'Admin'),
(3, 'Mike', 'Angelo', 'mikey@gmail.com', '$2y$10$xLtjLZuGr4GpC82t8v307OL7uo9kBRVXqhZVg7Uwdd5G3iCqJSUAS', 'Regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
