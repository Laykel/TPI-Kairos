-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2017 at 08:12 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kairos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_content` varchar(200) NOT NULL,
  `comment_date` datetime NOT NULL,
  `task_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_content`, `comment_date`, `task_fk`) VALUES
(7, 'Ceci est un commentaire de test.', '2017-05-09 13:39:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_title` varchar(45) NOT NULL,
  `project_description` varchar(500) DEFAULT NULL,
  `project_dateCreation` datetime NOT NULL,
  `project_dateClosed` datetime DEFAULT NULL,
  `project_plannedBeginning` datetime DEFAULT NULL,
  `project_plannedEnd` datetime DEFAULT NULL,
  `project_isClosed` tinyint(1) NOT NULL DEFAULT '0',
  `user_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_title`, `project_description`, `project_dateCreation`, `project_dateClosed`, `project_plannedBeginning`, `project_plannedEnd`, `project_isClosed`, `user_fk`) VALUES
(1, 'Projet de test', 'Description incroyablement détaillé...', '2017-05-09 13:30:00', NULL, NULL, '2017-05-23 12:00:00', 0, 1),
(2, 'Projet 2', NULL, '2017-05-10 14:00:00', NULL, NULL, '2017-05-22 00:00:00', 0, 1),
(4, 'Projet fermé', 'Ce projet est une entrée de test, pour tester les projets fermés.', '2017-05-11 09:00:00', NULL, NULL, NULL, 1, 1),
(5, 'Liste de course', NULL, '2017-05-17 08:00:00', NULL, NULL, NULL, 0, 1),
(9, 'Kairos', NULL, '2017-05-19 10:07:36', NULL, NULL, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(45) NOT NULL,
  `task_description` varchar(500) DEFAULT NULL,
  `task_timePassed` time(1) DEFAULT NULL,
  `task_dateCreation` datetime NOT NULL,
  `task_dateClosed` datetime DEFAULT NULL,
  `task_plannedBeginning` datetime DEFAULT NULL,
  `task_plannedEnd` datetime DEFAULT NULL,
  `task_isClosed` tinyint(1) NOT NULL DEFAULT '0',
  `project_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_title`, `task_description`, `task_timePassed`, `task_dateCreation`, `task_dateClosed`, `task_plannedBeginning`, `task_plannedEnd`, `task_isClosed`, `project_fk`) VALUES
(1, 'Tâche de test', NULL, '00:00:00.0', '2017-05-09 13:35:00', NULL, NULL, NULL, 0, 1),
(2, 'Tâche 2', NULL, '00:00:00.0', '2017-05-10 14:03:00', NULL, NULL, NULL, 1, 1),
(6, 'Une tâche fermée', 'Une tâche terminée après beaucoup de travail.', '00:00:00.0', '2017-05-12 07:00:00', NULL, NULL, NULL, 1, 4),
(7, 'Fermer des tâches', NULL, '00:00:00.0', '2017-05-12 08:00:00', NULL, NULL, NULL, 0, 4),
(8, 'Lait', NULL, '00:00:00.0', '2017-05-17 08:00:00', NULL, NULL, NULL, 1, 5),
(9, 'Pain', NULL, '00:00:00.0', '2017-05-17 08:10:00', NULL, NULL, NULL, 1, 5),
(10, 'Pommes de terre', NULL, '00:00:00.0', '2017-05-17 08:06:00', NULL, NULL, NULL, 0, 5),
(11, 'Sucre', NULL, '00:00:00.0', '2017-05-17 08:14:00', NULL, NULL, NULL, 0, 5),
(12, 'Bananes', NULL, '00:00:00.0', '2017-05-17 08:13:00', NULL, NULL, NULL, 0, 5),
(13, 'Gobelets', NULL, '00:00:00.0', '2017-05-17 08:19:00', NULL, NULL, NULL, 0, 5),
(14, 'Exemple', NULL, '00:00:00.0', '2017-05-09 13:00:00', NULL, NULL, NULL, 0, 2),
(16, 'Tâche avec commentaires', NULL, '00:00:00.0', '2017-05-11 09:23:00', NULL, NULL, NULL, 0, 2),
(17, 'Plus de commentaires', NULL, '00:00:00.0', '2017-05-14 08:23:00', NULL, NULL, NULL, 0, 2),
(31, 'Recherches concernant AJAX', NULL, '00:00:00.0', '2017-05-19 10:07:52', NULL, NULL, NULL, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_pseudo` varchar(45) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mail` varchar(254) NOT NULL,
  `user_isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_pseudo`, `user_password`, `user_mail`, `user_isAdmin`) VALUES
(1, 'Luc', '$2y$10$6ACa.lcjLhP95VaOsJ23WurWcqEH0nzmh/2Y/OtW8VEgJLIjwqEXy', 'luc.wachter@cpnv.ch', 0),
(2, 'admin', '$2y$10$UKr8jeL4jGwDFy.yIoMt0eoKPclXD4TKeid2/srasMxK0uza3.ZUq', 'admin@exemple.ch', 1),
(4, '&lt;u&gt;Frank&lt;/u&gt;', '$2y$10$Ka2LQQ72KLSrip420vOVYOkt4ONqAlo6DuOGcHbCNl8JBPsPcipgW', 'frank@new.ch', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comment_task1_idx` (`task_fk`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `fk_project_user_idx` (`user_fk`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `fk_task_project1_idx` (`project_fk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_task1` FOREIGN KEY (`task_fk`) REFERENCES `task` (`task_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_user` FOREIGN KEY (`user_fk`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_project1` FOREIGN KEY (`project_fk`) REFERENCES `project` (`project_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
