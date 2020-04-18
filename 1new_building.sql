-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 02:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_building`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `id` int(5) UNSIGNED NOT NULL,
  `floor` int(5) UNSIGNED NOT NULL,
  `rooms` int(5) UNSIGNED NOT NULL,
  `square` int(6) UNSIGNED NOT NULL,
  `price` bigint(10) UNSIGNED NOT NULL,
  `id_status` int(5) UNSIGNED NOT NULL DEFAULT 1,
  `type` int(5) UNSIGNED NOT NULL,
  `give_type` int(5) UNSIGNED NOT NULL,
  `rent_type` int(5) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `id_user` int(4) NOT NULL,
  `street` varchar(191) NOT NULL,
  `house` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `floor`, `rooms`, `square`, `price`, `id_status`, `type`, `give_type`, `rent_type`, `description`, `id_user`, `street`, `house`) VALUES
(2, 0, 0, 0, 0, 2, 1, 1, 0, 'Удалено!', 2, '', ''),
(24, 15, 6, 100, 15000000, 2, 1, 1, 0, ' БОЛЬШООООООООЙ ДОМ', 34, 'Советская', '56'),
(27, 2, 5, 220, 22000, 4, 2, 2, 2, ' Просторный дом в Старом Альметьевске', 34, 'Советская', '130'),
(28, 6, 4, 60, 4000000, 4, 2, 1, 0, ' Вершина мира на шестом этаже', 34, 'Тельмана', '60'),
(29, 2, 1, 45, 2000, 4, 2, 2, 1, 'Однокомнатная квартира на главной улице города ', 34, 'Ленина', '51'),
(30, 3, 2, 45, 1000, 4, 2, 2, 1, ' Уютная квартира на ночь', 34, '8 марта', '15'),
(31, 1, 4, 100, 3000, 4, 1, 2, 1, ' Хороший одноэтажный дом, со всеми удобствами и даже больше', 37, 'Чернышевского', '5'),
(32, 2, 5, 200, 4000000, 4, 1, 1, 0, 'Хороший дом ', 38, 'Советская', '131');

-- --------------------------------------------------------

--
-- Table structure for table `apt_img`
--

CREATE TABLE `apt_img` (
  `id` int(11) NOT NULL,
  `id_apt` int(11) NOT NULL,
  `file` varchar(150) NOT NULL,
  `extension` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apt_img`
--

INSERT INTO `apt_img` (`id`, `id_apt`, `file`, `extension`) VALUES
(39, 18, 'white-apar', 'jpg'),
(40, 19, '29268638.j', 'jpg'),
(41, 19, 'white-apar', 'jpg'),
(42, 19, 'modern-liv', 'jpg'),
(43, 24, 'depositpho', 'jpg'),
(44, 24, 'pexels-pho', 'jpeg'),
(45, 24, 'rem_projec', 'jpg'),
(46, 24, 'новый', 'jpg'),
(48, 27, '62530944-s', 'jpg'),
(49, 27, '64205740-a', 'jpg'),
(50, 27, 'fine_home_', 'jpg'),
(51, 27, 'gettyimage', 'jpg'),
(52, 27, 'home-inter', 'jpg'),
(53, 27, 'Без н?', 'jpg'),
(54, 28, '1111-n-dea', 'jpg'),
(55, 28, 'e03ec5c975', 'jpg'),
(56, 28, 'images.jpg', 'jpg'),
(57, 28, 'small-open', 'jpg'),
(58, 29, 'unnamed.jp', 'jpg'),
(59, 29, 'e03ec5c975', 'jpg'),
(60, 30, '2307861_or', 'jpg'),
(61, 30, 'depositpho', 'jpg'),
(64, 30, 'ффффф', 'jpg'),
(65, 30, 'original.p', 'png'),
(66, 31, '3.jpg', 'jpg'),
(67, 31, '3160049cf9', 'jpg'),
(68, 31, 'dizain-kot', 'jpg'),
(69, 31, 'maxresdefa', 'jpg'),
(76, 32, 'Без н?', 'jpg'),
(77, 32, 'depositpho', 'jpg'),
(78, 32, 'новый', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `apt_type`
--

CREATE TABLE `apt_type` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apt_type`
--

INSERT INTO `apt_type` (`id`, `name`) VALUES
(1, 'дом'),
(2, 'квартира');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_user` int(5) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `text`, `date`) VALUES
(1, 37, 'прикольно', '2020-04-08 02:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `id` int(5) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `user` int(5) UNSIGNED NOT NULL,
  `summary` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `start`, `end`, `user`, `summary`) VALUES
