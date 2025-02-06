-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 07:28 PM
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
-- Database: `aptech_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `employee_image` varchar(255) NOT NULL,
  `user_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `age`, `address`, `employee_image`, `user_id`) VALUES
(1, 'munir', 24, 'alpha red gate red light area heera mandi kootha number 14', 'googleform.png', 0),
(4, 'testsdfgsdfsd', 23, 'fsdfsd', 'right-rectangle.png', 0),
(5, 'test2', 43, 'fsdfsd', 'image (21).webp', 0),
(6, 'test', 12, 'fsdfsd', 'image (21).webp', 4),
(7, 'test2', 12, 'fsdfsd', 'CMS-Platform-Tailored-For-Client-Needs (1).webp', 5),
(8, 'testsdfgsdfsd', 23, 'fsdfsd', 'group-img.jpg', 5),
(9, 'test', 23423423, 'fsdfsd', 'Group 96.webp', 3);

-- --------------------------------------------------------

--
-- Table structure for table `role_person`
--

CREATE TABLE `role_person` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_person`
--

INSERT INTO `role_person` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Employee'),
(5, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `datetime` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `datetime`) VALUES
(1, 'abdul hafeez', 'hafeez@gmail.com', '$2y$10$gxN/Vm/1q/SAJ.2.WxR6desXAq5.kGPiyB7jVN0bNKwbHtAZ0pXSG', 0, '2025-02-03'),
(2, 'sheikh hafeez', 'sheikh@gmail.com', '$2y$10$UG9NO9L2uTvkEOCg0RNOnO62EgmQ67Ntu/DKSJzTEXFjxMXjsm.Iu', 1, '2025-02-06'),
(3, 'talha rao', 'talha@gmail.com', '$2y$10$XCEJs1pql.d88z4lZOF8FeMtocaJndugvYUsD1bMBxCOuhDTEMYw2', 2, '2025-02-06'),
(4, 'hammad', 'hammad@gmail.com', '$2y$10$HKTP8suAaVxYAuFCaqqPuOVoKagVc..De7qq5RQ8l213GfOMJQA5.', 2, '2025-02-06'),
(5, 'sain', 'sain@gmail.com', '$2y$10$C4wjB9Sklql6Fu5ClwseLOKdHNVifdg4No6AxXahcXshRN5O.F9gC', 1, '2025-02-06'),
(6, 'superadmin', 'superadmin@gmail.com', '$2y$10$LgL1yoyLCyEmz9oJx1OLdOgi6HJi9iXo4YvTqQBo0xhuCGR8qSp.S', 5, '2025-02-06'),
(7, 'new admin', 'newadmin@gmail.com', '$2y$10$C4wjB9Sklql6Fu5ClwseLOKdHNVifdg4No6AxXahcXshRN5O.F9gC', 1, '2025-02-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_person`
--
ALTER TABLE `role_person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_person`
--
ALTER TABLE `role_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
