-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 02:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_diemdanh`
--

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `id` int(11) NOT NULL,
  `id_hocphan` varchar(10) NOT NULL,
  `ten_hocphan` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`id`, `id_hocphan`, `ten_hocphan`, `status`) VALUES
(1, '11', 'Đồ án cơ sở 5', 0),
(2, '12', 'Xử lý ảnh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(10) NOT NULL,
  `email_lecturers` varchar(20) NOT NULL,
  `pass_lecturers` varchar(30) NOT NULL,
  `degree_lecturers` varchar(30) NOT NULL,
  `name_lecturers` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `email_lecturers`, `pass_lecturers`, `degree_lecturers`, `name_lecturers`, `status`) VALUES
(1, 'hiep', '1', 'TS', 'Phan Xuân Hiệp', 1),
(2, 'dung', '1', 'TS', 'Nguyễn Tiến Dũng', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(7) NOT NULL,
  `student_class` varchar(5) NOT NULL,
  `student_name` varchar(30) NOT NULL,
  `id_monhoc` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `student_class`, `student_name`, `id_monhoc`, `status`) VALUES
(1, '19IT152', '19IT3', 'Phan Xuân Hiệp', '11', 1),
(2, '19IT152', '19IT3', 'Nguyễn Tiến Dũng', '12', 1),
(3, '19IT152', '19IT3', 'Đinh Lâm Nghĩa', '12', 1),
(4, '19IT152', '19IT3', 'Trương Quốc Khánh', '12', 1),
(5, '19IT152', '19IT3', 'Nguyễn Trung Hiếu', '12', 1),
(6, '19IT152', '19IT3', 'Nguyễn Văn A', '11', 1),
(7, '19IT152', '19IT3', 'Nguyễn Văn B', '11', 1),
(8, '19IT152', '19IT3', 'Nguyễn Văn C', '11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hocphan`
--
ALTER TABLE `hocphan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
