-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2018 at 11:56 
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diocese`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(50) NOT NULL,
  `profile` varchar(400) NOT NULL,
  `entry_day` varchar(400) NOT NULL,
  `entry_month` varchar(400) NOT NULL,
  `p_issue` varchar(400) NOT NULL,
  `fname` varchar(400) NOT NULL,
  `matricule` varchar(400) NOT NULL,
  `position` varchar(400) NOT NULL,
  `entry_year` varchar(400) NOT NULL,
  `day` varchar(400) NOT NULL,
  `month` varchar(400) NOT NULL,
  `year` varchar(400) NOT NULL,
  `status` varchar(400) NOT NULL,
  `age` varchar(400) NOT NULL,
  `extra` varchar(400) NOT NULL,
  `cat` varchar(400) NOT NULL,
  `married` varchar(400) NOT NULL,
  `qualification` varchar(400) NOT NULL,
  `contact` varchar(400) NOT NULL,
  `hqual` varchar(400) NOT NULL,
  `date` varchar(400) NOT NULL,
  `time` varchar(400) NOT NULL,
  `origin` varchar(400) NOT NULL,
  `workp` varchar(400) NOT NULL,
  `salary` varchar(400) NOT NULL,
  `nsif` varchar(400) NOT NULL,
  `sex` varchar(400) NOT NULL,
  `bank` varchar(400) NOT NULL,
  `idcard` varchar(400) NOT NULL,
  `bankname` varchar(400) NOT NULL,
  `children` varchar(400) NOT NULL,
  `schoolid` varchar(400) NOT NULL,
  `apartment` varchar(400) NOT NULL,
  `prefix` varchar(400) NOT NULL,
  `sac` varchar(400) NOT NULL,
  `school_id` varchar(400) NOT NULL,
  `next_of_kin` varchar(400) NOT NULL,
  `disability` varchar(400) NOT NULL,
  `religion` varchar(400) NOT NULL,
  `pref` varchar(400) NOT NULL,
  `f_name` varchar(400) NOT NULL,
  `m_name` varchar(400) NOT NULL,
  `date_issue` varchar(400) NOT NULL,
  `date_expire` varchar(50) NOT NULL,
  `id_issue` varchar(20) NOT NULL,
  `l_name` varchar(400) NOT NULL,
  `o_name` varchar(400) NOT NULL,
  `achildren` varchar(400) NOT NULL,
  `dependent` varchar(400) NOT NULL,
  `birth_place` varchar(400) NOT NULL,
  `nationality` varchar(400) NOT NULL,
  `bepha` varchar(400) NOT NULL,
  `cm` int(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `competence` text NOT NULL,
  `residence` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `profile`, `entry_day`, `entry_month`, `p_issue`, `fname`, `matricule`, `position`, `entry_year`, `day`, `month`, `year`, `status`, `age`, `extra`, `cat`, `married`, `qualification`, `contact`, `hqual`, `date`, `time`, `origin`, `workp`, `salary`, `nsif`, `sex`, `bank`, `idcard`, `bankname`, `children`, `schoolid`, `apartment`, `prefix`, `sac`, `school_id`, `next_of_kin`, `disability`, `religion`, `pref`, `f_name`, `m_name`, `date_issue`, `date_expire`, `id_issue`, `l_name`, `o_name`, `achildren`, `dependent`, `birth_place`, `nationality`, `bepha`, `cm`, `email`, `competence`, `residence`) VALUES
(10, '', '5', '8', '', 'Cedric Tifuh Do Ndi', 'CES-07-P0002', '', '2007', '', '', '', '', '', '', '', '', '', '50 1552 032', '', '', '', '', '', '', '', 'M', '', '', '', '', '', '', 'Miss', '', '', '', '', '', '', 'Cedric', 'Tifuh', '', '', '', 'Do', 'Ndi', '', '', '', 'Cameroonian', '', 0, 'gmail@gmail.com', '', ''),
(11, '', '5', '8', '', 'Cedric Tifuh Do Ndi', 'CES-07-P0003', '', '2007', '', '', '', '', '', '', '', '', '', '50 1552 032', '', '', '', '', '', '', '', 'M', '', '', '', '', '', '', 'Miss', '', '', '', '', '', '', 'Cedric', 'Tifuh', '', '', '', 'Do', 'Ndi', '', '', '', 'Cameroonian', '', 0, 'gmail@gmail.com', '', ''),
(2, '', '3', '3', '', 'Janem Ambeng  ', 'CES-10P-0002', '3', '2010', '', '', '', '', '', '', '', '', '', '650232565', '', '', '', '', '', '', '', 'M', '', '', '', '', '', '', 'Mrs', '', '', '', '', '', '', 'Janem', 'Ambeng', '', '', '', '', '', '', '', '', 'Cameroonian', '', 0, 'myemai@yahoo.com', '', ''),
(3, 'uploads/employees/documents/06102018071003add contact.png', '4', '9', '', 'Jane Andang Tifuh ', 'CES-08-P0001', '32', '2008', '15', '9', '1983', 'Non Clergy', '', '', '', '2', '', '690 265 0896', '2', '', '', '', '', '', '', 'M', '', '', '', '4', '', '', 'Miss', 'Baptised', '2', '', '', '', '', 'Jane', 'Andang', '14/6/1980', '13/8/1980', 'SW20', 'Tifuh', '', '6', '5', 'Muyuka', 'Nigerian', '', 0, 'mail@mailinator.com', 'Teaching', 'Off Campus'),
(9, '', '5', '8', '', 'Cedric Tifuh Do Ndi', 'CES-07-P0001', '', '2007', '', '', '', '', '', '', '', '', '', '50 1552 032', '', '', '', '', '', '', '', 'M', '', '', '', '', '', '', 'Miss', '', '', '', '', '', '', 'Cedric', 'Tifuh', '', '', '', 'Do', 'Ndi', '', '', '', 'Cameroonian', '', 0, 'gmail@gmail.com', '', ''),
(8, '', '--', '--', '', 'dfdf   ', 'CES--P0001', '14', '--', '--', '--', '--', 'Non Clergy', '', '', '', '', '', 'dfdfd', '15', '', '', '', '', '', '', 'M', '', '', '', '', '', '', '--', '', '1', '', '', '', '', 'dfdf', '', '--/--/--', '--/--/--', '', '', '', '', '', '', 'Cameroonian', '', 0, '', '', 'On Campus'),
(5, '', '8', '9', '', 'Joyce Yasho Ntuba ', 'CES-10-P0003', '', '2010', '', '', '', '', '', '', '', '', '', '669 125 456', '', '', '', '', '', '', '', 'F', '', '', '', '', '', '', 'Mrs', '', '', '', '', '', '', 'Joyce', 'Yasho', '', '', '', 'Ntuba', '', '', '', '', 'Cameroonian', '', 0, 'ma@eru.com', '', ''),
(6, 'uploads/employees/documents/06102018091018kenny.JPG', '6', '8', '', 'JJ Okocha  ', 'CES-09-P0001', '12', '2009', '17', '6', '1994', 'Clergy &amp; Religious', '', '', '', '2', '', '210121255', '10', '', '', '', '', '', '', 'M', '', '455546', '', '5', '', '', 'Mr', 'Not Baptised', '1', '', '', '', '', 'JJ', 'Okocha', '14/3/1984', '16/8/1985', 'SW21', '', '', '', '', 'Ason', 'Cameroonian', '', 0, 'client@gmail.com', 'Driving', 'On Campus'),
(12, 'uploads/employees/documents/07102018111034asibo fashio.png', '18', '11', '', 'INTERNET g FREED  GOOD', 'CES-07-P0004', '10', '2007', '16', '10', '2012', 'Clergy &amp; Religious', '', '', '', '4', '', '855 4522 566', '6', '', '', '', '', '', '', 'M', '', '445580215', '', '5', '', '', 'Miss', 'Not Baptised', '5', '', '', '', '', 'INTERNET g', 'FREED', '14/4/1984', '17/6/2000', '`dfjdkfj', '', 'GOOD', '02', '7', 'toipi', 'Nigerian', '', 0, 'mail@mail.com45', 'Workshop ty', 'On Campus');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(255) NOT NULL,
  `matricule` varchar(400) NOT NULL,
  `name` varchar(400) NOT NULL,
  `type` varchar(400) NOT NULL,
  `location` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `matricule`, `name`, `type`, `location`) VALUES
