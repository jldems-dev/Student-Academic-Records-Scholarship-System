-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2022 at 06:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csavgsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `sub_code` varchar(50) NOT NULL,
  `subid` int(11) NOT NULL,
  `teachid` int(11) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `sy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `sub_code`, `subid`, `teachid`, `schedule`, `time`, `sy`) VALUES
(1, 'CSTW422', 1, 1, '../../../', '0:00-0:00', '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `full_course_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `full_course_name`) VALUES
(1, 'BSCS', 'Bachelor Of Science In Computer Science'),
(2, 'BSIS', 'Bachelor Of Science In Information System'),
(3, 'BEED', 'Bachelor Of Elementary Education');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `dp_name` varchar(100) NOT NULL,
  `dp_description` varchar(100) NOT NULL,
  `logo_path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dp_name`, `dp_description`, `logo_path`) VALUES
(1, 'IT', 'Information Technology', '../../img/IT.png');

-- --------------------------------------------------------

--
-- Table structure for table `gradesheets`
--

CREATE TABLE `gradesheets` (
  `id` int(11) NOT NULL,
  `class_standing` int(11) NOT NULL,
  `quizzes` int(11) NOT NULL,
  `practical_exam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gradesheets`
--

INSERT INTO `gradesheets` (`id`, `class_standing`, `quizzes`, `practical_exam`) VALUES
(1, 40, 20, 40);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date`, `activity`, `userid`) VALUES
(1, '2022-04-27 11:02:11 PM', 'Admin Update Account Information', 1),
(2, '2022-04-27 11:03:47 PM', 'Admin Add New Department: IT-Information Technology', 1),
(3, '2022-04-27 11:05:50 PM', 'Admin Add New Faculty: Donie D. Delina', 1),
(4, '2022-04-27 11:07:30 PM', 'Admin Add New Course: BSCS-Bachelor Of Science In Computer Science', 1),
(5, '2022-04-27 11:11:37 PM', 'Admin Add New Course: BSIS-Bachelor Of Science In Information System', 1),
(6, '2022-04-27 11:12:37 PM', 'Admin Add New Course: BEED-Bachelor Of Elementary Education', 1),
(7, '2022-04-27 11:13:13 PM', 'Admin Add New Subject Record: BSCS - 4 - 1st Semester', 1),
(8, '2022-04-27 11:14:45 PM', 'Admin Update Grade Sheets', 1),
(9, '2022-04-27 11:14:48 PM', 'Admin Update Grade Sheets', 1),
(10, '2022-04-27 11:14:56 PM', 'Admin Update Grade Sheets', 1),
(11, '2022-04-27 11:19:42 PM', 'Admin Update Grade Sheets', 1),
(12, '2022-04-27 11:19:46 PM', 'Admin Update Grade Sheets', 1),
(13, '2022-04-27 11:22:30 PM', 'Admin Add New Student: John Lyric S. Demegillo', 1),
(14, '2022-04-27 11:26:17 PM', 'Admin Assign Subject CSTW422 Thesis Writing 2', 1),
(15, '2022-04-27 11:26:49 PM', 'Admin Assign Subject CSHI411 Human Computer Interaction', 1),
(16, '2022-04-27 11:29:29 PM', 'Admin Add Student Grades Record ', 1),
(17, '2022-04-27 11:54:31 PM', 'User Account Information Update', 3),
(18, '2022-04-27 11:54:36 PM', 'User Account Information Update', 3),
(19, '2022-04-27 11:55:52 PM', 'Scholarship Admin Update Account Password', 2),
(20, '2022-04-28 12:04:08 AM', 'Scholarship Admin Add Announcement', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `notif_name` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `term` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `studid`, `notif_name`, `message`, `term`, `date`, `active`) VALUES
(1, 1, 'Grade', 'You have a Grades on Subject: CSTW422', 'Prelim', '2022-04-27 11:51:56 PM', 0),
(2, 1, 'Announcement', 'New Announcement Posted', '', '2022-04-28 12:04:08 AM', 0),
(3, 1, 'Grade', 'You have a Grades on Subject: CSTW422', 'Midterm', '2022-04-28 12:29:34 AM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `studno` varchar(50) NOT NULL,
  `student_fullname` varchar(50) NOT NULL,
  `student_request` varchar(200) NOT NULL,
  `sy` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `studid`, `type`, `studno`, `student_fullname`, `student_request`, `sy`, `semester`, `student_email`, `date`, `status`) VALUES
(1, 1, 'Grades', '18-0231-2', 'John Lyric S. Demegillo', 'True Copy of Final Grades', '2021-2022', '1st', 'johnlyric.demegillo@csav.edu.ph', '2022-04-28 12:13:30 AM', '0');

-- --------------------------------------------------------

--
-- Table structure for table `schname_studlist`
--

CREATE TABLE `schname_studlist` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `schname_id` int(11) NOT NULL,
  `schprog_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sch_ancmt`
--

CREATE TABLE `sch_ancmt` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `link` varchar(2000) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sch_ancmt`
--

INSERT INTO `sch_ancmt` (`id`, `title`, `message`, `link`, `date`) VALUES
(1, 'Philippines Scholarship ', 'LANDBANK Scholarship 2022\nFor more info, visit https://bit.ly/LANDBANK-Scholarship\n#scholarship, #PhilippinesScholarship, #LANDBANK', 'https://www.facebook.com/groups/CHEDscholarship/', '2022-04-28 12:04:08 AM');

-- --------------------------------------------------------

--
-- Table structure for table `sch_ancmtimg`
--

CREATE TABLE `sch_ancmtimg` (
  `id` int(11) NOT NULL,
  `ancmt_id` int(11) NOT NULL,
  `file_name` varchar(20) NOT NULL,
  `image_path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sch_ancmtimg`
--

INSERT INTO `sch_ancmtimg` (`id`, `ancmt_id`, `file_name`, `image_path`) VALUES
(4, 1, '277755094.jpg', 'anctmimages/277755094.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sch_applctionform`
--

CREATE TABLE `sch_applctionform` (
  `id` int(11) NOT NULL,
  `sch_nameid` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `stud_idnum` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `given_name` varchar(100) NOT NULL,
  `ext_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `bday` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year_lvl` varchar(100) NOT NULL,
  `f_lname` varchar(100) NOT NULL,
  `f_gname` varchar(100) NOT NULL,
  `f_mname` varchar(100) NOT NULL,
  `m_lname` varchar(100) NOT NULL,
  `m_gname` varchar(100) NOT NULL,
  `m_mname` varchar(100) NOT NULL,
  `dswd_hsno` varchar(100) NOT NULL,
  `hsh_no` varchar(100) NOT NULL,
  `brgy` varchar(100) NOT NULL,
  `zpcode` varchar(100) NOT NULL,
  `first_sem` varchar(100) NOT NULL,
  `second_sem` varchar(100) NOT NULL,
  `dsblty` varchar(100) NOT NULL,
  `cntct_num` varchar(100) NOT NULL,
  `email_add` varchar(100) NOT NULL,
  `sy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sch_files`
--

CREATE TABLE `sch_files` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `sch_name` varchar(50) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `file_path` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sch_name`
--

CREATE TABLE `sch_name` (
  `id` int(11) NOT NULL,
  `scholarprogram_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `requirements` varchar(1999) NOT NULL,
  `qualification` varchar(1999) NOT NULL,
  `sy` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sch_name`
--

INSERT INTO `sch_name` (`id`, `scholarprogram_id`, `name`, `link`, `requirements`, `qualification`, `sy`, `status`) VALUES
(1, 1, 'CHED Scholarship', 'https://ched.gov.ph/programs-and-projects/', 'A certified true copy of the birth certificate;\n\n2. Proof of Income (any of the following)\n\nFor children of OFWs and seafarers, a photocopy of any of the following:\nThe latest copy of the contract;\nProof of income\nFor children of non-OFWs, a photocopy of any of the following:\nPhotocopy of the latest Income Tax Return of parents or guardian;\nCertificate of Tax Exemption from the Bureau of Internal Revenue\nCase study from the Department of Social Welfare and Development (DSWD)\nAffidavit of No Income\nCertificate of Indigency from Barangay', 'He or she must be a Filipino citizen;\nHe or she must be a senior high school graduate and/or candidate for graduation;\nThe family gross income must not exceed four hundred thousand pesos (Php 400,000.00)*\nMust avail of only one CHED scholarship or financial assistance program; and\nMust not be a graduate of any degree program.', '2021-2022', 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `sch_notif`
--

CREATE TABLE `sch_notif` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `studid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sch_program`
--

CREATE TABLE `sch_program` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sch_program`
--

INSERT INTO `sch_program` (`id`, `title`) VALUES
(1, 'Academic Scholarship Program');

-- --------------------------------------------------------

--
-- Table structure for table `sch_selectstudents`
--

CREATE TABLE `sch_selectstudents` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `studid` varchar(60) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(2) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  `section` varchar(50) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `userid`, `studid`, `fname`, `mname`, `lname`, `course`, `year`, `section`, `gender`, `email`) VALUES
(1, 4, '18-0231-2', 'John Lyric', 'S', 'Demegillo', 'BSCS', '4', 'A', 'Male', 'johnlyric.demegillo@csav.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `student_final`
--

CREATE TABLE `student_final` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `pt1` float NOT NULL,
  `pt2` float NOT NULL,
  `pt3` float NOT NULL,
  `pt4` float NOT NULL,
  `pt5` float NOT NULL,
  `quiz1` float NOT NULL,
  `quiz2` float NOT NULL,
  `quiz3` float NOT NULL,
  `quiz4` float NOT NULL,
  `quiz5` float NOT NULL,
  `exam1` float NOT NULL,
  `average` float NOT NULL,
  `sy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_final`
--

INSERT INTO `student_final` (`id`, `studid`, `subid`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `exam1`, `average`, `sy`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `student_midterm`
--

CREATE TABLE `student_midterm` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `pt1` float NOT NULL,
  `pt2` float NOT NULL,
  `pt3` float NOT NULL,
  `pt4` float NOT NULL,
  `pt5` float NOT NULL,
  `quiz1` float NOT NULL,
  `quiz2` float NOT NULL,
  `quiz3` float NOT NULL,
  `quiz4` float NOT NULL,
  `quiz5` float NOT NULL,
  `exam1` float NOT NULL,
  `average` float NOT NULL,
  `sy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_midterm`
--

INSERT INTO `student_midterm` (`id`, `studid`, `subid`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `exam1`, `average`, `sy`) VALUES
(1, 1, 1, 10, 20, 30, 0, 0, 50, 0, 0, 0, 0, 0, 84, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `student_prefinal`
--

CREATE TABLE `student_prefinal` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `pt1` float NOT NULL,
  `pt2` float NOT NULL,
  `pt3` float NOT NULL,
  `pt4` float NOT NULL,
  `pt5` float NOT NULL,
  `quiz1` float NOT NULL,
  `quiz2` float NOT NULL,
  `quiz3` float NOT NULL,
  `quiz4` float NOT NULL,
  `quiz5` float NOT NULL,
  `exam1` float NOT NULL,
  `average` float NOT NULL,
  `sy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_prefinal`
--

INSERT INTO `student_prefinal` (`id`, `studid`, `subid`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `exam1`, `average`, `sy`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `student_prelim`
--

CREATE TABLE `student_prelim` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `pt1` float NOT NULL,
  `pt2` float NOT NULL,
  `pt3` float NOT NULL,
  `pt4` float NOT NULL,
  `pt5` float NOT NULL,
  `quiz1` float NOT NULL,
  `quiz2` float NOT NULL,
  `quiz3` float NOT NULL,
  `quiz4` float NOT NULL,
  `quiz5` float NOT NULL,
  `exam1` float NOT NULL,
  `average` float NOT NULL,
  `sy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_prelim`
--

INSERT INTO `student_prelim` (`id`, `studid`, `subid`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `exam1`, `average`, `sy`) VALUES
(1, 1, 1, 10, 15, 8, 7, 12, 10, 17, 12, 9, 8, 36, 76, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `student_record`
--

CREATE TABLE `student_record` (
  `id` int(11) NOT NULL,
  `stud_year` varchar(11) NOT NULL,
  `sem` varchar(20) NOT NULL,
  `sy` varchar(20) NOT NULL,
  `studid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_record`
--

INSERT INTO `student_record` (`id`, `stud_year`, `sem`, `sy`, `studid`, `status`) VALUES
(1, '4', '1st', '2021-2022', 1, 'unrelease');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `stud_recordid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `sem` varchar(11) NOT NULL,
  `sy` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`id`, `studid`, `stud_recordid`, `subid`, `sem`, `sy`) VALUES
(1, 1, 1, 1, '1st', '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subrecord_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year` varchar(11) NOT NULL,
  `sem` varchar(20) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `credit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subrecord_id`, `code`, `title`, `course`, `year`, `sem`, `unit`, `credit`) VALUES
(1, 1, 'CSTW422', 'Thesis Writing 2', 'BSCS', '4', '1st', '3', '3'),
(2, 1, 'CSHI411', 'Human Computer Interaction', 'BSCS', '4', '1st', '3', '5');

-- --------------------------------------------------------

--
-- Table structure for table `subject_record`
--

CREATE TABLE `subject_record` (
  `id` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_record`
--

INSERT INTO `subject_record` (`id`, `course`, `year`, `semester`) VALUES
(1, 'BSCS', '4', '1st');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `teachid` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(2) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `consultation_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `userid`, `teachid`, `fname`, `mname`, `lname`, `email`, `department`, `gender`, `status`, `consultation_time`) VALUES
(1, 3, '0923-1235-1', 'Donie', 'D', 'Delina', 'donie.delina@csav.edu.ph', 'Information Technology', 'Male', 'Coordinator', '(MTWTHF) 0:00-0:00 AM/PM');

-- --------------------------------------------------------

--
-- Table structure for table `teachertoggole`
--

CREATE TABLE `teachertoggole` (
  `id` int(11) NOT NULL,
  `teachid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `pt1` varchar(11) NOT NULL,
  `pt2` varchar(11) NOT NULL,
  `pt3` varchar(11) NOT NULL,
  `pt4` varchar(11) NOT NULL,
  `pt5` varchar(11) NOT NULL,
  `quiz1` varchar(11) NOT NULL,
  `quiz2` varchar(11) NOT NULL,
  `quiz3` varchar(11) NOT NULL,
  `quiz4` varchar(11) NOT NULL,
  `quiz5` varchar(11) NOT NULL,
  `term` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachertoggole`
--

INSERT INTO `teachertoggole` (`id`, `teachid`, `subid`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `term`) VALUES
(1, 1, 1, 'collapse1', 'collapse1', 'collapse1', 'collapse1', 'collapse1', 'collapse1', 'collapse1', 'collapse1', 'collapse1', 'collapse1', 'Prelim'),
(2, 1, 1, 'collapse1', 'collapse1', 'collapse1', 'collapse', 'collapse', 'collapse1', 'collapse', 'collapse', 'collapse', 'collapse', 'Midterm'),
(3, 1, 1, 'collapse1', 'collapse', 'collapse', 'collapse', 'collapse', 'collapse1', 'collapse', 'collapse', 'collapse', 'collapse', 'Prefinal'),
(4, 1, 1, 'collapse1', 'collapse', 'collapse', 'collapse', 'collapse', 'collapse1', 'collapse', 'collapse', 'collapse', 'collapse', 'Final');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_label`
--

CREATE TABLE `teacher_label` (
  `id` int(11) NOT NULL,
  `teachid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `pt1` int(11) NOT NULL,
  `pt2` int(11) NOT NULL,
  `pt3` int(11) NOT NULL,
  `pt4` int(11) NOT NULL,
  `pt5` int(11) NOT NULL,
  `quiz1` int(11) NOT NULL,
  `quiz2` int(11) NOT NULL,
  `quiz3` int(11) NOT NULL,
  `quiz4` int(11) NOT NULL,
  `quiz5` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `term` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_label`
--

INSERT INTO `teacher_label` (`id`, `teachid`, `subid`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `quiz1`, `quiz2`, `quiz3`, `quiz4`, `quiz5`, `exam`, `term`) VALUES
(1, 1, 1, 10, 15, 10, 10, 15, 10, 20, 15, 10, 10, 50, 'Prelim'),
(2, 1, 1, 10, 20, 30, 0, 0, 50, 0, 0, 0, 0, 0, 'Midterm'),
(3, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Prefinal'),
(4, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Final');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` text NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(2) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ava_location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `pass`, `fname`, `mname`, `lname`, `level`, `status`, `ava_location`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'A', 'Admin', 'admin', 'OIC', 'profileimages/admin.png'),
(2, 'scholarship', 'f03d4854848716a1087ee0bdbe549594', 'Scholarship', 's', 'Scholarship', 'scholarship', 'scholarship', 'profileimages/scholarship.png'),
(3, '0923-1235-1', '8036c55762b0a77554cb9fc625e262c4', 'Donie', 'D', 'Delina', 'faculty', 'Enabled', 'profileimages/default.png'),
(4, '18-0231-2', 'fec2907a990637e11b3bcf3f18d8894b', 'John Lyric', 'S', 'Demegillo', 'student', 'Enabled', 'profileimages/default.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subid`),
  ADD KEY `teacher` (`teachid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradesheets`
--
ALTER TABLE `gradesheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`);

--
-- Indexes for table `schname_studlist`
--
ALTER TABLE `schname_studlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`),
  ADD KEY `schname_id` (`schname_id`),
  ADD KEY `schprog_id` (`schprog_id`);

--
-- Indexes for table `sch_ancmt`
--
ALTER TABLE `sch_ancmt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sch_ancmtimg`
--
ALTER TABLE `sch_ancmtimg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ancmt_id` (`ancmt_id`);

--
-- Indexes for table `sch_applctionform`
--
ALTER TABLE `sch_applctionform`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sch_nameid` (`sch_nameid`),
  ADD KEY `studid` (`studid`);

--
-- Indexes for table `sch_files`
--
ALTER TABLE `sch_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`);

--
-- Indexes for table `sch_name`
--
ALTER TABLE `sch_name`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scholarprogram_id` (`scholarprogram_id`);

--
-- Indexes for table `sch_notif`
--
ALTER TABLE `sch_notif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`);

--
-- Indexes for table `sch_program`
--
ALTER TABLE `sch_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sch_selectstudents`
--
ALTER TABLE `sch_selectstudents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `student_final`
--
ALTER TABLE `student_final`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `student_midterm`
--
ALTER TABLE `student_midterm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `student_prefinal`
--
ALTER TABLE `student_prefinal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `student_prelim`
--
ALTER TABLE `student_prelim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `student_record`
--
ALTER TABLE `student_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`);

--
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studid` (`studid`),
  ADD KEY `stud_recordid` (`stud_recordid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subrecord_id` (`subrecord_id`);

--
-- Indexes for table `subject_record`
--
ALTER TABLE `subject_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department` (`department`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `teachertoggole`
--
ALTER TABLE `teachertoggole`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachid` (`teachid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `teacher_label`
--
ALTER TABLE `teacher_label`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachid` (`teachid`),
  ADD KEY `subid` (`subid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gradesheets`
--
ALTER TABLE `gradesheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schname_studlist`
--
ALTER TABLE `schname_studlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sch_ancmt`
--
ALTER TABLE `sch_ancmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sch_ancmtimg`
--
ALTER TABLE `sch_ancmtimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sch_applctionform`
--
ALTER TABLE `sch_applctionform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sch_files`
--
ALTER TABLE `sch_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sch_name`
--
ALTER TABLE `sch_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sch_notif`
--
ALTER TABLE `sch_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sch_program`
--
ALTER TABLE `sch_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sch_selectstudents`
--
ALTER TABLE `sch_selectstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_final`
--
ALTER TABLE `student_final`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_midterm`
--
ALTER TABLE `student_midterm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_prefinal`
--
ALTER TABLE `student_prefinal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_prelim`
--
ALTER TABLE `student_prelim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_record`
--
ALTER TABLE `student_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_subjects`
--
ALTER TABLE `student_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject_record`
--
ALTER TABLE `subject_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachertoggole`
--
ALTER TABLE `teachertoggole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_label`
--
ALTER TABLE `teacher_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
