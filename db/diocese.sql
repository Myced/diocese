-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2018 at 12:51 
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
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(5) NOT NULL,
  `year` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `year`) VALUES
(1, '2018/2019');

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
(9, '', '5', '8', '', 'Cedric Tifuh Do Ndi', 'CES-07-P0001', '26', '2007', '', '', '', '', '', '', '', '', '', '50 1552 032', '1', '', '', '', '', '', '', 'M', '', '', '', '5', '', '', 'Miss', '', '2', '', '', '', '', 'Cedric', 'Tifuh', '', '', '', 'Do', 'Ndi', '0', '', '', 'Cameroonian', '', 0, 'gmail@gmail.com', 'work', 'On Campus'),
(8, '', '--', '--', '', 'dfdf   ', 'CES--P0001', '14', '--', '--', '--', '--', 'Non Clergy', '', '', '', '', '', 'dfdfd', '15', '', '', '', '', '', '', 'M', '', '', '', '', '', '', '--', '', '1', '', '', '', '', 'dfdf', '', '--/--/--', '--/--/--', '', '', '', '', '', '', 'Cameroonian', '', 0, '', '', 'On Campus'),
(5, '', '8', '9', '', 'Joyce Yasho Ntuba ', 'CES-10-P0003', '12', '2010', '', '', '', '', '', '', '', '', '', '669 125 456', '', '', '', '', '', '', '', 'F', '', '', '', '', '', '', 'Mrs', '', '2', '', '', '', '', 'Joyce', 'Yasho', '', '', '', 'Ntuba', '', '', '', '', 'Cameroonian', '', 0, 'ma@eru.com', 'nothing', 'On Campus'),
(6, 'uploads/employees/documents/06102018091018kenny.JPG', '6', '8', '', 'JJ Okocha  ', 'CES-09-P0001', '12', '2009', '17', '6', '1994', 'Clergy &amp; Religious', '', '', '', '2', '', '210121255', '10', '', '', '', '', '', '', 'M', '', '455546', '', '5', '', '', 'Mr', 'Not Baptised', '1', '', '', '', '', 'JJ', 'Okocha', '14/3/1984', '16/8/1985', 'SW21', '', '', '', '', 'Ason', 'Cameroonian', '', 0, 'client@gmail.com', 'Driving', 'On Campus'),
(12, 'uploads/employees/documents/07102018111034asibo fashio.png', '18', '11', '', 'INTERNET g FREED  GOOD', 'CES-07-P0004', '10', '2007', '16', '10', '2012', 'Clergy &amp; Religious', '', '', '', '4', '', '855 4522 566', '6', '', '', '', '', '', '', 'M', '', '445580215', '', '5', '', '', 'Miss', 'Not Baptised', '5', '', '', '', '', 'INTERNET g', 'FREED', '14/4/1984', '17/6/2000', '`dfjdkfj', '', 'GOOD', '02', '7', 'toipi', 'Nigerian', '', 0, 'mail@mail.com45', 'Workshop ty', 'On Campus');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_categories`
--

CREATE TABLE `evaluation_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_categories`
--

INSERT INTO `evaluation_categories` (`id`, `name`, `date_added`) VALUES
(1, 'Punctuality', '2018-10-13 10:57:34'),
(2, 'Pedagogy (Teachers only)', '2018-10-13 10:57:34'),
(3, 'Team Spirit', '2018-10-13 10:58:04'),
(4, 'Respect of Hierarchy', '2018-10-13 10:58:04'),
(5, 'Job Focus Skills', '2018-10-13 10:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_category_responses`
--

