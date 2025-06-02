-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 01:28 AM
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
-- Database: `deapc`
--

-- --------------------------------------------------------

--
-- Table structure for table `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `data_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acessos`
--

INSERT INTO `acessos` (`id`, `username`, `data_acesso`) VALUES
(1, 'mateus', '2025-06-02 21:08:27'),
(2, 'mateus', '2025-06-02 21:11:48'),
(3, 'mateus', '2025-06-02 21:16:47'),
(4, 'mateus', '2025-06-02 21:17:39'),
(5, 'mateus', '2025-06-02 21:18:09'),
(6, 'mateus', '2025-06-02 21:18:13'),
(7, 'mateus', '2025-06-02 21:18:25'),
(8, 'mateus', '2025-06-02 21:19:35'),
(9, 'mateus', '2025-06-02 21:20:22'),
(10, 'mateus', '2025-06-02 21:21:34'),
(11, 'mateus', '2025-06-02 21:23:32'),
(12, 'mateus', '2025-06-02 21:24:36'),
(13, 'mateus', '2025-06-02 21:25:04'),
(14, 'mateus', '2025-06-02 21:25:32'),
(15, 'mateus', '2025-06-02 21:25:33'),
(16, 'mateus', '2025-06-02 21:25:34'),
(17, 'mateus', '2025-06-02 21:25:39'),
(18, 'mateus', '2025-06-02 21:25:50'),
(19, 'mateus', '2025-06-02 21:25:52'),
(20, 'mateus', '2025-06-02 21:25:55'),
(21, 'mateus', '2025-06-02 21:30:56'),
(22, 'mateus', '2025-06-02 21:33:35'),
(23, 'mateus', '2025-06-02 21:34:55'),
(24, 'mateus', '2025-06-02 21:36:46'),
(25, 'mateus', '2025-06-03 00:51:35'),
(26, 'mateus', '2025-06-03 00:59:51'),
(27, 'mateus', '2025-06-03 01:00:39'),
(28, 'mateus', '2025-06-03 01:00:44'),
(29, 'mateus', '2025-06-03 01:02:33'),
(30, 'mateus', '2025-06-03 01:04:08'),
(31, 'mateus', '2025-06-03 01:04:15'),
(32, 'mateus', '2025-06-03 01:05:03'),
(33, 'mateus', '2025-06-03 01:08:53'),
(34, 'mateus', '2025-06-03 01:16:41'),
(35, 'mateus', '2025-06-03 01:23:30'),
(36, 'mateus', '2025-06-03 01:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `contas`
--

CREATE TABLE `contas` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contas`
--

INSERT INTO `contas` (`id`, `username`, `password`) VALUES
(5, 'mateus', 'umdoistres');

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `nome_item` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`id`, `nome_item`, `stock`) VALUES
(1, 'SIT Pizza', 5),
(2, 'SIT Leão', 0),
(3, 'SIT Aronha\n', 8),
(4, 'SIT Aseca\n', 20);

-- --------------------------------------------------------

--
-- Table structure for table `processo`
--

CREATE TABLE `processo` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `data_test_drive` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `processo`
--

INSERT INTO `processo` (`id`, `tipo`, `data_test_drive`) VALUES
(1, 'Test Drive', '2025-05-13'),
(2, 'Test Drive', '2025-05-09'),
(3, 'Test Drive', '2025-06-20'),
(4, 'Test Drive', '2025-06-19'),
(5, 'Test Drive', '2025-06-19'),
(6, 'Test Drive', '2025-06-19'),
(7, 'Test Drive', '2025-06-19'),
(8, 'Test Drive', '2025-06-19'),
(9, 'Test Drive', '2025-06-19'),
(10, 'Test Drive', '2025-06-19'),
(11, 'Test Drive', '2025-06-19'),
(12, 'Test Drive', '2025-06-19'),
(13, 'Test Drive', '2025-06-05'),
(14, 'Test Drive', '2025-06-05'),
(15, 'Test Drive', '2025-06-05'),
(16, 'Test Drive', '2025-06-05'),
(17, 'Test Drive', '2025-06-05'),
(18, 'Test Drive', '2025-06-05'),
(19, 'Test Drive', '2025-06-05'),
(20, 'Test Drive', '2025-06-05'),
(21, 'Test Drive', '2025-06-05'),
(22, 'Test Drive', '2025-06-19'),
(23, 'Test Drive', '2025-06-19'),
(24, 'Test Drive', '2025-06-19'),
(25, 'Test Drive', '2025-06-19'),
(26, 'Test Drive', '2025-06-19'),
(27, 'Test Drive', '2025-06-19'),
(28, 'Test Drive', '2025-06-19'),
(29, 'Test Drive', '2025-06-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `processo`
--
ALTER TABLE `processo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `processo`
--
ALTER TABLE `processo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