(3, 'CES-08-P0001', 'Picture', 'png', 'uploads/employees/documents/06102018071003add contact.png'),
(6, 'CES-09-P0001', 'Picture', 'jpg', 'uploads/employees/documents/06102018091018kenny.JPG'),
(7, 'CES-09-P0001', 'Contract', 'png', 'uploads/employees/documents/06102018091040Screenshot from 2018-08-01 10-20-35.png'),
(10, 'CES-07-P0004', 'Picture', 'png', 'uploads/employees/documents/07102018111034asibo fashio.png'),
(12, 'CES-07-P0004', 'Birth Certificate', 'png', 'uploads/employees/documents/08102018101059Screenshot from 2018-08-02 14-13-52.png'),
(14, 'CES-07-P0004', 'Bachelor''s Degree', 'pdf', 'uploads/employees/documents/08102018101052Receipt.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE `functions` (
  `id` int(50) NOT NULL,
  `function` text NOT NULL,
  `extra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`id`, `function`, `extra`) VALUES
(1, 'Matron', ''),
(2, 'Teacher', ''),
(3, 'Academic Dean 1', ''),
(4, 'Canteen Manager', ''),
(5, 'Principal', ''),
(6, 'Accountant', ''),
(7, 'Academic Dean 2', ''),
(8, 'Academic Dean 3', ''),
(9, 'Canteen', ''),
(10, 'Cashier', ''),
(11, 'Cook', ''),
(12, 'Driver', ''),
(13, 'Dean of Student Life 1', ''),
(14, 'Dean of Student Life 2', ''),
(15, 'Farm Attendant', ''),
(16, 'Nurse', ''),
(17, 'Plumber/Electrician', ''),
(18, 'Refectory/Kitchen', ''),
(19, 'Sanitation', ''),
(20, 'Secretary', ''),
(21, 'Security', ''),
(22, 'Head of Department', ''),
(23, 'Stores Accountant', ''),
(24, 'Vice Principal', ''),
(25, 'Chaplain', ''),
(26, 'Dormitary Supretendent', ''),
(27, 'Archive Secretary', ''),
(28, 'Assistant Dormitary Supretendent', ''),
(29, 'Compound Care', ''),
(30, 'Staff Delegate', ''),
(31, 'Rector', ''),
(32, 'Bursar', ''),
(33, 'Kitchen Supretendent', ''),
(34, 'Seminarian', ''),
(35, 'General Maintenance', ''),
(36, 'Driver and Maintenance', ''),
(37, 'Assistant Secretary', ''),
(38, 'Librarian', ''),
(39, 'Counsellor', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(250) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date` varchar(20) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `status`, `date`, `time_added`, `logout`) VALUES
(1, 'DIOCE-12-12', 1, '29/09/2018', '2018-09-29 08:31:55', '2018-09-29 08:31:55'),
(2, 'DIOCE-12-120', 1, '29/09/2018', '2018-09-29 08:37:36', '2018-09-29 08:37:36'),
(3, 'DIOCE-12-12', 1, '29/09/2018', '2018-09-29 08:40:30', '2018-09-29 08:40:30'),
(4, 'DIOCE-12-12', 1, '30/09/2018', '2018-09-30 05:10:36', '2018-09-30 05:10:36'),
(5, 'DIOCE-12-12', 1, '01/10/2018', '2018-10-01 03:28:29', '2018-10-01 03:28:29'),
(6, 'DIOCE-12-12', 1, '02/10/2018', '2018-10-02 01:22:15', '2018-10-02 01:22:15'),
(7, 'DIOCE-12-12', 1, '06/10/2018', '2018-10-06 14:45:45', '2018-10-06 14:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `medals`
--

CREATE TABLE `medals` (
  `id` int(255) NOT NULL,
  `matricule` varchar(400) NOT NULL,
  `medal` varchar(400) NOT NULL,
  `date_issued` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medals`
--

INSERT INTO `medals` (`id`, `matricule`, `medal`, `date_issued`) VALUES
(85, '334-dfj4', 'LONG SERVING', '2010'),
(86, '334-dfj4', 'SILVER', '2020'),
(87, '334-dfj4', 'PLATINIUM', '2015'),
(92, 'CES-08-P0001', 'LONG SERVING', '2030'),
(93, 'CES-08-P0001', 'GOLD', '2018'),
(94, 'CES-08-P0001', 'BRONZE', '2005'),
(98, 'CES-09-P0001', 'SILVER', '2010'),
(99, 'CES-09-P0001', 'GOLD', '2013'),
(102, 'CES-07-P0004', 'LONG SERVING', '50123'),
(103, 'CES-07-P0004', 'GOLD', '2011'),
(104, 'CES-07-P0004', 'SILVER', '2019'),
(105, 'CES-07-P0004', 'BRONZE', '2005');

-- --------------------------------------------------------

--
-- Table structure for table `personnel_id_card`
--

CREATE TABLE `personnel_id_card` (
  `id` int(255) NOT NULL,
  `id_type` varchar(400) NOT NULL,
  `employee_id` varchar(400) NOT NULL,
  `id_num` varchar(400) NOT NULL,
  `place_of_issue` varchar(400) NOT NULL,
  `date_of_issue` varchar(400) NOT NULL,
  `date_of_expire` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel_id_card`
--

INSERT INTO `personnel_id_card` (`id`, `id_type`, `employee_id`, `id_num`, `place_of_issue`, `date_of_issue`, `date_of_expire`) VALUES
(2, 'ID Card', 'CES-08-P0001', '1123655', 'SW20', '14/6/1980', '13/8/1980'),
(4, 'ID Card', 'CES-09-P0001', '455546', 'SW21', '14/3/1984', '16/8/1985'),
(6, 'ID Card', 'CES--P0001', '', '', '--/--/--', '--/--/--'),
(7, 'ID Card', 'CES-07-P0004', '445580215', '`dfjdkfj', '14/4/1984', '17/6/2000');

-- --------------------------------------------------------

--
-- Table structure for table `personnel_nok`
--

CREATE TABLE `personnel_nok` (
  `id` int(255) NOT NULL,
  `employee_id` varchar(400) NOT NULL,
  `name_nok` varchar(400) NOT NULL,
  `tel_nok` varchar(400) NOT NULL,
  `relation_nok` varchar(400) NOT NULL,
  `name_ice` varchar(400) NOT NULL,
  `tel1_ice` varchar(400) NOT NULL,
  `tel2_ice` varchar(15) NOT NULL,
  `relation_ice` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel_nok`
--

INSERT INTO `personnel_nok` (`id`, `employee_id`, `name_nok`, `tel_nok`, `relation_nok`, `name_ice`, `tel1_ice`, `tel2_ice`, `relation_ice`) VALUES
(8, 'CES-08-P0001', '', '', '', 'Glenis', '698745', '', 'Sister'),
(10, 'CES-09-P0001', '', '', '', 'Joe Timben', '6754544', '', 'Brother'),
(12, 'CES--P0001', '', '', '', 'dfdf', 'dfdf', '', ''),
(13, 'CES-07-P0004', '', '', '', 'Jesus', '589 785 4136', 'nothing burger', 'Almighty');

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `id` int(50) NOT NULL,
  `fname` varchar(400) NOT NULL,
  `cat` varchar(400) NOT NULL,
  `salaried` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualification`
--

INSERT INTO `qualification` (`id`, `fname`, `cat`, `salaried`) VALUES
(1, 'Masters 2', '11', ''),
(2, 'Masters 1', '11', ''),
(3, 'Diploma +2', '6', ''),
(4, 'Diploma', '5', ''),
(5, 'FSLC', '4', ''),
(6, 'Ordinary Level', '7', ''),
(7, 'Advanced Level', '8', ''),
(8, 'HND', '9', ''),
(9, 'Bachelor Degree', '10', '380020'),
(10, 'Masters', '11', '405205'),
(11, 'Doctorate', '12', ''),
(12, 'Other', '0', ''),
(13, 'DIPES 1', '11', ''),
(14, 'DIPES 2', '11', ''),
(15, 'None', '0', ''),
(16, 'Technical Studies', '22', '100');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `abbreviation` varchar(30) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `website` varchar(100) NOT NULL,
  `logo` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `address`, `abbreviation`, `tel`, `email`, `website`, `logo`, `time_added`) VALUES
(1, 'Bishop Rogan College', 'Molyko Buea', 'BIROCOL', '65656563232', 'admin@admin.com', 'admin@admin.com', '', '2018-09-29 10:17:18'),
(2, 'Bishop Rogan College', 'Molyko Buea', 'BIROCOL2', '65656563232', 'admin@admin.com', 'www.birocol.com', 'uploads/schools/logos/20180930070905_logo_name.png', '2018-09-29 10:22:11'),
(4, 'Try on', 'ashon', 'Jimbo', '54454545', 'mail@mail.com', 'googl.com', 'uploads/schools/logos/20180930070945_Screenshot from 2018-07-18 16-10-28.png', '2018-09-30 05:21:45'),
(5, 'yu', '', 'ui', 'ioopi', 'uioo', '', '', '2018-10-06 07:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `schools_attended`
--

CREATE TABLE `schools_attended` (
  `id` int(50) NOT NULL,
  `matricule` varchar(60) NOT NULL,
  `school` text NOT NULL,
  `certificate` text NOT NULL,
  `year` varchar(10) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools_attended`
--

INSERT INTO `schools_attended` (`id`, `matricule`, `school`, `certificate`, `year`, `time_added`) VALUES
(4, '334-dfj4', 'GHS Ashong', 'GCE O Level', '2018', '2018-10-03 20:22:38'),
(8, '334-dfj4', '', '', '', '2018-10-03 20:48:11'),
(11, 'CES-08-P0001', 'Tiko External', 'O Level', '2011', '2018-10-06 05:46:18'),
(12, 'CES-08-P0001', 'Buea Primary School', 'FSLC', '2006', '2018-10-06 05:46:35'),
(15, 'CES-09-P0001', 'Ghs Ashong', 'OL', '2015', '2018-10-06 19:14:35'),
(18, 'CES-07-P0004', 'jesus', 'jdfj', 'jdfjk', '2018-10-07 21:02:37'),
(19, 'CES-07-P0004', 'jfkdj', 'jdkfjk', 'jkdfjk', '2018-10-07 21:02:42'),
(20, 'CES-07-P0004', 'edfdf', 'dfjd', 'dfjkdfj', '2018-10-08 08:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(10) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `tel` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `account_status` int(10) NOT NULL DEFAULT '1',
  `account_type` int(2) NOT NULL DEFAULT '2',
  `school` varchar(30) NOT NULL DEFAULT ' ',
  `day` int(2) NOT NULL,
  `month` int(2) NOT NULL,
  `year` year(4) NOT NULL,
  `date` varchar(30) NOT NULL,
  `mysql_date` varchar(30) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `avatar`, `username`, `password`, `level`, `full_name`, `position`, `tel`, `email`, `account_status`, `account_type`, `school`, `day`, `month`, `year`, `date`, `mysql_date`, `time_added`) VALUES
(1, 'DIOCE-12-12', '', 'admin', '$2y$10$OpU4XKiMsf/fzGvNvGkKPu69mICqOjUy6Q9aeOYUjs6KdiapjgD6.', 1, 'Administrator', 'Admin', '690159632', 'admin@webmaster.com', 1, 1, ' ', 13, 9, 2018, '13/09/2018', '2018-09-13', '2018-09-29 08:02:46'),
(2, 'DIOCE-12-120', '', 'school', '$2y$10$OpU4XKiMsf/fzGvNvGkKPu69mICqOjUy6Q9aeOYUjs6KdiapjgD6.', 3, 'Principal', 'Principal', '690159632', 'princip@birocol.com', 1, 2, ' 1', 13, 9, 2018, '13/09/2018', '2018-09-13', '2018-09-29 08:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `id` int(100) NOT NULL,
  `matricule` varchar(50) NOT NULL,
  `institution` text NOT NULL,
  `function` text NOT NULL,
  `year_start` varchar(10) NOT NULL,
  `year_end` varchar(10) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`id`, `matricule`, `institution`, `function`, `year_start`, `year_end`, `time_added`) VALUES
(1, '334-dfj4', 'Buea Insitutute of Technology', 'Teacher', '2010', '2012', '2018-10-04 05:22:18'),
(2, '334-dfj4', 'GHS', 'Cleaner', '2012', '2018', '2018-10-04 05:24:05'),
(4, '334-dfj4', 'PEFSCOM', 'Lead developer', '2017', '2018', '2018-10-04 05:29:38'),
(5, 'CES-08-P0001', 'ICS Cameroon', 'Singer', '2015', '2016', '2018-10-06 05:47:22'),
(6, 'CES-08-P0001', 'Phones', 'funtins', '2001', '2003', '2018-10-06 05:47:38'),
(8, 'CES-09-P0001', 'Jumbo', 'worker', '2015', '2018', '2018-10-06 19:17:13'),
(10, 'CES-07-P0004', 'Insitution', 'function', 'year', 'year', '2018-10-07 21:20:36'),
(11, 'CES-07-P0004', 'Joe', 'teacher', '201', '1202', '2018-10-08 08:39:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medals`
--
ALTER TABLE `medals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel_id_card`
--
ALTER TABLE `personnel_id_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel_nok`
--
ALTER TABLE `personnel_nok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools_attended`
--
ALTER TABLE `schools_attended`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `functions`
--
ALTER TABLE `functions`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `medals`
--
ALTER TABLE `medals`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT for table `personnel_id_card`
--
ALTER TABLE `personnel_id_card`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `personnel_nok`
--
ALTER TABLE `personnel_nok`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `qualification`
--
ALTER TABLE `qualification`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `schools_attended`
--
ALTER TABLE `schools_attended`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