(8, '2020-04-07', '2020-04-11', 20, 0),
(9, '2020-04-07', '2020-04-11', 20, 4),
(10, '2020-04-07', '2020-04-11', 20, 4),
(11, '2020-04-07', '2020-04-11', 20, 4),
(12, '2020-04-07', '2020-04-11', 20, 4),
(13, '2020-04-07', '2020-04-10', 20, 3),
(14, '2020-04-07', '2020-04-18', 20, 11),
(15, '2020-04-07', '2020-04-18', 20, 11),
(16, '2020-04-07', '2020-04-18', 20, 11),
(17, '2020-04-07', '2020-04-18', 20, 11),
(18, '2020-04-07', '2020-04-18', 20, 11),
(19, '2020-04-07', '2020-04-11', 20, 4),
(20, '2020-04-07', '2020-04-11', 20, 4),
(21, '2020-04-07', '2020-04-11', 20, 4),
(22, '2020-04-07', '2020-04-17', 20, 10),
(23, '2020-04-07', '2020-04-17', 20, 10),
(24, '2020-04-08', '2020-04-21', 20, 13),
(25, '2020-04-08', '2020-04-21', 20, 13),
(26, '2020-04-08', '2020-04-21', 20, 13),
(27, '2020-04-08', '2020-04-11', 20, 3),
(28, '2020-04-08', '2020-04-11', 20, 3),
(29, '2020-04-08', '2020-04-11', 20, 3),
(30, '2020-04-08', '2020-04-11', 20, 3),
(31, '2020-04-08', '2020-04-11', 20, 3),
(32, '2020-04-08', '2020-04-18', 34, 10),
(33, '2020-04-09', '2020-04-24', 0, 15),
(34, '2020-04-08', '2020-04-26', 20, 18),
(35, '2020-04-16', '2020-04-24', 0, 8),
(36, '2020-04-08', '2020-04-17', 20, 9),
(37, '2020-04-10', '2020-04-20', 38, 10),
(38, '2020-04-10', '2020-04-20', 38, 10),
(39, '2020-04-10', '2020-04-20', 38, 10),
(40, '2020-04-08', '2020-04-15', 38, 7),
(41, '2020-04-08', '2020-04-19', 34, 11),
(42, '2020-05-20', '2020-05-22', 34, 2),
(43, '2020-05-18', '2020-05-22', 34, 4),
(44, '2020-04-09', '2021-04-09', 37, 365),
(45, '2020-04-09', '2020-04-13', 37, 1),
(46, '2020-04-09', '2020-04-18', 37, 1),
(47, '2020-04-09', '2020-04-18', 37, 1),
(48, '2020-04-09', '2020-04-17', 37, 1),
(49, '2020-04-09', '2020-04-17', 37, 1),
(50, '2020-04-09', '2020-05-13', 37, 2),
(51, '2020-04-10', '2020-04-15', 37, 5);

-- --------------------------------------------------------

--
-- Table structure for table `giver`
--

CREATE TABLE `giver` (
  `id` int(5) NOT NULL,
  `phone` text NOT NULL,
  `id_role` int(5) NOT NULL,
  `family` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `father` varchar(191) NOT NULL,
  `id_user` int(5) NOT NULL,
  `mail` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `giver`
--

INSERT INTO `giver` (`id`, `phone`, `id_role`, `family`, `name`, `father`, `id_user`, `mail`) VALUES
(1, '89963361957', 2, 'Зарипов', 'Данияр', 'Наилевич', 20, 'ma@ma.com'),
(2, '89966661957', 4, 'Зарипов', 'Данияр', 'Владимирович', 33, 'ukdddds@gail.com'),
(3, '77763361957', 4, 'Зарипов', 'Данияр', 'Наилевич', 34, 'aaa@gmail.com'),
(35, '89172992229', 0, 'Берия', 'Лаврентий', 'Павлович', 37, 'go@yandex.ru');

-- --------------------------------------------------------

--
-- Table structure for table `give_type`
--

CREATE TABLE `give_type` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `give_type`
--

INSERT INTO `give_type` (`id`, `name`) VALUES
(1, 'Продается'),
(2, 'Сдается в аренду');

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `ID` int(5) UNSIGNED NOT NULL,
  `user` int(5) UNSIGNED NOT NULL,
  `id_apartment` int(5) UNSIGNED NOT NULL,
  `summary` bigint(15) UNSIGNED NOT NULL,
  `id_status` int(5) UNSIGNED NOT NULL DEFAULT 1,
  `date_deal` date NOT NULL,
  `date_end` date NOT NULL,
  `buyer` int(5) UNSIGNED NOT NULL,
  `realtor` int(5) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`ID`, `user`, `id_apartment`, `summary`, `id_status`, `date_deal`, `date_end`, `buyer`, `realtor`) VALUES
