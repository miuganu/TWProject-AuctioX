-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 Iun 2018 la 11:24
-- Versiune server: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_bet`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `bid`
--

CREATE TABLE `bid` (
  `bid_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_bet` date DEFAULT NULL,
  `price_bet` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `bid`
--

INSERT INTO `bid` (`bid_id`, `user_id`, `product_id`, `date_bet`, `price_bet`) VALUES
(1, 6, 1, NULL, '1000.00'),
(2, 6, 2, NULL, '1500.00'),
(3, 7, 1, NULL, '1100.00'),
(4, 7, 6, NULL, '15.00'),
(5, 7, 1, NULL, '0.00'),
(6, 7, 1, NULL, '1100.00');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `categoris`
--

CREATE TABLE `categoris` (
  `Id_Categori` int(1) NOT NULL,
  `Type_Categori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `categoris`
--

INSERT INTO `categoris` (`Id_Categori`, `Type_Categori`) VALUES
(0, 'Laptop,Tablete & Telefoane'),
(1, 'PC & Software'),
(2, 'TV, audio-video & foto'),
(3, 'Electrocasnice'),
(4, 'Gaming'),
(5, 'Fashion'),
(6, 'Ingrijire personala & Cosmetice'),
(7, 'Carti'),
(8, 'Echipamente sportive'),
(9, 'Auto-moto'),
(10, 'Jucarii copii');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `generate`
--

CREATE TABLE `generate` (
  `username` varchar(35) DEFAULT NULL,
  `Type_Categori` varchar(100) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `current_price` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `generate`
--

INSERT INTO `generate` (`username`, `Type_Categori`, `product_name`, `current_price`) VALUES
('Ioana', 'Laptop,Tablete & Telefoane', 'Iphone 6S', '1100.00'),
('Ioana', 'Laptop,Tablete & Telefoane', 'Laptot ASUS', '1500.00'),
('thistest', 'Laptop,Tablete & Telefoane', 'Crapat', '0.00'),
('thistest', 'Laptop,Tablete & Telefoane', 'wow', '100.00'),
('thistest', 'PC & Software', 'Mouse', '15.00'),
('thistest', 'Fashion', 'Pantofi Stileto', '200.00'),
('thistest', 'Ingrijire personala & Cosmetice', 'Fond de Ten', '20.00'),
('thistest', 'Echipamente sportive', 'Minge', '10.00'),
('thistest', 'Echipamente sportive', 'Chitara', '600.00'),
('thistest', 'Jucarii copii', 'Cevafrumos', '100.00');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `products`
--

CREATE TABLE `products` (
  `product_id` int(35) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `current_price` decimal(20,2) NOT NULL,
  `id_categori` int(1) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expirate_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `image`, `description`, `price`, `current_price`, `id_categori`, `insert_date`, `expirate_date`, `user_id`) VALUES
(1, 'Iphone 6S', 'iphone-6s-250x250.jpg', 'Descrierea la iphone', '800.00', '1100.00', 0, '2018-06-11 22:31:44', '2018-06-11 22:31:44', 6),
(2, 'Laptot ASUS', 'P_setting_F5F5F5_1_90_end_765.png', 'Laptop de cea mai buna calitate!\r\n', '1200.00', '1500.00', 0, '2018-06-11 23:16:01', '2018-06-11 23:16:01', 6),
(3, 'Fond de Ten', '83b7e175cfc4835cf01e4f36fa07ed80.jpg', 'Ceva', '20.00', '20.00', 6, '2018-06-12 01:47:53', '2018-06-12 01:47:53', 7),
(4, 'Minge', '27153160_942656752549865_1793898795_n.jpg', 'Minge pentru football', '10.00', '10.00', 8, '2018-06-12 05:24:49', '2018-06-12 05:24:49', 7),
(5, 'Pantofi Stileto', '649fa9f4b84234e721ee63b48b921c55.jpg', 'Frumosi', '200.00', '200.00', 5, '2018-06-12 06:07:48', '2018-06-12 06:07:48', 7),
(6, 'Mouse', 'd8ff611ab2e933ade74d97e8e7769e9a.jpg', 'desc', '10.00', '15.00', 1, '2018-06-12 06:09:48', '2018-06-12 06:09:48', 7),
(7, 'Cevafrumos', '0dbcae8ec0b42b26a6013e61f2e222fd.jpg', 'ceva', '100.00', '100.00', 10, '2018-06-12 07:13:54', '2018-06-12 07:13:54', 7),
(8, 'Chitara', 'maxresdefault.jpg', 'Aceasta este o descriere', '600.00', '600.00', 8, '2018-06-15 14:35:23', '2018-06-15 14:35:23', 7),
(9, 'Crapat', '12e5ccf4827bbbe6f69dbde8888caa58.jpg', 'Oare voi crapa ?', '0.00', '0.00', 0, '2018-06-15 14:41:05', '2018-06-15 14:41:05', 7),
(10, 'wow', '5f95e8fe978957b61a47896d2fac7c83.jpg', 'fuikjhhjuj', '100.00', '100.00', 0, '2018-06-15 14:42:21', '2018-06-15 14:42:21', 7);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(1250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `active`, `type`) VALUES
(5, 'Madalina', '5f4dcc3b5aa765d61d8327deb882cf99', 'madalina.bo$$@compania.boss.com', 0, 0),
(6, 'Ioana', '05a671c66aefea124cc08b76ea6d30bb', 'ceva.ioana@gmail.com', 1, 1),
(7, 'thistest', 'cc03e747a6afbbcbf8be7668acfebee5', 'test@gmail.com', 1, 1),
(8, 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 'user123@gmail.com', 1, 0);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users_products`
--

CREATE TABLE `users_products` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `users_products`
--

INSERT INTO `users_products` (`user_id`, `product_id`) VALUES
(6, 1),
(6, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
