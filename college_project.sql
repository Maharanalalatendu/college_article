-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 01:00 PM
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
-- Database: `college_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_article`
--

CREATE TABLE `all_article` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_article`
--

INSERT INTO `all_article` (`id`, `name`, `title`, `description`, `date_time`, `status`) VALUES
(53, 'lala', 'kjhk', 'jsbfjsv', '2025-03-29 18:58:08', 2),
(56, 'LALATENDU MAHARANA', 'MY COLLEGE', 'MPC AUHJGVCAUYGCDAVDL  AIDVAOVBDKjHGAJVDIYAVFDTVD A D AD VA IUVDTAUVDIAUYDBVHgjVAJYGCGAVDGBDHAOBDUANOD D AODAODIAUDIHDAI DAIYDAIUGDDUGDIGDHAGDJADTIUUTDAVDGA D A DAUGDAIDBUTDIINBDAID AD UA DA DGADADGD AD ADGAGDAIGDIAGDIUAGDI AIUDADGUIAGDIAGDDGAIDHOADHAGDADAGHDAGDAIGDIA ADGAI DGAIUD A UDAUUID A D AD DIASLK NS FSU FGYUUS F SEFSI RW WGR WYR RS F SFUI ', '2025-03-30 07:40:16', 0),
(57, 'lala', 'hjgj', 'ghdf', '2025-04-01 18:15:55', 0),
(58, 'lala', 'vbdgf', 'gdgf', '2025-04-01 18:16:08', 0),
(59, 'lala', 'ytrtge', 'bgfdgfr', '2025-04-01 18:16:43', 0),
(60, 'lala', 'sliju', 'ajkhgdj', '2025-04-02 11:11:21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `name`, `email`, `password`) VALUES
(1, 'lala', 'jeeban_503@outlook.com', 'hgfASH'),
(2, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', '123456'),
(3, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', '123456'),
(4, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', '123456'),
(5, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', '123456'),
(6, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', '123456'),
(7, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', 'ytwyfw'),
(8, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', 'ytwyfw'),
(9, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', 'ytwyfw'),
(10, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', 'ytwyfw'),
(11, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', '1234'),
(12, 'Sridhar Maharana', 'lalatendumaharana0@gmail.com', '1234'),
(13, 'Sridhar Maharana', 'lalatendumaharana660@gmail.com', '31424'),
(14, 'Sridhar Maharana', 'lalatendumaharana0000@gmail.com', 'hgfay'),
(15, 'Sridhar Maharana', 'lalatendumaharana000550@gmail.com', '4353'),
(16, 'kenwknr', 'jeeban_555303@outlook.com', '4353'),
(17, 'fgs', 'jeeban_ge503@outlook.com', '4353'),
(18, 'ihhfhf', 'jeeban_403@outlook.com', '4353'),
(19, 'hjgj', 'jeeban_5036@outlook.com', '4353'),
(20, 'Abhi', 'abhi123@gmail.com', '1234'),
(21, 'LALATENDU MAHARANA', 'lalatendumaharana0@gmail.comb', '1234'),
(22, 'jhsvcs', 'jeeban_503@outloojkavdk.com', 'dkbsdi'),
(23, 'oiaudaiyd', 'jeeban_503@outlook.comhsdg', 'hgfASHkzhd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_article`
--
ALTER TABLE `all_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_article`
--
ALTER TABLE `all_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