CREATE TABLE `evaluation_category_responses` (
  `id` int(255) NOT NULL,
  `matricule` varchar(60) NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `total` varchar(60) NOT NULL,
  `year` varchar(30) NOT NULL,
  `term` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_category_responses`
--

INSERT INTO `evaluation_category_responses` (`id`, `matricule`, `category_id`, `total`, `year`, `term`) VALUES
(1, 'CES-09-P0001', '1', '15', '2018/2019', 1);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_essays`
--

CREATE TABLE `evaluation_essays` (
  `id` int(100) NOT NULL,
  `matricule` varchar(60) NOT NULL,
  `training_needed` text NOT NULL,
  `justification` text NOT NULL,
  `exceptional_work` text NOT NULL,
  `general_remark` text NOT NULL,
  `term` varchar(10) NOT NULL,
  `year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_essays`
--

INSERT INTO `evaluation_essays` (`id`, `matricule`, `training_needed`, `justification`, `exceptional_work`, `general_remark`, `term`, `year`) VALUES
(1, 'CES-07-P0004', 'Just come to church', 'Needed by the pastor', 'Good work', 'go to chuch', '1', '2018/2019'),
(2, 'CES-07-P0004', 'Nothing Please', '', '', '', '2', '2018/2019'),
(3, 'CES-10-P0003', '', '', '', '', '1', '2018/2019'),
(4, 'CES-10-P0003', '', '', '', '', '2', '2018/2019'),
(5, 'CES-10P-0002', '', '', '', '', '2', '2018/2019'),
(6, 'CES--P0001', '', '', '', '', '2', '2018/2019');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_questions`
--

CREATE TABLE `evaluation_questions` (
  `id` int(200) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_questions`
--

INSERT INTO `evaluation_questions` (`id`, `category_id`, `question`, `time_added`) VALUES
(2, '1', 'Starting and ending lessons on time (Teachers only)', '2018-10-13 13:28:35'),
(3, '1', 'Respecting working time', '2018-10-13 13:29:09'),
(4, '1', 'Respecting meeting time', '2018-10-13 13:29:09'),
(5, '1', 'Submission of marks and exams on time (Teachers only)', '2018-10-13 13:30:47'),
(7, '2', 'Preparing lesson notes and visual aids', '2018-10-13 13:31:22'),
(8, '2', 'Prepares and submits schemes of work', '2018-10-13 13:31:22'),
(9, '2', 'Creates cordial relationship with students', '2018-10-13 13:31:48'),
(10, '2', 'Prepares teaching materials that clearly match objectives and scheme', '2018-10-13 13:31:48'),
(11, '2', 'Engages students in activities that are appropriate', '2018-10-13 13:34:17'),
(12, '2', 'Demonstrates good grasp of subject matter', '2018-10-13 13:34:17'),
(13, '2', 'Uses appropriate teaching techniques', '2018-10-13 13:35:13'),
(15, '3', 'Collaboration with colleagues', '2018-10-13 13:35:40'),
(16, '3', 'Participation in staff activities', '2018-10-13 13:35:40'),
(17, '3', 'Performing extra duties as requested', '2018-10-13 13:36:05'),
(18, '3', 'Contribution of ideas to better school affairs', '2018-10-13 13:36:05'),
(19, '4', 'Recognise and respect hierarchy', '2018-10-13 13:38:18'),
(20, '4', 'Perform duties as assigned', '2018-10-13 13:38:18'),
(21, '5', 'Reports for work regularly', '2018-10-13 13:40:52'),
(22, '5', 'Expresses himself/herself clearly and is easily understood', '2018-10-13 13:40:52'),
(23, '5', 'Ability to network with staff and stakeholders', '2018-10-13 13:41:19'),
(24, '5', 'Duty consciousness', '2018-10-13 13:41:19'),
(25, '5', 'Is trustworthy', '2018-10-13 13:41:51'),
(26, '5', 'Demonstrates sound judgement in decision making', '2018-10-13 13:41:51'),
(27, '5', 'Adheres to the code of ethics and rules of the school', '2018-10-13 13:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_responses`
--

CREATE TABLE `evaluation_responses` (
  `id` int(255) NOT NULL,
  `matricule` varchar(100) NOT NULL,
  `question_id` varchar(50) NOT NULL,
  `mark` varchar(20) NOT NULL,
  `year` varchar(30) NOT NULL,
  `term` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_responses`
--

INSERT INTO `evaluation_responses` (`id`, `matricule`, `question_id`, `mark`, `year`, `term`) VALUES
(1, 'CES-07-P0004', '3', '4', '2018/2019', 1),
(2, 'CES-07-P0004', '2', '5', '2018/2019', 1),
(3, 'CES-07-P0004', '4', '5', '2018/2019', 1),
(4, 'CES-07-P0004', '5', '5', '2018/2019', 1),
(5, 'CES-07-P0004', '7', '1', '2018/2019', 1),
(6, 'CES-07-P0004', '8', '2', '2018/2019', 1),
(7, 'CES-07-P0004', '9', '3', '2018/2019', 1),
(8, 'CES-07-P0004', '10', '4', '2018/2019', 1),
(9, 'CES-07-P0004', '11', '5', '2018/2019', 1),
(10, 'CES-07-P0004', '12', '5', '2018/2019', 1),
(11, 'CES-07-P0004', '13', '5', '2018/2019', 1),
(12, 'CES-07-P0004', '15', '5', '2018/2019', 1),
(13, 'CES-07-P0004', '16', '4', '2018/2019', 1),
(14, 'CES-07-P0004', '17', '1', '2018/2019', 1),
(15, 'CES-07-P0004', '18', '2', '2018/2019', 1),
(16, 'CES-07-P0004', '2', '1', '2018/2019', 2),
(17, 'CES-07-P0004', '3', '3', '2018/2019', 2),
(18, 'CES-07-P0004', '4', '5', '2018/2019', 2),
(19, 'CES-07-P0004', '5', '5', '2018/2019', 2),
(20, 'CES-07-P0004', '8', '2', '2018/2019', 2),
(21, 'CES-07-P0004', '9', '5', '2018/2019', 2),
(22, 'CES-07-P0004', '10', '4', '2018/2019', 2),
(23, 'CES-07-P0004', '11', '5', '2018/2019', 2),
(24, 'CES-07-P0004', '12', '5', '2018/2019', 2),
(25, 'CES-07-P0004', '13', '5', '2018/2019', 2),
(26, 'CES-07-P0004', '15', '4', '2018/2019', 2),
(27, 'CES-07-P0004', '16', '5', '2018/2019', 2),
(28, 'CES-07-P0004', '17', '4', '2018/2019', 2),
(29, 'CES-07-P0004', '18', '5', '2018/2019', 2),
(30, 'CES-07-P0004', '19', '5', '2018/2019', 2),
(31, 'CES-07-P0004', '20', '5', '2018/2019', 2),
(32, 'CES-07-P0004', '21', '5', '2018/2019', 2),
(33, 'CES-07-P0004', '22', '5', '2018/2019', 2),
(34, 'CES-07-P0004', '23', '5', '2018/2019', 2),
(35, 'CES-07-P0004', '24', '5', '2018/2019', 2),
(36, 'CES-07-P0004', '25', '5', '2018/2019', 2),
(37, 'CES-07-P0004', '26', '5', '2018/2019', 2),
(38, 'CES-07-P0004', '27', '5', '2018/2019', 2),
(39, 'CES-10-P0003', '2', '1', '2018/2019', 1),
(40, 'CES-10-P0003', '3', '5', '2018/2019', 1),
(41, 'CES-10-P0003', '4', '5', '2018/2019', 1),
(42, 'CES-10-P0003', '5', '5', '2018/2019', 1),
(43, 'CES-10-P0003', '7', '5', '2018/2019', 1),
(44, 'CES-10-P0003', '8', '4', '2018/2019', 1),
(45, 'CES-10-P0003', '9', '5', '2018/2019', 1),
(46, 'CES-10-P0003', '10', '4', '2018/2019', 1),
(47, 'CES-10-P0003', '11', '4', '2018/2019', 1),
(48, 'CES-10-P0003', '12', '5', '2018/2019', 1),
(49, 'CES-10-P0003', '13', '3', '2018/2019', 1),
(50, 'CES-10-P0003', '15', '4', '2018/2019', 1),
(51, 'CES-10-P0003', '16', '4', '2018/2019', 1),
(52, 'CES-10-P0003', '17', '4', '2018/2019', 1),
(53, 'CES-10-P0003', '18', '5', '2018/2019', 1),
(54, 'CES-10-P0003', '19', '5', '2018/2019', 1),
(55, 'CES-10-P0003', '20', '5', '2018/2019', 1),
(56, 'CES-10-P0003', '21', '3', '2018/2019', 1),
(57, 'CES-10-P0003', '22', '3', '2018/2019', 1),
(58, 'CES-10-P0003', '23', '3', '2018/2019', 1),
(59, 'CES-10-P0003', '24', '4', '2018/2019', 1),
(60, 'CES-10-P0003', '25', '5', '2018/2019', 1),
(61, 'CES-10-P0003', '26', '5', '2018/2019', 1),
(62, 'CES-10-P0003', '27', '5', '2018/2019', 1),
(63, 'CES-10-P0003', '2', '1', '2018/2019', 2),
(64, 'CES-10-P0003', '3', '2', '2018/2019', 2),
(65, 'CES-10-P0003', '4', '3', '2018/2019', 2),
(66, 'CES-10-P0003', '5', '4', '2018/2019', 2),
(67, 'CES-10-P0003', '7', '5', '2018/2019', 2),
(68, 'CES-10-P0003', '8', '4', '2018/2019', 2),
(69, 'CES-10-P0003', '9', '3', '2018/2019', 2),
(70, 'CES-10-P0003', '10', '2', '2018/2019', 2),
(71, 'CES-10-P0003', '11', '1', '2018/2019', 2),
(72, 'CES-10-P0003', '12', '2', '2018/2019', 2),
(73, 'CES-10-P0003', '13', '3', '2018/2019', 2),
(74, 'CES-10-P0003', '15', '5', '2018/2019', 2),
(75, 'CES-10-P0003', '16', '4', '2018/2019', 2),
(76, 'CES-10-P0003', '17', '3', '2018/2019', 2),
(77, 'CES-10-P0003', '18', '2', '2018/2019', 2),
(78, 'CES-10-P0003', '19', '5', '2018/2019', 2),
(79, 'CES-10-P0003', '20', '5', '2018/2019', 2),
(80, 'CES-10-P0003', '21', '5', '2018/2019', 2),
(81, 'CES-10-P0003', '22', '4', '2018/2019', 2),
(82, 'CES-10-P0003', '23', '3', '2018/2019', 2),
(83, 'CES-10-P0003', '24', '2', '2018/2019', 2),
(84, 'CES-10-P0003', '25', '1', '2018/2019', 2),
(85, 'CES-10-P0003', '26', '0', '2018/2019', 2),
(86, 'CES-10-P0003', '27', '1', '2018/2019', 2),
(87, 'CES-10P-0002', '2', '5', '2018/2019', 2),
(88, 'CES-10P-0002', '3', '5', '2018/2019', 2),
(89, 'CES-10P-0002', '4', '5', '2018/2019', 2),
(90, 'CES-10P-0002', '5', '5', '2018/2019', 2),
(91, 'CES-10P-0002', '7', '4', '2018/2019', 2),
(92, 'CES-10P-0002', '8', '4', '2018/2019', 2),
(93, 'CES-10P-0002', '9', '5', '2018/2019', 2),
(94, 'CES-10P-0002', '10', '5', '2018/2019', 2),
(95, 'CES-10P-0002', '11', '5', '2018/2019', 2),
(96, 'CES-10P-0002', '12', '5', '2018/2019', 2),
(97, 'CES-10P-0002', '13', '5', '2018/2019', 2),
(98, 'CES-10P-0002', '15', '5', '2018/2019', 2),
(99, 'CES-10P-0002', '16', '5', '2018/2019', 2),
(100, 'CES-10P-0002', '17', '5', '2018/2019', 2),
(101, 'CES-10P-0002', '18', '5', '2018/2019', 2),
(102, 'CES-10P-0002', '19', '5', '2018/2019', 2),
(103, 'CES-10P-0002', '20', '5', '2018/2019', 2),
(104, 'CES-10P-0002', '21', '5', '2018/2019', 2),
(105, 'CES-10P-0002', '22', '5', '2018/2019', 2),
(106, 'CES-10P-0002', '23', '5', '2018/2019', 2),
(107, 'CES-10P-0002', '24', '5', '2018/2019', 2),
(108, 'CES-10P-0002', '25', '5', '2018/2019', 2),
(109, 'CES-10P-0002', '26', '5', '2018/2019', 2),
(110, 'CES-10P-0002', '27', '5', '2018/2019', 2),
(111, 'CES-07-P0004', '19', '4', '2018/2019', 1),
(112, 'CES-07-P0004', '20', '4', '2018/2019', 1),
(113, 'CES-07-P0004', '21', '5', '2018/2019', 1),
(114, 'CES-07-P0004', '22', '5', '2018/2019', 1),
(115, 'CES-07-P0004', '23', '4', '2018/2019', 1),
(116, 'CES-07-P0004', '24', '5', '2018/2019', 1),
(117, 'CES-07-P0004', '25', '5', '2018/2019', 1),
(118, 'CES-07-P0004', '26', '5', '2018/2019', 1),
(119, 'CES-07-P0004', '27', '5', '2018/2019', 1),
(120, 'CES--P0001', '2', '2', '2018/2019', 2),
(121, 'CES--P0001', '3', '3', '2018/2019', 2),
(122, 'CES--P0001', '4', '5', '2018/2019', 2),
(123, 'CES--P0001', '5', '5', '2018/2019', 2),
(124, 'CES--P0001', '7', '5', '2018/2019', 2),
(125, 'CES--P0001', '8', '4', '2018/2019', 2),
(126, 'CES--P0001', '9', '5', '2018/2019', 2),
(127, 'CES--P0001', '10', '4', '2018/2019', 2),
(128, 'CES--P0001', '11', '5', '2018/2019', 2),
(129, 'CES--P0001', '12', '4', '2018/2019', 2),
(130, 'CES--P0001', '13', '5', '2018/2019', 2),
(131, 'CES--P0001', '24', '5', '2018/2019', 2),
(132, 'CES--P0001', '25', '5', '2018/2019', 2),
(133, 'CES--P0001', '26', '4', '2018/2019', 2);

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
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(30) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `matricule` varchar(200) NOT NULL,
  `function` varchar(100) NOT NULL,
  `type` varchar(60) NOT NULL,
  `start_date` varchar(30) NOT NULL,
  `end_date` varchar(30) NOT NULL,
  `days` varchar(30) NOT NULL,
  `backup` varchar(200) NOT NULL,
  `backup_matricule` varchar(100) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `remark` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `code`, `name`, `matricule`, `function`, `type`, `start_date`, `end_date`, `days`, `backup`, `backup_matricule`, `locked`, `remark`, `status`, `date_added`) VALUES
(1, '', 'JJ Okocha', 'CES-09-P0001', 'Driver', 'Sick Leave', '30/10/2018', '09/11/2018', '11', 'INTERNET g FREED  GOOD', 'CES-07-P0004', 1, 'Ok', 'Absent', '2018-10-12 20:16:44'),
(2, '', 'Cedric Tifuh Do Ndi', 'CES-07-P0002', '', 'Annual Leave', '09/10/2018', '25/10/2018', '7', 'Janem Ambeng', 'CES-10P-0002', 1, 'Late', 'Red Flag', '2018-10-12 20:17:15'),
(3, '', 'INTERNET g FREED  GOOD', 'CES-07-P0004', 'Cashier', 'Permission', '23/10/2018', '25/10/2018', '2', 'Jane Andang Tifuh', 'CES-08-P0001', 1, 'Ok', 'Returned', '2018-10-12 20:17:51'),
(4, '', 'Janem Ambeng', 'CES-10P-0002', 'Academic Dean 1', 'Sick Leave', '25/10/2018', '26/10/2018', '6', 'Cedric Tifuh Do Ndi', 'CES-07-P0002', 1, 'Ok', 'Returned', '2018-10-16 06:07:30');

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
(7, 'DIOCE-12-12', 1, '06/10/2018', '2018-10-06 14:45:45', '2018-10-06 14:45:45'),
(8, 'DIOCE-12-12', 1, '16/10/2018', '2018-10-16 07:16:17', '2018-10-16 07:16:17'),
(9, 'DIOCE-12-12', 1, '18/10/2018', '2018-10-18 07:33:01', '2018-10-18 07:33:01'),
(10, 'DIOCE-12-12', 1, '18/10/2018', '2018-10-18 08:28:02', '2018-10-18 08:28:02'),
(11, 'DIOCE-12-12', 1, '18/10/2018', '2018-10-18 08:34:35', '2018-10-18 08:34:35'),
(12, 'DIOCE-12-12', 1, '18/10/2018', '2018-10-18 08:37:46', '2018-10-18 08:37:46');

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
(105, 'CES-07-P0004', 'BRONZE', '2005'),
(106, 'CES-07-P0001', 'OTHERS', '20011'),
(107, 'CES-10-P0003', 'MVP', '2010');

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
-- Table structure for table `req_categories`
--

CREATE TABLE `req_categories` (
  `id` int(20) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_categories`
--

INSERT INTO `req_categories` (`id`, `category_name`, `category_code`) VALUES
(1, 'PURCHASES OF MATERIALS', '60'),
(2, 'TRANSPORT COST', '61'),
(3, 'EXTERNAL SERVICES A', '62');

-- --------------------------------------------------------

--
-- Table structure for table `req_content`
--

CREATE TABLE `req_content` (
  `id` int(200) NOT NULL,
  `req_code` varchar(60) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `justification` text NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_content`
--

INSERT INTO `req_content` (`id`, `req_code`, `item_code`, `item_name`, `amount`, `justification`, `time_added`) VALUES
(1, 'REQ-18-003', '6032000', 'FIREWOOD', '9000', 'jesus lord', '2018-10-16 15:37:34'),
(2, 'REQ-18-003', '6032100', 'COOKING GAZ', '9000', 'make up', '2018-10-16 15:37:34'),
(3, 'REQ-18-003', '6120000', 'TRANSPORT BY WATER', '9000201', 'Bad Job', '2018-10-16 15:37:34'),
(4, 'REQ-18-003', '6141000', 'LEAVE TRANSPORT', '9000', '9000', '2018-10-16 15:37:34'),
(5, 'REQ-18-003', '6223000', 'RENTS OF RESIDENTIAL BUILDING', '900021', 'cry', '2018-10-16 15:37:34'),
(6, 'REQ-18-003', '6224000', 'RENTS OF EQUIPMENT', '9000', '9000', '2018-10-16 15:37:34'),
(7, '', '6032000', 'FIREWOOD', '120000', '120000', '2018-10-16 17:53:53'),
(8, '', '6032100', 'COOKING GAZ', '8000', '8000', '2018-10-16 17:53:53'),
(9, '', '6120000', 'TRANSPORT BY WATER', '4000', '4000', '2018-10-16 17:53:53'),
(10, '', '6130000', 'TRANSPORT BY AIR', '88000', '88000', '2018-10-16 17:53:53'),
(11, '', '6141000', 'LEAVE TRANSPORT', '9000', '9000', '2018-10-16 17:53:53'),
(12, '', '6222000', 'RENTS OF NON RESIDENTIAL BUILDINGS', '1000', '1000', '2018-10-16 17:53:53'),
(13, '', '6223000', 'RENTS OF RESIDENTIAL BUILDING', '7000', '7000', '2018-10-16 17:53:53'),
(14, '', '6224000', 'RENTS OF EQUIPMENT', '9000', '9000', '2018-10-16 17:53:53'),
(15, 'REQ-18-003', '6130000', 'TRANSPORT BY AIR', '1230', 'make sense', '2018-10-16 18:07:20'),
(16, 'REQ-18-003', '6142000', 'TRANSPORT ON TRANSFER', '3000', 'fix it now', '2018-10-16 18:07:51'),
(17, 'REQ-18-003', '6110000', 'TRANSPORT', '3909', 'first of his name', '2018-10-16 18:08:11'),
(18, 'REQ-18-003', '6021000', 'PESTICIDES AND WEEDICIDES', '3000', 'comign home', '2018-10-16 18:10:24'),
(19, '', '6032100', 'COOKING GAZ', '43000', 'Fomo', '2018-10-17 12:51:00'),
(20, '', '6130000', 'TRANSPORT BY AIR', '1000', 'Insect', '2018-10-17 12:51:00'),
(21, '', '6142000', 'TRANSPORT ON TRANSFER', '3000', 'Laf out', '2018-10-17 12:51:00'),
(22, '', '6224000', 'RENTS OF EQUIPMENT', '3000', 'No way', '2018-10-17 12:51:00'),
(23, 'REQ-18-003', '6032100', 'COOKING GAZ', '20000', 'no nsne', '2018-10-17 12:53:51'),
(24, 'REQ-18-004', '6032000', 'FIREWOOD', '5000', 'hahaha', '2018-10-17 12:55:25'),
(25, 'REQ-18-005', '6032000', 'FIREWOOD', '3000', 'tifuh', '2018-10-17 12:56:40'),
(27, 'REQ-18-004', '6141000', 'LEAVE TRANSPORT', '1000', 'no justification', '2018-10-17 12:57:07'),
(28, 'REQ-18-005', '6110000', 'TRANSPORT', '4000', 'No justification', '2018-10-17 16:41:02'),
(29, 'REQ-18-005', '6120000', 'TRANSPORT BY WATER', '6000', 'Monkeys', '2018-10-17 16:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `req_count`
--

CREATE TABLE `req_count` (
  `id` int(200) NOT NULL,
  `req_code` varchar(20) NOT NULL,
  `school` varchar(60) NOT NULL,
  `inputer` varchar(300) NOT NULL,
  `authoriser` varchar(300) NOT NULL,
  `month` varchar(100) NOT NULL,
  `items` int(20) NOT NULL,
  `total` varchar(100) NOT NULL,
  `year` varchar(10) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_count`
--

INSERT INTO `req_count` (`id`, `req_code`, `school`, `inputer`, `authoriser`, `month`, `items`, `total`, `year`, `time_added`, `status`) VALUES
(3, 'REQ-18-003', '4', 'Ndi Tifiuh', 'John Mbaj', 'January2010', 10, '9947361', '2018', '2018-10-16 15:37:34', 1),
(4, '', '2', 'Cedric', 'Tifuh', 'June', 4, '50000', '2018', '2018-10-17 12:51:00', 1),
(5, 'REQ-18-003', '1', 'jj Okocha', 'Name', 'January', 1, '20000', '2018', '2018-10-17 12:53:51', 1),
(6, 'REQ-18-004', '5', 'Calester', 'jon', 'July', 2, '6000', '2018', '2018-10-17 12:55:25', 1),
(7, 'REQ-18-005', '5', 'nurse', 'ced', 'frank', 3, '13000', '2018', '2018-10-17 12:56:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `req_items`
--

CREATE TABLE `req_items` (
  `id` int(100) NOT NULL,
  `category_code` varchar(100) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `req_items`
--

INSERT INTO `req_items` (`id`, `category_code`, `item_name`, `item_code`) VALUES
(1, '60', 'PESTICIDES AND WEEDICIDES', '6021000'),
(2, '60', 'FIREWOOD', '6032000'),
(3, '60', 'COOKING GAZ', '6032100'),
(4, '61', 'TRANSPORT', '6110000'),
(5, '61', 'TRANSPORT BY WATER', '6120000'),
(6, '61', 'TRANSPORT BY AIR', '6130000'),
(7, '61', 'LEAVE TRANSPORT', '6141000'),
(8, '61', 'TRANSPORT ON TRANSFER', '6142000'),
(9, '62', 'RENTS OF NON RESIDENTIAL BUILDINGS', '6222000'),
(10, '62', 'RENTS OF RESIDENTIAL BUILDING', '6223000'),
(11, '62', 'RENTS OF EQUIPMENT', '6224000');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `roll` int(50) NOT NULL,
  `matricule` varchar(400) NOT NULL,
  `ecc` varchar(400) NOT NULL,
  `basic` varchar(400) NOT NULL,
  `rent` varchar(400) NOT NULL,
  `special` varchar(400) NOT NULL,
  `seniorit` varchar(400) NOT NULL,
  `grosss` varchar(400) NOT NULL,
  `grosst` varchar(400) NOT NULL,
  `nett` varchar(400) NOT NULL,
  `pit` varchar(400) NOT NULL,
  `act` varchar(400) NOT NULL,
  `lbr` varchar(400) NOT NULL,
  `crtv` varchar(400) NOT NULL,
  `ldt` varchar(400) NOT NULL,
  `nsif` varchar(400) NOT NULL,
  `totald` varchar(400) NOT NULL,
  `net` varchar(400) NOT NULL,
  `day` varchar(400) NOT NULL,
  `year` varchar(400) NOT NULL,
  `month` varchar(400) NOT NULL,
  `cm` int(255) NOT NULL,
  `allowa` varchar(400) NOT NULL,
  `house` varchar(400) NOT NULL,
  `supp` varchar(400) NOT NULL,
  `rentallow` varchar(400) NOT NULL,
  `cfc` varchar(400) NOT NULL,
  `cc` varchar(400) NOT NULL,
  `cnpse` varchar(400) NOT NULL,
  `light` varchar(400) NOT NULL,
  `loan` varchar(400) NOT NULL,
  `schoolid` varchar(400) NOT NULL,
  `extra` varchar(400) NOT NULL,
  `fuel` varchar(400) NOT NULL,
  `other` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salaryy`
--

CREATE TABLE `salaryy` (
  `roll` int(50) NOT NULL,
  `cm` varchar(400) NOT NULL,
  `matricule` varchar(400) NOT NULL,
  `ecc` varchar(400) NOT NULL,
  `basic` varchar(400) NOT NULL,
  `rent` varchar(400) NOT NULL,
  `special` varchar(400) NOT NULL,
  `seniorit` varchar(400) NOT NULL,
  `grosss` varchar(400) NOT NULL,
  `grosst` varchar(400) NOT NULL,
  `nett` varchar(400) NOT NULL,
  `pit` varchar(400) NOT NULL,
  `act` varchar(400) NOT NULL,
  `lbr` varchar(400) NOT NULL,
  `crtv` varchar(400) NOT NULL,
  `ldt` varchar(400) NOT NULL,
  `nsif` varchar(400) NOT NULL,
  `totald` varchar(400) NOT NULL,
  `net` varchar(400) NOT NULL,
  `day` varchar(400) NOT NULL,
  `year` varchar(400) NOT NULL,
  `month` varchar(400) NOT NULL,
  `supp` varchar(400) NOT NULL,
  `rentallow` varchar(400) NOT NULL,
  `house` varchar(400) NOT NULL,
  `cfc` varchar(400) NOT NULL,
  `cc` varchar(400) NOT NULL,
  `loan` varchar(400) NOT NULL,
  `cnpse` varchar(400) NOT NULL,
  `light` varchar(400) NOT NULL,
  `schoolid` varchar(400) NOT NULL,
  `extra` varchar(400) NOT NULL,
  `fuel` varchar(400) NOT NULL,
  `other` varchar(400) NOT NULL,
  `allowa` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(2, 'Bishop Rogan College', 'Molyko Buea', 'BIROCOL', '65656563232', 'admin@admin.com', 'www.birocol.com', 'uploads/schools/logos/20180930070905_logo_name.png', '2018-09-29 10:22:11'),
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
  `ip_address` varchar(100) NOT NULL,
  `day` int(2) NOT NULL,
  `month` int(2) NOT NULL,
  `year` year(4) NOT NULL,
  `date` varchar(30) NOT NULL,
  `mysql_date` varchar(30) NOT NULL,
  `time_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_agent` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `avatar`, `username`, `password`, `level`, `full_name`, `position`, `tel`, `email`, `account_status`, `account_type`, `school`, `ip_address`, `day`, `month`, `year`, `date`, `mysql_date`, `time_added`, `user_agent`) VALUES
(1, 'DIOCE-12-12', 'uploads/employees/documents/08102018101059Screenshot from 2018-08-02 14-13-52.png', 'admin', '$2y$10$FxifGvhAkmKMHnhtRSjG/OgUbcYZ4d/lhvSY9CjWOoSBxxVuBnve6', 1, 'Administrator', 'Admin', '8690159632', 'admin@webmaster.com', 1, 1, ' 1', '', 13, 9, 2018, '13/09/2018', '2018-09-13', '2018-09-29 08:02:46', ''),
(2, 'DIOCE-12-120', 'uploads/avatars/20181018093820_*..png', 'school', '$2y$10$FxifGvhAkmKMHnhtRSjG/OgUbcYZ4d/lhvSY9CjWOoSBxxVuBnve6', 3, 'Principal', 'Principal', '690159632', 'princip@birocol.com', 1, 2, '2', '', 13, 9, 2018, '13/09/2018', '2018-09-13', '2018-09-29 08:02:46', ''),
(3, 'DIOCE-18U0003', '', 'user', '$2y$10$FxifGvhAkmKMHnhtRSjG/OgUbcYZ4d/lhvSY9CjWOoSBxxVuBnve6', 2, 'ced', 'work', 'wereok', 'mail@mail.com', 1, 2, '2', '::1', 18, 10, 2018, '18/10/2018', '2018-10-18', '2018-10-18 06:34:17', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(4, 'DIOCE-18U0004', '', 'jane', '$2y$10$FxifGvhAkmKMHnhtRSjG/OgUbcYZ4d/lhvSY9CjWOoSBxxVuBnve6', 10, 'jane', 'jane', 'jane', 'jane', 1, 2, '2', '::1', 18, 10, 2018, '18/10/2018', '2018-10-18', '2018-10-18 06:36:16', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36');

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
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_categories`
--
ALTER TABLE `evaluation_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_category_responses`
--
ALTER TABLE `evaluation_category_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_essays`
--
ALTER TABLE `evaluation_essays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_questions`
--
ALTER TABLE `evaluation_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_responses`
--
ALTER TABLE `evaluation_responses`
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
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
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
-- Indexes for table `req_categories`
--
ALTER TABLE `req_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_content`
--
ALTER TABLE `req_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_count`
--
ALTER TABLE `req_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_items`
--
ALTER TABLE `req_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`roll`);

--
-- Indexes for table `salaryy`
--
ALTER TABLE `salaryy`
  ADD PRIMARY KEY (`roll`);

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
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `evaluation_categories`
--
ALTER TABLE `evaluation_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `evaluation_category_responses`
--
ALTER TABLE `evaluation_category_responses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `evaluation_essays`
--
ALTER TABLE `evaluation_essays`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `evaluation_questions`
--
ALTER TABLE `evaluation_questions`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `evaluation_responses`
--
ALTER TABLE `evaluation_responses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
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
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `medals`
--
ALTER TABLE `medals`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
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
-- AUTO_INCREMENT for table `req_categories`
--
ALTER TABLE `req_categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `req_content`
--
ALTER TABLE `req_content`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `req_count`
--
ALTER TABLE `req_count`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `req_items`
--
ALTER TABLE `req_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `roll` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `salaryy`
--
ALTER TABLE `salaryy`
  MODIFY `roll` int(50) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
