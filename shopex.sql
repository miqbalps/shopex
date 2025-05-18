-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2025 at 07:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopex`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int UNSIGNED NOT NULL,
  `bank_name` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `card_number` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cvv` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `member_name` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank_name`, `card_number`, `cvv`, `member_name`, `user_id`) VALUES
(3, 'ZA0AuRQIXS1Q2kbh5KdaqnI2cG1SOVA2QWpnYUpSZ2RDNjRGbUE9PQ==', 'wZuy0W/qd4CxKCjGrIlE4FpWT2xDVWg0Y2xUbWRmNStGTVc0NVE9PQ==', 'evkWKaw/PZfnmQ0uHAdoODNUNjN1VEZvUG5WcjYraXpPT09Ib2c9PQ==', 'aiAxhW9XP+Dt25+M0X1WUklTcks3WlpvMjVkc2JyOXBxSGxzUmc9PQ==', 2),
(4, 'N8Ft8RTdsIxug89G5E17vWdYUjNoMFlPelRRamd1K3RWU0NSc1E9PQ==', '7YG/DIB2uL4IdRSHqu3ZwDhpQVVNaTV5TkRKTVRFeFdkckNLYlE9PQ==', '3W76u/RP7yZmo+hzA+QTo3hleU1aQkRtYzFiWWZYN1VWY1BXZFE9PQ==', 'eGj3SKQP2Ec140mhRpVgp3JCOGYwU3dDMzV6TzhHS2RaS3I3Vnc9PQ==', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(9, 2, 1, 1, '2025-05-07 07:15:58'),
(10, 2, 2, 1, '2025-05-07 07:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Elektronik'),
(2, 'Pakaian'),
(3, 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `description`, `image`, `category_id`, `created_at`) VALUES
(1, 'Smartphone XYZ', 2500000, 10, 'Smartphone dengan fitur lengkap.', 'smartphone.png', 1, '2025-05-04 11:39:10'),
(2, 'Kaos Polos', 75000, 50, 'Kaos bahan katun.', 'kaos.png', 2, '2025-05-04 11:39:10'),
(3, 'Keripik Kentang', 15000, 100, 'Snack renyah dan gurih.', 'keripik.png', 3, '2025-05-04 11:39:10');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` timestamp NOT NULL,
  `status` enum('pending','processed','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `bank_id` int NOT NULL,
  `recipient_name` varchar(512) NOT NULL,
  `recipient_email` varchar(512) NOT NULL,
  `recipient_address` varchar(512) NOT NULL,
  `recipient_postal_code` varchar(512) NOT NULL,
  `recipient_phone` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `date`, `status`, `total`, `created_at`, `bank_id`, `recipient_name`, `recipient_email`, `recipient_address`, `recipient_postal_code`, `recipient_phone`) VALUES
(2, 2, '2025-05-05 08:04:50', 'pending', '2500000', '2025-05-05 08:04:50', 1, '0', '0', '0', '0', '0'),
(3, 2, '2025-05-05 08:06:26', 'pending', '2650000', '2025-05-05 08:06:26', 2, '0', '0', '0', '0', '0'),
(4, 2, '2025-05-06 06:05:56', 'pending', '7590000', '2025-05-06 06:05:56', 4, '0', '0', '0', '0', '0'),
(5, 2, '2025-05-06 06:45:29', 'pending', '2500000', '2025-05-06 06:45:29', 3, 'qyiTVp659FefKkWAw5vV9UxSVElSNkRBSXNoais3Z0JONExJeVE9PQ==', 'gK5BaGONiau15epBXoQ+eWN0VndSMk1ORnArelAwdUh3ajJJNWRTa3M5R25qNi8vSXRnVW1YcEx0OU09', '+s0/Ei1mHCnbDcDoOFSLGHpxVTY2UklYT09ra1p1TTkwZXlOMkE9PQ==', 'q6VbvnOHriS1VVNwGm2FMTFKcHlaUXJTL2FQUUh1VWZBVUV3UEE9PQ==', 'xQJj6RD/SzJ/sidOkNJf0Hl3cXg4czVZWGtMYVJJN1RpOFN1ZFE9PQ==');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int UNSIGNED NOT NULL,
  `transaction_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `total`, `price`) VALUES
(1, 2, 1, 1, '2500000.00'),
(2, 3, 1, 1, '2500000.00'),
(3, 3, 2, 2, '75000.00'),
(4, 4, 3, 1, '15000.00'),
(5, 4, 1, 3, '2500000.00'),
(6, 4, 2, 1, '75000.00'),
(7, 5, 1, 1, '2500000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `address`, `phone`) VALUES
(1, 'fadli', 'fadli@gmail.com', '$2y$10$FfP58.1AE3Z2VdNcZ8qDRen2XRD5SeWgqOtsedHKHj8gJDKrIUOo2', '2025-05-04 13:10:36', 'Jalan Sadang, Cibiru, Cileunyi, Kabupaten Bandung', '08123456789'),
(2, 'Ziyad', 'ziyad@gmail.com', '$2y$10$L607uxy67Wfm9HFSVma/uekKxYi6AqhPZI0yyxL4VSlXEfoillm7G', '2025-05-04 17:26:47', '07JAUeb9AMKHrvUlY3pZWVhET1dXUXpVQXpyZUw2MjA2S2ovNWc9PQ==', 'DFcFsDDA1JEcURSnIv3JWnlOU3F5ZkQ5cVU1ZjRvTlJXVWxPNlE9PQ==');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaction_id`),
  ADD KEY `produk_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `bank_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
