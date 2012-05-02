-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.lcjazzkatz.com
-- Generation Time: Apr 28, 2012 at 02:47 PM
-- Server version: 5.1.39
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pagodanlt`
--

-- --------------------------------------------------------

--
-- Table structure for table `Announcement`
--

CREATE TABLE IF NOT EXISTS `Announcement` (
  `AnnouncementID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(140) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `AnnouncementTypeID` int(10) unsigned NOT NULL,
  `CourseID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`AnnouncementID`),
  KEY `fk_Announcement_AnnouncementType1` (`AnnouncementTypeID`),
  KEY `fk_Announcement_Course1` (`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `Announcement`
--

INSERT INTO `Announcement` (`AnnouncementID`, `title`, `text`, `date`, `AnnouncementTypeID`, `CourseID`) VALUES
(75, '3-14-12 (2) (Alex)', '<div style="font-family: arial; font-size: small; ">- Added more options to nicEdit including a Edit HTML field which lets the admin edit the HTML that the form will submit. This way, admin can embed things such as youtube videos. The best thing to do is to click the Edit HTML button then enter you code into that popup box.</div><div style="font-family: arial; font-size: small; "><br></div><div style="font-family: arial; font-size: small; ">- There was no way to add the buttons to nicEdit and apply it to all textforms so from now on if you want nicEdit to be on a form the id has to be "nicEdittextarea"</div><div style="font-family: arial; font-size: small; "><br></div><div style="font-family: arial; font-size: small; "><br></div>\r\n\r\n<iframe width="420" height="315" src="http://www.youtube.com/embed/QgkGogPLacA" frameborder="0" allowfullscreen=""></iframe>', '2012-03-14 21:37:54', 1, NULL),
(76, '3-14-12 (3) (Alex)', '<div>- Added Remove button to view_usersingle.php page. When viewing user profile there is now a Remove button that will delete the user.</div><div><br></div>', '2012-03-14 22:40:40', 1, NULL),
(77, '3-16-12 (Alex)', '<div>- Added Instructor CP</div><div>- Instructors can view their courses</div><div>- Admin can assign students to courses</div><div>- Students can view their courses</div><div>- Shows Instructor by fullname.</div><div><span class="Apple-tab-span" style="white-space:pre">			</span></div><div><br></div><div><img src="http://pbfcomics.com/archive_b/PBF098-Sgt._Grumbles.jpg" alt="" align="none"></div>', '2012-03-15 23:41:11', 1, NULL),
(88, 'This class sucks', 'Don''t take it.', '2012-03-17 03:39:44', 2, 3),
(89, 'Bring psychedelic music to class tomorrow', 'We will be licking all the&nbsp;frogs&nbsp;to find out which ones work.', '2012-03-17 03:40:51', 2, 4),
(90, '3-17-12 (Alex)', '<div><ul><li>Made all info required when signing up users since leaving info out&nbsp;will cause more problems down the line due to users being listed by&nbsp;name. It''s best just to get all the info in there at once.</li></ul><ul><li>added Class Size to instructor/view_courses.php and&nbsp;student/view_courses.php</li></ul></div><div><ul><li>removed extraneous code from admin/add/announcement</li></ul></div><div><ul><li>Instructor can add and view announcements to courses. Login with&nbsp;instructor, go to instructor/view/course/$num to see. Only shows top&nbsp;2 announcements right now. Will add link to show more later. Layout is&nbsp;a bit sloppy right now.</li></ul></div><div><ul><li>Instructors have remove button for each announcement</li></ul></div>', '2012-03-17 03:49:53', 1, NULL),
(94, 'Test coming up on Wed.', 'DON''T FAIL!', '2012-03-24 14:29:50', 2, 3),
(99, '3-29-12 (Alex)', '- added Edit button for headlines for admin<div><br></div><div><img src="http://img21.imageshack.us/img21/5318/15393989.jpg" width="500"></div>', '2012-03-28 22:17:52', 1, NULL),
(100, '4-13-12 (Alex)', '<div><font face="''times new roman''" style="background-color: rgb(255, 255, 255);"><b>4-11-12</b></font></div><div><ul><li><span style="font-family: ''times new roman''; ">- added underline to hyperlinks</span></li></ul></div><div><font face="''times new roman''"><br></font></div><div><font face="''times new roman''" style="background-color: rgb(255, 255, 255);"><b>4-12-12</b></font></div><div><ul><li><span style="font-family: ''times new roman''; ">- Added Assessments page for instructor.</span></li><li><span style="font-family: ''times new roman''; ">- Made many changes to DB to adjust for assessments</span></li><li><span style="font-family: ''times new roman''; ">- Removed name from Rubric table and moved to Assessment table</span></li><li><span style="font-family: ''times new roman''; ">- Removed constraint from Assessment to Rubric. User may not want to&nbsp;</span><span style="font-family: ''times new roman''; ">add rubric when they first create an assessment</span></li><li><span style="font-family: ''times new roman''; ">- Instructor can create an assessment and view their assessments.&nbsp;</span><span style="font-family: ''times new roman''; ">Right now the create assessment only assigns the assessment a name</span></li></ul></div><div><font face="''times new roman''"><br></font></div><div><ul><li><span style="font-family: ''times new roman''; ">- all DB changes have been reflected in the MySQL workbench file</span></li></ul><div><img src="http://i.imgur.com/z3hDf.jpg" alt="" align="none"></div></div>', '2012-04-12 23:55:41', 1, NULL),
(101, 'Almost there...', 'If things go according to plan it should be done by this weekend. :)<br>', '2012-04-14 23:50:25', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `AnnouncementType`
--

CREATE TABLE IF NOT EXISTS `AnnouncementType` (
  `AnnouncementTypeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`AnnouncementTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `AnnouncementType`
--

INSERT INTO `AnnouncementType` (`AnnouncementTypeID`, `type`) VALUES
(1, 'Headline'),
(2, 'InstructorAnnouncement');

-- --------------------------------------------------------

--
-- Table structure for table `Assessment`
--

CREATE TABLE IF NOT EXISTS `Assessment` (
  `AssessmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `InstructorID` int(10) unsigned NOT NULL,
  `RubricID` int(10) unsigned DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`AssessmentID`),
  KEY `fk_Assessment_User1` (`InstructorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- Dumping data for table `Assessment`
--


-- --------------------------------------------------------

--
-- Table structure for table `Assessment_has_Standard`
--

CREATE TABLE IF NOT EXISTS `Assessment_has_Standard` (
  `AssessmentID` int(10) unsigned NOT NULL,
  `StandardID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`AssessmentID`,`StandardID`),
  KEY `fk_Assessment_has_Standard_Standard1` (`StandardID`),
  KEY `fk_Assessment_has_Standard_Assessment1` (`AssessmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Assessment_has_Standard`
--


-- --------------------------------------------------------

--
-- Table structure for table `Assignment`
--

CREATE TABLE IF NOT EXISTS `Assignment` (
  `AssignmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CourseID` int(10) unsigned NOT NULL,
  `title` varchar(65) NOT NULL,
  `description` text,
  `dueDate` datetime NOT NULL,
  `AssessmentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`AssignmentID`),
  KEY `fk_Assignment_Course1` (`CourseID`),
  KEY `fk_Assignment_Assessment1` (`AssessmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Assignment`
--

INSERT INTO `Assignment` (`AssignmentID`, `CourseID`, `title`, `description`, `dueDate`, `AssessmentID`) VALUES
(1, 3, 'oh hai there', 'i am the description', '2012-04-20 21:33:09', 60);

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE IF NOT EXISTS `Course` (
  `CourseID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CRN` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `section` varchar(2) NOT NULL,
  `number` mediumint(8) unsigned NOT NULL,
  `InstructorID` int(10) unsigned NOT NULL,
  `DepartmentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CourseID`),
  UNIQUE KEY `CRN_UNIQUE` (`CRN`),
  KEY `fk_Course_Users1` (`InstructorID`),
  KEY `fk_Course_Department1` (`DepartmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`CourseID`, `CRN`, `name`, `section`, `number`, `InstructorID`, `DepartmentID`) VALUES
(3, 11112, 'Biology', 'A', 101, 3, 1),
(4, 11113, 'Biology', 'B', 101, 3, 1),
(5, 223345, 'Computer Fun', 'A', 202, 13, 5),
(6, 22345, 'Networking', 'A', 101, 13, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Course_has_Students`
--

CREATE TABLE IF NOT EXISTS `Course_has_Students` (
  `CourseID` int(10) unsigned NOT NULL,
  `StudentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CourseID`,`StudentID`),
  KEY `fk_Course_has_Users_Users1` (`StudentID`),
  KEY `fk_Course_has_Users_Course1` (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Course_has_Students`
--

INSERT INTO `Course_has_Students` (`CourseID`, `StudentID`) VALUES
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(3, 21),
(4, 21),
(5, 21),
(6, 21),
(3, 22),
(4, 22),
(5, 22),
(6, 22);

-- --------------------------------------------------------

--
-- Table structure for table `Criteria`
--

CREATE TABLE IF NOT EXISTS `Criteria` (
  `CriteriaID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `RubricID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CriteriaID`),
  KEY `fk_Criteria_Rubric1` (`RubricID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `Criteria`
--


-- --------------------------------------------------------

--
-- Table structure for table `Criteria_Description`
--

CREATE TABLE IF NOT EXISTS `Criteria_Description` (
  `CriteriaDescriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `CriteriaID` int(10) unsigned NOT NULL,
  `ScoreID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CriteriaDescriptionID`),
  KEY `fk_Criteria_Description_Criteria1` (`CriteriaID`),
  KEY `fk_Criteria_Description_Score1` (`ScoreID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=281 ;

--
-- Dumping data for table `Criteria_Description`
--


-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE IF NOT EXISTS `Department` (
  `DepartmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `abbreviation` varchar(4) NOT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`DepartmentID`, `name`, `abbreviation`) VALUES
(1, 'Biology', 'BIOL'),
(5, 'Computer Science', 'CSCI');

-- --------------------------------------------------------

--
-- Table structure for table `Document`
--

CREATE TABLE IF NOT EXISTS `Document` (
  `DocumentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `URL` varchar(45) DEFAULT NULL,
  `dateSubmitted` datetime NOT NULL,
  `data` text,
  `AssignmentID` int(10) unsigned NOT NULL,
  `StudentID` int(10) unsigned NOT NULL,
  `grade` int(11) DEFAULT NULL,
  PRIMARY KEY (`DocumentID`),
  KEY `fk_Document_Assignment1` (`AssignmentID`),
  KEY `fk_Document_User1` (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Document`
--


-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `MessageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `time` datetime NOT NULL,
  `ToWho` int(10) unsigned NOT NULL,
  `FromWho` int(10) unsigned NOT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `fk_Message_Users1` (`ToWho`),
  KEY `fk_Message_Users2` (`FromWho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Message`
--


-- --------------------------------------------------------

--
-- Table structure for table `Preferences`
--

CREATE TABLE IF NOT EXISTS `Preferences` (
  `idPreferences` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idPreferences`),
  KEY `fk_Preferences_Users1` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Preferences`
--


-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE IF NOT EXISTS `Profile` (
  `ProfileID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `emailAddress` varchar(60) NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `bannerID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ProfileID`),
  KEY `fk_Profile_User1` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `Profile`
--

INSERT INTO `Profile` (`ProfileID`, `firstName`, `lastName`, `emailAddress`, `UserID`, `bannerID`) VALUES
(1, 'Student ', 'Macho', 'mcneese@lakecharles.com', 2, NULL),
(2, 'Dr William', 'Albrecht', 'William', 3, NULL),
(3, 'Thor', 'God', 'clouds@thehammer.com', 4, NULL),
(4, 'AAAAAAAAA', 'AAAAAAAAA', 'yeah@right.com', 1, NULL),
(13, 'Instructor ', 'Cat', '', 13, NULL),
(19, 'Instructor ', 'man', '', 19, NULL),
(20, 'Instructor ', 'Lady', '', 20, NULL),
(21, 'John', 'Carter', '', 21, NULL),
(22, 'James Earl', 'Jones', '', 22, NULL),
(23, 'Alex', 'Oulapour', '>=).com', 24, 454545),
(24, 'Tom', 'Dvorske', 'gmail.com', 25, 1),
(25, 'Tom', 'Dvorske', 'tdvorske@mcneese.edu', 26, 1),
(26, 'Tom', 'Dvorske', 'tdvorske@mcneese.edu', 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE IF NOT EXISTS `Roles` (
  `RolesID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`RolesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`RolesID`, `role`) VALUES
(1, 'Administrator'),
(2, 'Student'),
(3, 'Instructor'),
(4, 'Accreditor');

-- --------------------------------------------------------

--
-- Table structure for table `Rubric`
--

CREATE TABLE IF NOT EXISTS `Rubric` (
  `RubricID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `rowSize` int(4) NOT NULL,
  `columnSize` int(4) NOT NULL,
  PRIMARY KEY (`RubricID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `Rubric`
--


-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

CREATE TABLE IF NOT EXISTS `Score` (
  `ScoreID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `score` int(11) NOT NULL,
  `RubricID` int(10) unsigned NOT NULL,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`ScoreID`),
  KEY `fk_Score_Rubric1` (`RubricID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `Score`
--


-- --------------------------------------------------------

--
-- Table structure for table `Standard`
--

CREATE TABLE IF NOT EXISTS `Standard` (
  `StandardID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`StandardID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Standard`
--


-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `username`, `password`) VALUES
(1, 'admin', 'test'),
(2, 'student', 'test'),
(3, 'instructor', 'test'),
(4, 'accreditor', 'test'),
(13, 'instructor1', 'test'),
(19, 'instructor2', 'test'),
(20, 'instructor3', 'test'),
(21, 'student2', 'test'),
(22, 'student3', 'test'),
(24, 'alexO', 'test'),
(25, 'tdvorske', 'test'),
(26, 'tdadmin', 'pagoda'),
(27, 'tdstudent', 'pagoda');

-- --------------------------------------------------------

--
-- Table structure for table `User_has_Announcement`
--

CREATE TABLE IF NOT EXISTS `User_has_Announcement` (
  `UserID` int(10) unsigned NOT NULL,
  `AnnouncementID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UserID`,`AnnouncementID`),
  KEY `fk_User_has_Announcement_Announcement1` (`AnnouncementID`),
  KEY `fk_User_has_Announcement_User1` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_has_Announcement`
--

INSERT INTO `User_has_Announcement` (`UserID`, `AnnouncementID`) VALUES
(1, 75),
(1, 76),
(1, 77),
(3, 88),
(3, 89),
(1, 90),
(3, 94),
(1, 99),
(1, 100),
(1, 101);

-- --------------------------------------------------------

--
-- Table structure for table `User_has_Roles`
--

CREATE TABLE IF NOT EXISTS `User_has_Roles` (
  `UserID` int(10) unsigned NOT NULL,
  `RolesID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`RolesID`,`UserID`),
  KEY `fk_Users_has_Roles_Roles1` (`RolesID`),
  KEY `fk_Users_has_Roles_Users` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_has_Roles`
--

INSERT INTO `User_has_Roles` (`UserID`, `RolesID`) VALUES
(1, 1),
(26, 1),
(2, 2),
(21, 2),
(22, 2),
(24, 2),
(27, 2),
(3, 3),
(13, 3),
(19, 3),
(20, 3),
(25, 3),
(4, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Announcement`
--
ALTER TABLE `Announcement`
  ADD CONSTRAINT `fk_Announcement_AnnouncementType1` FOREIGN KEY (`AnnouncementTypeID`) REFERENCES `AnnouncementType` (`AnnouncementTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Announcement_Course1` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Assessment`
--
ALTER TABLE `Assessment`
  ADD CONSTRAINT `fk_Assessment_User1` FOREIGN KEY (`InstructorID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Assessment_has_Standard`
--
ALTER TABLE `Assessment_has_Standard`
  ADD CONSTRAINT `fk_Assessment_has_Standard_Assessment1` FOREIGN KEY (`AssessmentID`) REFERENCES `Assessment` (`AssessmentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Assessment_has_Standard_Standard1` FOREIGN KEY (`StandardID`) REFERENCES `Standard` (`StandardID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Assignment`
--
ALTER TABLE `Assignment`
  ADD CONSTRAINT `fk_Assignment_Course1` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Assignment_Assessment1` FOREIGN KEY (`AssessmentID`) REFERENCES `Assessment` (`AssessmentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `fk_Course_Users1` FOREIGN KEY (`InstructorID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Course_Department1` FOREIGN KEY (`DepartmentID`) REFERENCES `Department` (`DepartmentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Course_has_Students`
--
ALTER TABLE `Course_has_Students`
  ADD CONSTRAINT `fk_Course_has_Users_Course1` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Course_has_Users_Users1` FOREIGN KEY (`StudentID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Criteria`
--
ALTER TABLE `Criteria`
  ADD CONSTRAINT `fk_Criteria_Rubric1` FOREIGN KEY (`RubricID`) REFERENCES `Rubric` (`RubricID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Criteria_Description`
--
ALTER TABLE `Criteria_Description`
  ADD CONSTRAINT `Criteria_Description_ibfk_4` FOREIGN KEY (`ScoreID`) REFERENCES `Score` (`ScoreID`),
  ADD CONSTRAINT `Criteria_Description_ibfk_3` FOREIGN KEY (`CriteriaID`) REFERENCES `Criteria` (`CriteriaID`);

--
-- Constraints for table `Document`
--
ALTER TABLE `Document`
  ADD CONSTRAINT `fk_Document_Assignment1` FOREIGN KEY (`AssignmentID`) REFERENCES `Assignment` (`AssignmentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Document_User1` FOREIGN KEY (`StudentID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `fk_Message_Users1` FOREIGN KEY (`ToWho`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Message_Users2` FOREIGN KEY (`FromWho`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Preferences`
--
ALTER TABLE `Preferences`
  ADD CONSTRAINT `fk_Preferences_Users1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Profile`
--
ALTER TABLE `Profile`
  ADD CONSTRAINT `fk_Profile_User1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Score`
--
ALTER TABLE `Score`
  ADD CONSTRAINT `Score_ibfk_1` FOREIGN KEY (`RubricID`) REFERENCES `Rubric` (`RubricID`);

--
-- Constraints for table `User_has_Announcement`
--
ALTER TABLE `User_has_Announcement`
  ADD CONSTRAINT `fk_User_has_Announcement_User1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Announcement_Announcement1` FOREIGN KEY (`AnnouncementID`) REFERENCES `Announcement` (`AnnouncementID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `User_has_Roles`
--
ALTER TABLE `User_has_Roles`
  ADD CONSTRAINT `fk_Users_has_Roles_Users` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_has_Roles_Roles1` FOREIGN KEY (`RolesID`) REFERENCES `Roles` (`RolesID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
