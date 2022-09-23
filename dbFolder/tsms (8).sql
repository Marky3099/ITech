-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 09:36 AM
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
-- Database: `tsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircon`
--

CREATE TABLE `aircon` (
  `aircon_id` int(11) NOT NULL,
  `device_brand` varchar(225) NOT NULL,
  `aircon_type` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aircon`
--

INSERT INTO `aircon` (`aircon_id`, `device_brand`, `aircon_type`) VALUES
(1, 'Mitsubishi', 'Ceiling cassette'),
(2, 'Mitsubishi', 'Ceiling mounted'),
(3, 'Mitsubishi', 'Wall Mounted'),
(4, 'Mitsubishi', 'Floor Mounted'),
(5, 'LG', 'Ceiling Cassette'),
(6, 'LG', 'Ceiling Mounted'),
(7, 'LG', 'Wall Mounted'),
(8, 'LG', 'Floor Mounted'),
(9, 'Koppel', 'Ceiling Cassette'),
(10, 'Koppel', 'Ceiling Mounted'),
(11, 'Koppel', 'Wall Mounted'),
(12, 'Koppel', 'Floor Mounted'),
(13, 'Carrier', 'Ceiling Cassette'),
(14, 'Carrier', 'Ceiling Mounted'),
(15, 'Carrier', 'Wall Mounted'),
(16, 'Carrier', 'Floor Mounted');

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_events`
-- (See below for the actual view)
--
CREATE TABLE `all_events` (
`serv_id` int(11)
,`client_id` int(11)
,`aircon_id` int(11)
,`id` int(11)
,`title` varchar(255)
,`start_event` date
,`TIME` time
,`end_event` datetime
,`STATUS` varchar(225)
,`area` varchar(225)
,`client_branch` varchar(225)
,`client_address` varchar(225)
,`client_contact` varchar(225)
,`serv_name` varchar(225)
,`serv_description` varchar(225)
,`price` varchar(225)
,`serv_color` char(12)
,`device_brand` varchar(225)
,`aircon_type` varchar(225)
,`quantity` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appt_id` int(11) NOT NULL,
  `appt_date` date NOT NULL,
  `appt_time` time DEFAULT '00:00:00',
  `client_id` int(11) NOT NULL,
  `serv_id` int(11) NOT NULL,
  `aircon_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `appt_status` enum('Pending','Approved','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appt_id`, `appt_date`, `appt_time`, `client_id`, `serv_id`, `aircon_id`, `qty`, `appt_status`) VALUES
(10, '2022-09-23', '13:00:00', 4, 5, 10, 3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `appt_fcu`
--

CREATE TABLE `appt_fcu` (
  `appt_id` int(11) NOT NULL,
  `fcuno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appt_fcu`
--

INSERT INTO `appt_fcu` (`appt_id`, `fcuno`) VALUES
(10, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `appt_fcu_views`
-- (See below for the actual view)
--
CREATE TABLE `appt_fcu_views` (
`appt_id` int(11)
,`fcuno` int(11)
,`fcu` varchar(225)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `calllogs_views`
-- (See below for the actual view)
--
CREATE TABLE `calllogs_views` (
`cl_id` int(11)
,`date` date
,`client_id` int(11)
,`area` varchar(225)
,`client_branch` varchar(225)
,`caller` varchar(225)
,`particulars` varchar(225)
,`aircon_id` int(11)
,`device_brand` varchar(225)
,`aircon_type` varchar(225)
,`qty` int(11)
,`status` varchar(225)
);

-- --------------------------------------------------------

--
-- Table structure for table `call_fcu`
--

CREATE TABLE `call_fcu` (
  `cl_id` int(11) NOT NULL,
  `fcuno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `call_fcu`
--

INSERT INTO `call_fcu` (`cl_id`, `fcuno`) VALUES
(41, 2),
(41, 3),
(38, 3),
(38, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `call_fcu_views`
-- (See below for the actual view)
--
CREATE TABLE `call_fcu_views` (
`cl_id` int(11)
,`fcuno` int(11)
,`fcu` varchar(225)
,`date` date
,`client_id` int(11)
,`area` varchar(225)
,`client_branch` varchar(225)
,`caller` varchar(225)
,`particulars` varchar(225)
,`aircon_id` int(11)
,`device_brand` varchar(225)
,`aircon_type` varchar(225)
,`qty` int(11)
,`status` varchar(225)
);

-- --------------------------------------------------------

--
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `cl_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `caller` varchar(225) NOT NULL,
  `particulars` varchar(225) NOT NULL,
  `aircon_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(225) CHARACTER SET latin1 NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `call_logs`
--

INSERT INTO `call_logs` (`cl_id`, `date`, `client_id`, `caller`, `particulars`, `aircon_id`, `qty`, `status`) VALUES
(38, '2022-08-10', 3, '2', '2', 2, 2, 'Pending'),
(41, '2022-09-04', 9, '1', '1', 13, 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `area` varchar(225) NOT NULL,
  `client_branch` varchar(225) NOT NULL,
  `client_address` varchar(225) NOT NULL,
  `client_contact` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `area`, `client_branch`, `client_address`, `client_contact`) VALUES
(2, 'METRO MANILA', 'TAGUIG', 'TAGUIG', ''),
(3, 'METRO MANILA', 'BDO PASAY', 'PASAY', ''),
(4, 'METRO MANILA', 'BDO MAKATI', 'MAKATI', ''),
(5, 'METRO MANILA', 'BDO PASIG', 'PASIG', ''),
(6, 'METRO MANILA', 'BDO MARIKINA', 'MARIKINA', ''),
(7, 'FAIRVIEW', 'BDO FAIRVIEW', 'FAIRVIEW', ''),
(9, 'BLUMENTRITT', 'BDO CALOOCAN', 'CALOOCAN', ''),
(10, 'BLUMENTRITT', 'BDO RIZAL', 'RIZAL Ave.', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(225) NOT NULL,
  `emp_email` varchar(225) NOT NULL,
  `emp_address` varchar(225) NOT NULL,
  `emp_contact` varchar(225) NOT NULL,
  `emp_position` varchar(225) NOT NULL DEFAULT 'Employee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_email`, `emp_address`, `emp_contact`, `emp_position`) VALUES
(1, 'Markrey', 'markreym0@gmail.com', 'Parañaque', '09260515977', 'Employee'),
(5, 'Zahs', 'zahssabasa4@gmail.com', 'Parañaque', '', 'Employee'),
(6, 'Jillian', 'kristinejillian17@gmail.com', 'Taguig', '', 'Employee'),
(7, 'Joanna', 'joannapadawang@gmail.com', 'Taguig', '', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_event` date NOT NULL,
  `time` time DEFAULT '00:00:00',
  `end_event` datetime DEFAULT NULL,
  `repeatable` enum('None','Monthly','Weekly') NOT NULL DEFAULT 'None',
  `status` varchar(225) NOT NULL DEFAULT 'Pending',
  `client_id` int(11) NOT NULL,
  `serv_id` int(11) NOT NULL,
  `aircon_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start_event`, `time`, `end_event`, `repeatable`, `status`, `client_id`, `serv_id`, `aircon_id`, `quantity`) VALUES
(1, '1:00pm FAIRVIEW', '2022-09-06', '13:00:00', NULL, 'None', 'Pending', 7, 1, 13, 1),
(2, '6:00pm BLUMENTRITT', '2022-09-07', '18:00:00', NULL, 'None', 'Pending', 9, 5, 13, 1),
(3, '12:00am BLUMENTRITT', '2022-09-08', '00:00:00', NULL, 'None', 'Pending', 9, 4, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `event_emp`
--

CREATE TABLE `event_emp` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_emp`
--

INSERT INTO `event_emp` (`id`, `emp_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `event_emp_views`
-- (See below for the actual view)
--
CREATE TABLE `event_emp_views` (
`id` int(11)
,`title` varchar(255)
,`start_event` date
,`time` time
,`status` varchar(225)
,`quantity` int(11)
,`aircon_id` int(11)
,`device_brand` varchar(225)
,`aircon_type` varchar(225)
,`client_id` int(11)
,`area` varchar(225)
,`client_branch` varchar(225)
,`serv_id` int(11)
,`serv_name` varchar(225)
,`serv_description` varchar(225)
,`serv_color` char(12)
,`emp_id` int(11)
,`emp_name` varchar(225)
,`emp_email` varchar(225)
,`emp_address` varchar(225)
,`emp_contact` varchar(225)
,`emp_position` varchar(225)
);

-- --------------------------------------------------------

--
-- Table structure for table `event_fcu`
--

CREATE TABLE `event_fcu` (
  `id` int(11) NOT NULL,
  `fcuno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_fcu`
--

INSERT INTO `event_fcu` (`id`, `fcuno`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `event_fcu_views`
-- (See below for the actual view)
--
CREATE TABLE `event_fcu_views` (
`fcuno` int(11)
,`fcu` varchar(225)
,`id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `fcu_no`
--

CREATE TABLE `fcu_no` (
  `fcuno` int(11) NOT NULL,
  `fcu` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fcu_no`
--

INSERT INTO `fcu_no` (`fcuno`, `fcu`) VALUES
(1, 'FCU 1'),
(2, 'FCU 2'),
(3, 'FCU 3'),
(4, 'FCU 4'),
(5, 'FCU 5'),
(6, 'FCU 6'),
(7, 'FCU 7'),
(8, 'FCU 8'),
(9, 'FCU 9'),
(10, 'FCU 10');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serv_id` int(11) NOT NULL,
  `serv_name` varchar(225) NOT NULL,
  `serv_description` varchar(225) NOT NULL,
  `price` varchar(225) NOT NULL,
  `serv_color` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serv_id`, `serv_name`, `serv_description`, `price`, `serv_color`) VALUES
(1, 'Repair', 'Repair', '1000', '#ff4747'),
(2, 'Installation', 'Installation', '1200', '#d4e302'),
(3, 'Checkup', 'Check-up', '1000', '#0717f2'),
(4, 'Filtration', 'Filtration', '1100', '#0cb5ed'),
(5, 'General Cleaning', 'General Cleaning', '1500', '#f702ef');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `upload_id` int(11) NOT NULL,
  `upload_title` varchar(225) NOT NULL,
  `upload_description` varchar(225) NOT NULL,
  `image` varchar(225) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`upload_id`, `upload_title`, `upload_description`, `image`, `uploaded_at`) VALUES
(7, 'test', 'test Description', '1660277240_8d65842d139ea8fd4cb6.png', '2022-08-12 04:07:20'),
(8, 'pdf', 'pdf', '1660523522_189927cb37edf5a0e89f.pdf', '2022-08-12 04:31:03'),
(9, 'Word', 'docx type', '1660484767_65cc308edd23bc4a1c57.docx', '2022-08-14 13:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `contact` varchar(225) NOT NULL,
  `user_img` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT 'password',
  `position` enum('Employee','Admin') DEFAULT 'Employee',
  `user_id` int(11) NOT NULL,
  `code` varchar(225) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `address`, `contact`, `user_img`, `password`, `position`, `user_id`, `code`, `active`) VALUES
('Zahs', 'Zahs@gmail.com', 'Parañaque City', '09123123112', NULL, '$2y$10$l5c5HCaexE0Xf4oduf74KOXiJ1ltIjdqWquI.U6vtn9xR1/zAyjmW', 'Admin', 20, '', 0),
('test2', 'test2@gmail.com', 'Parañaque City', '09123456781', NULL, '$2y$10$eRGIWe5Tcws2bdmEZkhlf.s9wSmMk1Fg7jRrIgvbs.SH0jcLHoA1C', 'Employee', 27, '', 0),
('Markrey Manabat', 'admin@gmail.com', 'Parañaque City', '09260515977', '1660975017_50897c025bccf8b585f0.jpeg', '$2y$10$6QC6VNF5lsb4NIOqNWxQ5unx/ta1va.wUXpjL2ZXWSrNXC3qY32/2', 'Admin', 37, '', 1),
('admin1', 'admin1@gmail.com', 'Parañaque City', '09123124', '1660899111_1a097f26e38b535297c9.jpeg', '$2y$10$vEW1eiy/0koDb6zEEDMsNujNNxRVz2445GWlmCQrtHuWYt8PVID26', 'Admin', 38, '', 0),
('Client', 'Client@gmail.com', '', '', NULL, '$2y$10$aPZOECoiWNi6F/SDN1mSg.FZ4gapv03YHShJRzK.9fQ4LxQKFRes6', '', 84, '', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_appointment`
-- (See below for the actual view)
--
CREATE TABLE `view_appointment` (
`appt_id` int(11)
,`appt_date` date
,`appt_time` time
,`client_id` int(11)
,`area` varchar(225)
,`client_branch` varchar(225)
,`serv_id` int(11)
,`serv_name` varchar(225)
,`aircon_id` int(11)
,`device_brand` varchar(225)
,`aircon_type` varchar(225)
,`qty` int(11)
,`appt_status` enum('Pending','Approved','Rejected')
);

-- --------------------------------------------------------

--
-- Structure for view `all_events`
--
DROP TABLE IF EXISTS `all_events`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_events`  AS SELECT `events`.`serv_id` AS `serv_id`, `events`.`client_id` AS `client_id`, `events`.`aircon_id` AS `aircon_id`, `events`.`id` AS `id`, `events`.`title` AS `title`, `events`.`start_event` AS `start_event`, `events`.`time` AS `TIME`, `events`.`end_event` AS `end_event`, `events`.`status` AS `STATUS`, `clients`.`area` AS `area`, `clients`.`client_branch` AS `client_branch`, `clients`.`client_address` AS `client_address`, `clients`.`client_contact` AS `client_contact`, `services`.`serv_name` AS `serv_name`, `services`.`serv_description` AS `serv_description`, `services`.`price` AS `price`, `services`.`serv_color` AS `serv_color`, `aircon`.`device_brand` AS `device_brand`, `aircon`.`aircon_type` AS `aircon_type`, `events`.`quantity` AS `quantity` FROM (((`events` join `clients` on(`events`.`client_id` = `clients`.`client_id`)) join `services` on(`events`.`serv_id` = `services`.`serv_id`)) join `aircon` on(`events`.`aircon_id` = `aircon`.`aircon_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `appt_fcu_views`
--
DROP TABLE IF EXISTS `appt_fcu_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `appt_fcu_views`  AS SELECT `appt_fcu`.`appt_id` AS `appt_id`, `appt_fcu`.`fcuno` AS `fcuno`, `fcu_no`.`fcu` AS `fcu` FROM (`appt_fcu` join `fcu_no`) WHERE `appt_fcu`.`fcuno` = `fcu_no`.`fcuno``fcuno`  ;

-- --------------------------------------------------------

--
-- Structure for view `calllogs_views`
--
DROP TABLE IF EXISTS `calllogs_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `calllogs_views`  AS SELECT `call_logs`.`cl_id` AS `cl_id`, `call_logs`.`date` AS `date`, `call_logs`.`client_id` AS `client_id`, `clients`.`area` AS `area`, `clients`.`client_branch` AS `client_branch`, `call_logs`.`caller` AS `caller`, `call_logs`.`particulars` AS `particulars`, `call_logs`.`aircon_id` AS `aircon_id`, `aircon`.`device_brand` AS `device_brand`, `aircon`.`aircon_type` AS `aircon_type`, `call_logs`.`qty` AS `qty`, `call_logs`.`status` AS `status` FROM ((`call_logs` join `clients` on(`call_logs`.`client_id` = `clients`.`client_id`)) join `aircon` on(`call_logs`.`aircon_id` = `aircon`.`aircon_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `call_fcu_views`
--
DROP TABLE IF EXISTS `call_fcu_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `call_fcu_views`  AS SELECT `call_fcu`.`cl_id` AS `cl_id`, `call_fcu`.`fcuno` AS `fcuno`, `fcu_no`.`fcu` AS `fcu`, `call_logs`.`date` AS `date`, `call_logs`.`client_id` AS `client_id`, `clients`.`area` AS `area`, `clients`.`client_branch` AS `client_branch`, `call_logs`.`caller` AS `caller`, `call_logs`.`particulars` AS `particulars`, `call_logs`.`aircon_id` AS `aircon_id`, `aircon`.`device_brand` AS `device_brand`, `aircon`.`aircon_type` AS `aircon_type`, `call_logs`.`qty` AS `qty`, `call_logs`.`status` AS `status` FROM ((((`call_fcu` join `call_logs` on(`call_fcu`.`cl_id` = `call_logs`.`cl_id`)) join `fcu_no` on(`call_fcu`.`fcuno` = `fcu_no`.`fcuno`)) join `clients` on(`call_logs`.`client_id` = `clients`.`client_id`)) join `aircon` on(`call_logs`.`aircon_id` = `aircon`.`aircon_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `event_emp_views`
--
DROP TABLE IF EXISTS `event_emp_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_emp_views`  AS SELECT `events`.`id` AS `id`, `events`.`title` AS `title`, `events`.`start_event` AS `start_event`, `events`.`time` AS `time`, `events`.`status` AS `status`, `events`.`quantity` AS `quantity`, `events`.`aircon_id` AS `aircon_id`, `aircon`.`device_brand` AS `device_brand`, `aircon`.`aircon_type` AS `aircon_type`, `clients`.`client_id` AS `client_id`, `clients`.`area` AS `area`, `clients`.`client_branch` AS `client_branch`, `services`.`serv_id` AS `serv_id`, `services`.`serv_name` AS `serv_name`, `services`.`serv_description` AS `serv_description`, `services`.`serv_color` AS `serv_color`, `event_emp`.`emp_id` AS `emp_id`, `employees`.`emp_name` AS `emp_name`, `employees`.`emp_email` AS `emp_email`, `employees`.`emp_address` AS `emp_address`, `employees`.`emp_contact` AS `emp_contact`, `employees`.`emp_position` AS `emp_position` FROM (((((`event_emp` join `events` on(`event_emp`.`id` = `events`.`id`)) join `clients` on(`events`.`client_id` = `clients`.`client_id`)) join `services` on(`events`.`serv_id` = `services`.`serv_id`)) join `employees` on(`employees`.`emp_id` = `event_emp`.`emp_id`)) join `aircon` on(`events`.`aircon_id` = `aircon`.`aircon_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `event_fcu_views`
--
DROP TABLE IF EXISTS `event_fcu_views`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_fcu_views`  AS SELECT `event_fcu`.`fcuno` AS `fcuno`, `fcu_no`.`fcu` AS `fcu`, `events`.`id` AS `id` FROM ((`event_fcu` join `events` on(`event_fcu`.`id` = `events`.`id`)) join `fcu_no` on(`event_fcu`.`fcuno` = `fcu_no`.`fcuno`))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_appointment`
--
DROP TABLE IF EXISTS `view_appointment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_appointment`  AS SELECT `appointments`.`appt_id` AS `appt_id`, `appointments`.`appt_date` AS `appt_date`, `appointments`.`appt_time` AS `appt_time`, `clients`.`client_id` AS `client_id`, `clients`.`area` AS `area`, `clients`.`client_branch` AS `client_branch`, `services`.`serv_id` AS `serv_id`, `services`.`serv_name` AS `serv_name`, `aircon`.`aircon_id` AS `aircon_id`, `aircon`.`device_brand` AS `device_brand`, `aircon`.`aircon_type` AS `aircon_type`, `appointments`.`qty` AS `qty`, `appointments`.`appt_status` AS `appt_status` FROM (((`appointments` join `clients` on(`appointments`.`client_id` = `clients`.`client_id`)) join `services` on(`appointments`.`serv_id` = `services`.`serv_id`)) join `aircon` on(`appointments`.`aircon_id` = `aircon`.`aircon_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircon`
--
ALTER TABLE `aircon`
  ADD PRIMARY KEY (`aircon_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appt_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `aircon_id` (`aircon_id`),
  ADD KEY `serv_id` (`serv_id`);

--
-- Indexes for table `appt_fcu`
--
ALTER TABLE `appt_fcu`
  ADD KEY `appt_id` (`appt_id`),
  ADD KEY `fcuno` (`fcuno`);

--
-- Indexes for table `call_fcu`
--
ALTER TABLE `call_fcu`
  ADD KEY `cl_id` (`cl_id`),
  ADD KEY `fcuno` (`fcuno`);

--
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`cl_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `aircon_id` (`aircon_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_client_id` (`client_id`),
  ADD KEY `constraint_serv_id` (`serv_id`),
  ADD KEY `constraint_aircon_id` (`aircon_id`);

--
-- Indexes for table `event_emp`
--
ALTER TABLE `event_emp`
  ADD UNIQUE KEY `id` (`id`,`emp_id`),
  ADD KEY `conts_emp_foreign` (`emp_id`);

--
-- Indexes for table `event_fcu`
--
ALTER TABLE `event_fcu`
  ADD KEY `id` (`id`),
  ADD KEY `fcuno` (`fcuno`);

--
-- Indexes for table `fcu_no`
--
ALTER TABLE `fcu_no`
  ADD PRIMARY KEY (`fcuno`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serv_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircon`
--
ALTER TABLE `aircon`
  MODIFY `aircon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fcu_no`
--
ALTER TABLE `fcu_no`
  MODIFY `fcuno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`aircon_id`) REFERENCES `aircon` (`aircon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`serv_id`) REFERENCES `services` (`serv_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appt_fcu`
--
ALTER TABLE `appt_fcu`
  ADD CONSTRAINT `appt_fcu_ibfk_1` FOREIGN KEY (`appt_id`) REFERENCES `appointments` (`appt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appt_fcu_ibfk_2` FOREIGN KEY (`fcuno`) REFERENCES `fcu_no` (`fcuno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `call_fcu`
--
ALTER TABLE `call_fcu`
  ADD CONSTRAINT `call_fcu_ibfk_1` FOREIGN KEY (`cl_id`) REFERENCES `call_logs` (`cl_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `call_fcu_ibfk_2` FOREIGN KEY (`fcuno`) REFERENCES `fcu_no` (`fcuno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD CONSTRAINT `call_logs_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `call_logs_ibfk_2` FOREIGN KEY (`aircon_id`) REFERENCES `aircon` (`aircon_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `constraint_aircon_id` FOREIGN KEY (`aircon_id`) REFERENCES `aircon` (`aircon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constraint_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `constraint_serv_id` FOREIGN KEY (`serv_id`) REFERENCES `services` (`serv_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_emp`
--
ALTER TABLE `event_emp`
  ADD CONSTRAINT `conts_emp_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conts_event_foreign` FOREIGN KEY (`id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_fcu`
--
ALTER TABLE `event_fcu`
  ADD CONSTRAINT `event_fcu_ibfk_1` FOREIGN KEY (`id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_fcu_ibfk_2` FOREIGN KEY (`fcuno`) REFERENCES `fcu_no` (`fcuno`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
