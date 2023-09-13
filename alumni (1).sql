-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2023 at 09:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `registry` int(11) NOT NULL DEFAULT 0,
  `doc` int(11) NOT NULL DEFAULT 0,
  `hod` int(11) NOT NULL DEFAULT 0,
  `library` int(11) NOT NULL DEFAULT 0,
  `bursary` int(11) NOT NULL DEFAULT 0,
  `dsa` int(11) NOT NULL DEFAULT 0,
  `clinic` int(11) NOT NULL DEFAULT 0,
  `sport` int(11) NOT NULL DEFAULT 0,
  `works` int(11) NOT NULL DEFAULT 0,
  `laboratory` int(11) NOT NULL DEFAULT 0,
  `riu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `user_id`, `registry`, `doc`, `hod`, `library`, `bursary`, `dsa`, `clinic`, `sport`, `works`, `laboratory`, `riu`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `name` varchar(350) NOT NULL,
  `code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `name`, `code`) VALUES
(1, 'College of Natural and Applied Sciences', 'CONAS'),
(2, 'College of Management and Social Sciences', 'COMAS'),
(3, 'College of Humanities', 'COHAS');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Department of Mathematics and Computer Science'),
(2, 'Department of Mass Communication'),
(3, 'Biochemistry'),
(4, 'Microbiology'),
(5, 'Economics'),
(6, 'Polical Science'),
(7, 'Accounting'),
(8, 'Business Administration'),
(9, 'Banking and Finance'),
(10, 'Chemistry'),
(11, 'Physics'),
(12, 'Arabic'),
(13, 'Islamic Studies'),
(14, 'English and Literary Studies'),
(15, 'History and Diplomatic Studies');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_users`
--

CREATE TABLE `lecturer_users` (
  `id` int(11) NOT NULL,
  `office_code` varchar(100) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `college_id` varchar(11) DEFAULT '0',
  `department_id` varchar(11) DEFAULT '0',
  `email` varchar(250) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `changed_password` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_users`
--

