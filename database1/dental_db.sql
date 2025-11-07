-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 10:29 AM
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
-- Database: `dental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `image`) VALUES
('r4Sdg711xRCSaaLqRsux', 'selena', 'selena@gmail.com', '40bc268f88e6d1bbfcc03874d9ed50ec2889a711', '9zeLYWTZDEQ0Rlyci9yC.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `service_id` varchar(200) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'booked',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `name`, `number`, `email`, `service_id`, `employee_id`, `date`, `time`, `price`, `status`, `payment_status`) VALUES
('k8eJ6P1DtQ1Y1T7XX6YU', 'SXOR4znfXsGM83Gzfhpf', 'john doe', '7788990055', 'johndoe@gmail.com', 'WJwaQ9Z3N6PN9h7HFgnA', 'tz5Y9Dx5oqMKrRxv9GHO', '2024-08-18', '12:00 AM - 1:00 AM', '78', 'canceled', 'credit card');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(10) NOT NULL,
  `profile_desc` text NOT NULL,
  `profile` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `profession`, `email`, `number`, `profile_desc`, `profile`, `status`) VALUES
('tz5Y9Dx5oqMKrRxv9GHO', 'Marco Williams', 'Stomatologist', 'MarcoWilliams@gmail.com', 667788990, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'C7uGS1m9UJP1ldGvw3Rl.jpg', 'active'),
('RmF88tlpFDsxMv8BlsUa', 'sam smith', 'Stomatologist', 'samsmith@gmail.com', 2147483647, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'lBP82nbCuvkv2XRqVa6P.jpg', 'active'),
('V8dyVtJnQXqiS3y3HTuV', 'alena ansari', 'periodontist', 'alenaansari@gmail.com', 99887700, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'ttM5iDnWzYL6eMdcMykV.png', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `subject`, `message`) VALUES
('u2vU8T0DKq7rh5euWlPR', 'SXOR4znfXsGM83Gzfhpf', 'john doe', 'johndoe@gmail.com', 'dental health', 'i want full dental checkup');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `service_detail` varchar(1500) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `image`, `service_detail`, `status`) VALUES
('72uKGgkR2Kf8uhnUb7WN', 'Professional Teeth Cleaning', '45', 'service1.png', 'Tooth restoration is a dental procedure designed to renew the health and integrity of a damaged or decayed tooth. This process involves the removal of damaged portions, cleaning the affected area, and replacing the lost structure with dental materials such as fillings or crowns. By undergoing tooth restoration, individuals can regain optimal oral health, functionality, and a natural-looking smile. This procedure is a key component of restorative dentistry, ensuring that each patient can enjoy a healthy and fully functional set of teeth.Tooth restoration is a transformative dental procedure designed to renew the health, function, and aesthetics of a compromised tooth. Whether a tooth has suffered from decay, trauma, or wear, the goal of restoration is to preserve the natural tooth structure, prevent further damage, and enhance both oral health and appearance.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.Based on the assessment, the dentist develops a personalized treatment plan. This plan considers factors such as the location of the affected tooth, the extent ', 'active'),
('Q8kHS0DfdJvYcpvJS2Q5', 'Orthodontic Solutions', '23', 'service2.png', 'Tooth restoration is a dental procedure designed to renew the health and integrity of a damaged or decayed tooth. This process involves the removal of damaged portions, cleaning the affected area, and replacing the lost structure with dental materials such as fillings or crowns. By undergoing tooth restoration, individuals can regain optimal oral health, functionality, and a natural-looking smile. This procedure is a key component of restorative dentistry, ensuring that each patient can enjoy a healthy and fully functional set of teeth.Tooth restoration is a transformative dental procedure designed to renew the health, function, and aesthetics of a compromised tooth. Whether a tooth has suffered from decay, trauma, or wear, the goal of restoration is to preserve the natural tooth structure, prevent further damage, and enhance both oral health and appearance.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.Based on the assessment, the dentist develops a personalized treatment plan. This plan considers factors such as the location of the affected tooth, the extent', 'active'),
('EvUbp4gDFXeUL6lEjxRu', 'Restorative Dentistry', '45', 'service3.png', 'Tooth restoration is a dental procedure designed to renew the health and integrity of a damaged or decayed tooth. This process involves the removal of damaged portions, cleaning the affected area, and replacing the lost structure with dental materials such as fillings or crowns. By undergoing tooth restoration, individuals can regain optimal oral health, functionality, and a natural-looking smile. This procedure is a key component of restorative dentistry, ensuring that each patient can enjoy a healthy and fully functional set of teeth.Tooth restoration is a transformative dental procedure designed to renew the health, function, and aesthetics of a compromised tooth. Whether a tooth has suffered from decay, trauma, or wear, the goal of restoration is to preserve the natural tooth structure, prevent further damage, and enhance both oral health and appearance.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.Based on the assessment, the dentist develops a personalized treatment plan. This plan considers factors such as the location of the affected tooth, the extent', 'active'),
('Bv4PWh4bXyWZR0AcRdoo', 'Pediatric Dentistry', '34', 'service4.png', 'Tooth restoration is a dental procedure designed to renew the health and integrity of a damaged or decayed tooth. This process involves the removal of damaged portions, cleaning the affected area, and replacing the lost structure with dental materials such as fillings or crowns. By undergoing tooth restoration, individuals can regain optimal oral health, functionality, and a natural-looking smile. This procedure is a key component of restorative dentistry, ensuring that each patient can enjoy a healthy and fully functional set of teeth.Tooth restoration is a transformative dental procedure designed to renew the health, function, and aesthetics of a compromised tooth. Whether a tooth has suffered from decay, trauma, or wear, the goal of restoration is to preserve the natural tooth structure, prevent further damage, and enhance both oral health and appearance.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.Based on the assessment, the dentist develops a personalized treatment plan. This plan considers factors such as the location of the affected tooth, the extent', 'active'),
('WJwaQ9Z3N6PN9h7HFgnA', 'Oral Surgery', '78', 'service5.png', 'Tooth restoration is a dental procedure designed to renew the health and integrity of a damaged or decayed tooth. This process involves the removal of damaged portions, cleaning the affected area, and replacing the lost structure with dental materials such as fillings or crowns. By undergoing tooth restoration, individuals can regain optimal oral health, functionality, and a natural-looking smile. This procedure is a key component of restorative dentistry, ensuring that each patient can enjoy a healthy and fully functional set of teeth.Tooth restoration is a transformative dental procedure designed to renew the health, function, and aesthetics of a compromised tooth. Whether a tooth has suffered from decay, trauma, or wear, the goal of restoration is to preserve the natural tooth structure, prevent further damage, and enhance both oral health and appearance.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.Based on the assessment, the dentist develops a personalized treatment plan. This plan considers factors such as the location of the affected tooth, the extent', 'active'),
('ZFLjLL91hwAfAGQN1Fcs', 'Gum Disease Treatment', '230', 'service6.png', 'Tooth restoration is a dental procedure designed to renew the health and integrity of a damaged or decayed tooth. This process involves the removal of damaged portions, cleaning the affected area, and replacing the lost structure with dental materials such as fillings or crowns. By undergoing tooth restoration, individuals can regain optimal oral health, functionality, and a natural-looking smile. This procedure is a key component of restorative dentistry, ensuring that each patient can enjoy a healthy and fully functional set of teeth.Tooth restoration is a transformative dental procedure designed to renew the health, function, and aesthetics of a compromised tooth. Whether a tooth has suffered from decay, trauma, or wear, the goal of restoration is to preserve the natural tooth structure, prevent further damage, and enhance both oral health and appearance.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.The process begins with a comprehensive assessment by a skilled dentist. Through visual examinations, imaging, and sometimes digital scans, the extent of damage or decay is evaluated to determine the most suitable restoration approach.Based on the assessment, the dentist develops a personalized treatment plan. This plan considers factors such as the location of the affected tooth, the extent', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('SXOR4znfXsGM83Gzfhpf', 'john', 'johndoe@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'jGPfkM8T4F34LrPexcCt.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