(1, 20, 2, 555555, 6, '2020-04-08', '0000-00-00', 35, 0),
(7, 34, 27, 0, 4, '0000-00-00', '2020-04-07', 0, 0),
(8, 34, 29, 0, 4, '0000-00-00', '2020-04-07', 0, 0),
(9, 34, 30, 0, 4, '0000-00-00', '2020-04-07', 0, 0),
(11, 34, 24, 0, 2, '2020-04-07', '0000-00-00', 34, 36),
(12, 34, 24, 17000000, 6, '2020-04-07', '2020-04-08', 35, 36),
(13, 34, 24, 0, 10, '2020-04-07', '2020-04-08', 34, 0),
(14, 34, 24, 0, 10, '2020-04-08', '2020-04-09', 36, 1),
(15, 37, 31, 0, 7, '0000-00-00', '2020-04-08', 0, 1),
(16, 37, 31, 35000, 6, '2020-04-08', '2020-04-08', 38, 36),
(17, 37, 31, 0, 10, '2020-04-08', '2020-04-08', 38, 1),
(18, 34, 24, 0, 10, '2020-04-09', '2020-04-09', 37, 1),
(20, 34, 24, 17000000, 6, '2020-04-09', '2020-04-09', 37, 36),
(21, 34, 29, 0, 1, '2020-04-09', '0000-00-00', 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile_img`
--

CREATE TABLE `profile_img` (
  `id` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `id_status` int(5) NOT NULL DEFAULT 7,
  `extension` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_img`
--

INSERT INTO `profile_img` (`id`, `id_user`, `id_status`, `extension`) VALUES
(1, 20, 8, 'jpg'),
(6, 33, 8, 'jpg'),
(7, 34, 8, 'jpg'),
(8, 35, 8, 'jpg'),
(9, 36, 8, 'jpg'),
(10, 37, 8, 'jpg'),
(11, 38, 8, 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rent_type`
--

CREATE TABLE `rent_type` (
  `id` int(5) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent_type`
--

INSERT INTO `rent_type` (`id`, `name`) VALUES
(1, 'На сутки'),
(2, 'На длительный срок');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(5) UNSIGNED NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `name`) VALUES
(2, 'Администратор'),
(3, 'Риэлтор'),
(4, 'Пользователь');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID` int(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID`, `name`) VALUES
(1, 'Рассматривается'),
(2, 'Продано'),
(3, 'В аренде'),
(4, 'Свободно'),
(5, 'Активно'),
(6, 'Закрыто'),
(7, 'Без фото'),
(8, 'С фото'),
(9, 'Удалено'),
(10, 'Отказано');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) UNSIGNED NOT NULL,
  `phone` text NOT NULL,
  `id_role` int(5) UNSIGNED NOT NULL DEFAULT 4,
  `family` varchar(191) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `father` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `mail` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `phone`, `id_role`, `family`, `name`, `father`, `password`, `mail`) VALUES
(1, '0000', 3, 'Не', 'назначен', '000', NULL, '000'),
(2, 'удален', 4, 'Пользователь', 'удален', 'удален', NULL, 'удален'),
(20, '89963361957', 2, 'Зарипов', 'Данияр', 'Наилевич', '0192023a7bbd73250516f069df18b500', 'ma@ma.com'),
(33, '89966661957', 4, 'Зарипов', 'Данияр', 'Владимирович', 'fcea920f7412b5da7be0cf42b8c93759', 'ukdddds@gail.com'),
(34, '77763361957', 4, 'Зарипов', 'Данияр', 'Наилевич', 'fcea920f7412b5da7be0cf42b8c93759', 'aaa@gmail.com'),
(35, '85542366487', 4, 'Котов', 'Андрей', 'Тимурович', 'fcea920f7412b5da7be0cf42b8c93759', 'oppa@gil.com'),
(36, '81163361957', 3, 'Zaripov', 'Daniyar', 'Nailevich', 'fcea920f7412b5da7be0cf42b8c93759', 'ma3aukos@mail.ru'),
(37, '89172992229', 4, 'Берия', 'Лаврентий', 'Павлович', 'fcea920f7412b5da7be0cf42b8c93759', 'go@yandex.ru'),
(38, '89172992222', 4, 'Троцкий', 'Лев', 'Давидович', 'fcea920f7412b5da7be0cf42b8c93759', 'gon@yandex.ru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `type` (`type`),
  ADD KEY `give_type` (`give_type`);

--
-- Indexes for table `apt_img`
--
ALTER TABLE `apt_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apt_type`
--
ALTER TABLE `apt_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giver`
--
ALTER TABLE `giver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `give_type`
--
ALTER TABLE `give_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_user` (`user`,`id_apartment`,`id_status`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_appartment` (`id_apartment`),
  ADD KEY `realtor` (`realtor`);

--
-- Indexes for table `profile_img`
--
ALTER TABLE `profile_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `rent_type`
--
ALTER TABLE `rent_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `apt_img`
--
ALTER TABLE `apt_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `apt_type`
--
ALTER TABLE `apt_type`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `giver`
--
ALTER TABLE `giver`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `give_type`
--
ALTER TABLE `give_type`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `profile_img`
--
ALTER TABLE `profile_img`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rent_type`
--
ALTER TABLE `rent_type`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`ID`),
  ADD CONSTRAINT `apartments_ibfk_2` FOREIGN KEY (`type`) REFERENCES `apt_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apartments_ibfk_3` FOREIGN KEY (`give_type`) REFERENCES `give_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`ID`),
  ADD CONSTRAINT `operations_ibfk_3` FOREIGN KEY (`id_apartment`) REFERENCES `apartments` (`id`),
  ADD CONSTRAINT `operations_ibfk_5` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