INSERT INTO `lecturer_users` (`id`, `office_code`, `name`, `phone`, `college_id`, `department_id`, `email`, `password`, `changed_password`) VALUES
(1, 'registry', 'Kaseem', '+2347089674534', '0', '0', 'register@summituniversity.edu.ng', '12345', 0),
(2, 'doc', 'A O Murana', '09078675645', '1', '1', 'ao.murana@summituniversity.edu.ng', '12345', 0),
(3, 'hod', 'Olatunde Yusuff', '09089786756', '1', '1', 'olatunde.yusuf@summituniversity.edu.ng', '12345', 0),
(4, 'dsa', 'Dr Ganiyu Adebayo Zubair', '08064434397', '0', '0', 'ganiyu.adebayo@summituniversity.edu.ng', '12345', 0),
(5, 'library', 'Mr. Ayo Salami ', '08061119976', '0', '0', 'salam@summituniversity.edu.ng', '12345', 0),
(6, 'bursary', 'Mr Abdulraheem ', '+234 803 238 1807', '0', '0', 'bursar@summituniversity.edu.ng', '12345', 0),
(7, 'works', 'Engr. Shamsudeen', '+234 803 433 5679', '0', '0', 'shamsudeen@summituniversity.edu.ng', '12345', 0),
(8, 'riu', 'Mrs Mutiat Mohammad', '+234 806 558 7196', '0', '0', 'mojworld35@gmail.com', '12345', 0),
(9, 'sport', 'Dr Mustapha Sanbe', '+234 802 342 1891', '0', '0', 'mustapha.sanbe@summituniversity.edu.ng', '12345', 0),
(14, 'clinic', 'Dr. Clinic', '+23470000000', '0', '0', 'clinic@summituniversity.edu.ng', '12345', 0),
(15, 'laboratory', 'Adepoju Ismaheel', '+234 815 916 5561', '1', '1', 'adepoju.ismaheel@summituniversity.edu.ng', '12345', 0),
(16, 'laboratory', 'Ola-williams', '+234 909 132 5290', '1', '3', 'olawilliams@gmail.com', '12345', 0),
(17, 'laboratory', 'Ola-williams', '+234 909 132 5290', '1', '4', 'olawilliams1@gmail.com', '12345', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(20) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `reference` varchar(56) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `payment_type`, `amount`, `payment_status`, `reference`, `date`) VALUES
(1, '313', 'alumni_due', '10000', 0, 'SUNALUMNI339566', '2023-08-05 12:27:11.173120'),
(2, '1', 'alumni_due', '10000', 0, 'SUNALUMNI7625796', '2023-08-05 14:35:04.493983'),
(3, '1', 'alumni_due', '10000', 0, 'SUNALUMNI1977349', '2023-08-05 17:16:22.496299'),
(4, '1', 'alumni_due', '10000', 1, 'SUNALUMNI9999254', '2023-08-05 17:50:45.577606'),
(5, '3', 'alumni_due', '10000', 1, 'SUNALUMNI5732358', '2023-08-06 07:28:11.129709'),
(6, '5', 'alumni_due', '10000', 1, 'SUNALUMNI5709278', '2023-08-12 22:36:55.073690'),
(7, '5', 'alumni_due', '10000', 1, 'SUNALUMNI7356295', '2023-08-12 22:38:06.362864');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `matric_number` varchar(50) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` int(100) DEFAULT NULL,
  `email_confirmation` int(11) NOT NULL DEFAULT 0,
  `college` varchar(56) NOT NULL,
  `department` varchar(56) NOT NULL,
  `address` varchar(255) NOT NULL,
  `whatsapp_number` varchar(50) NOT NULL,
  `linkedin_profile` varchar(50) NOT NULL,
  `profile_picture` varchar(56) NOT NULL,
  `job_status` varchar(56) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmed_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `matric_number`, `fullname`, `email`, `token`, `email_confirmation`, `college`, `department`, `address`, `whatsapp_number`, `linkedin_profile`, `profile_picture`, `job_status`, `password`, `confirmed_password`) VALUES
(1, '22/CONAS/CSC/025', 'Alicia Breitenberg', 'ashrafhabeeb204@gmail.com', 873336, 1, '3', '1', 'Pelelola morodo area, iwo osun state', '332', 'Odit facilis libero eveniet repellat.', 'Bars.png', 'self employed', '123456', '123456'),
(2, '22/CONAS/CSC/024', 'Tesleem Olamilekan', 'ola@gmail.com', 394059, 0, '1', '1', 'Offa, Kwara', '07067526407', 'www.summituniversity.com', 'Flyer - 8.png', 'employed', '123456', '123456'),
(3, '22/CONAS/CSC/026', 'Tesleem Olamilekan', 'ict@gmail.com', 974657, 0, '1', '1', 'Offa, Kwara', '07067526404', 'www.summituniversity.com', 'Dr. Esther Matemba.png', 'employed', '123456', '123456'),
(4, '22/CONAS/CSC/050', 'Habeebullah, Ashrof Akintola', 'akinlabiashraf@gmail.com', 889258, 0, '1', '1', '22, Adijatu Kasumu Street, Mosan Ipaja Lagos Nigeria.', '09056475634', 'https:// ghgfhffg.com', 'image 88.png', 'not employed', '1234567890', '1234567890'),
(5, '22/CONAS/CSC/051', 'Habeebullah, Ashrof Akintola', 'akinlabiashraf904@gmail.com', 803898, 1, '1', '1', '22, Adijatu Kasumu Street, Mosan Ipaja Lagos Nigeria.', '09056476638', 'https:// ghgfhffg.com', 'image 88.png', 'not employed', '1234567890', '1234567890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer_users`
--
ALTER TABLE `lecturer_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lecturer_users`
--
ALTER TABLE `lecturer_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
