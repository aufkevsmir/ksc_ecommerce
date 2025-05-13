-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 08:10 PM
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
-- Database: `ksc_db`
--

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(19, 2, 11, 1),
(20, 2, 9, 1),
(21, 2, 12, 1);

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `name`, `address`, `contact_number`, `industry`, `created_at`) VALUES
(1, 1, 'Gigabyte', 'Kanto lang', '12345678901', 'Tech', '2025-05-14 01:52:06');

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `buyer_id`, `product_id`, `message`, `status`, `created_at`, `reply_message`) VALUES
(1, 2, 11, 'test', 'responded', '2025-05-09 05:13:02', 'Hello!'),
(2, 2, 11, 'bano\r\n', 'responded', '2025-05-12 01:02:55', 'bano'),
(3, 2, 12, 'What is this\r\n', 'new', '2025-05-13 20:58:36', NULL);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `buyer_id`, `seller_id`, `total_amount`, `status`, `created_at`) VALUES
(1, 2, 1, 0.00, 'cancelled', '2025-05-09 04:05:23'),
(2, 2, 1, 0.00, 'paid', '2025-05-09 04:14:03'),
(3, 2, 1, 0.00, 'paid', '2025-05-09 04:22:34'),
(4, 2, 1, 11.00, 'paid', '2025-05-09 04:22:56'),
(5, 2, 1, 11.00, 'paid', '2025-05-12 01:03:02'),
(6, 2, 1, 300.00, 'paid', '2025-05-12 18:32:09'),
(7, 2, 1, 11.00, 'paid', '2025-05-12 19:01:35'),
(8, 4, 1, 11.00, 'paid', '2025-05-12 20:00:42'),
(9, 4, 1, 11.00, 'paid', '2025-05-12 20:03:01'),
(10, 4, 1, 100.00, 'paid', '2025-05-12 20:08:38'),
(11, 4, 1, 100.00, 'paid', '2025-05-12 20:12:14'),
(12, 2, 1, 111.00, 'paid', '2025-05-13 05:48:26'),
(13, 2, 1, 200.00, 'paid', '2025-05-13 20:58:11');

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 3, 9, 1, 0.00),
(2, 4, 11, 1, 11.00),
(3, 5, 11, 1, 11.00),
(4, 6, 12, 2, 100.00),
(5, 6, 8, 1, 100.00),
(6, 7, 11, 1, 11.00),
(7, 7, 9, 1, 0.00),
(8, 8, 11, 1, 11.00),
(9, 9, 11, 1, 11.00),
(10, 10, 12, 1, 100.00),
(11, 11, 12, 1, 100.00),
(12, 12, 12, 1, 100.00),
(13, 12, 11, 1, 11.00),
(14, 13, 12, 2, 100.00);

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `name`, `description`, `price`, `stock`, `image_blob`, `image_url`, `status`, `created_at`, `category`) VALUES
(2, 1, 'Test1', 'Test1', 100.00, 5, NULL, NULL, 'active', '2025-05-08 01:53:45', 'Electronics'),
(3, 1, 'Test2', 'Test2', 100.00, 5, NULL, NULL, 'active', '2025-05-08 01:53:55', 'Fashion'),
(4, 1, 'Test3', 'Test3', 100.00, 5, NULL, NULL, 'active', '2025-05-08 01:54:07', 'Home'),
(5, 1, 'Test4', 'Test4', 10000.00, 55, NULL, NULL, 'active', '2025-05-08 01:54:20', 'Electronics'),
(6, 1, 'Test6', 'Test6', 100.00, 55, NULL, NULL, 'active', '2025-05-08 01:54:34', 'Electronics'),
(8, 1, 'Test8', 'Test8', 100.00, 4, NULL, NULL, 'active', '2025-05-08 01:55:03', 'Electronics'),
(9, 1, 'Test9', 'Test9', 0.00, 9, NULL, NULL, 'active', '2025-05-08 01:55:14', 'Electronics'),
(11, 1, 'Car', 'Test11', 11.00, 11, NULL, '/images/products/681bb57b28528_2019_Toyota_Corolla_Icon_Tech_VVT-i_Hybrid_1.8.jpg', 'active', '2025-05-08 01:55:33', 'Electronics'),
(12, 1, 'Jihyi', 'Jihyo timesss', 100.00, 2, NULL, '/images/products/6821a4da765cb_image-removebg-preview.png', 'active', '2025-05-12 01:04:04', 'Electronics');

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `payment_reference`, `amount`, `payment_method`, `paid_at`) VALUES
(1, 7, 'ch_3RNu7608dZUwkrCT070jMB90', 11.00, 'stripe', '2025-05-12 19:01:35'),
(2, 8, 'ch_3RNv2M08dZUwkrCT15kv2jcM', 11.00, 'stripe', '2025-05-12 20:00:42'),
(3, 9, 'ch_3RNv4b08dZUwkrCT1ghgclwQ', 11.00, 'stripe', '2025-05-12 20:03:01'),
(4, 10, 'ch_3RNvA208dZUwkrCT1cdVgQW2', 100.00, 'stripe', '2025-05-12 20:08:38'),
(5, 11, 'ch_3RNvDW08dZUwkrCT1WTtedL8', 100.00, 'stripe', '2025-05-12 20:12:14'),
(6, 12, 'ch_3RO4Cw08dZUwkrCT0tDkvLeO', 111.00, 'stripe', '2025-05-13 05:48:26'),
(7, 13, 'ch_3ROIPN08dZUwkrCT0ZSg3f9H', 200.00, 'stripe', '2025-05-13 20:58:11');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `full_name`, `role`, `created_at`) VALUES
(1, 'seller@seller.com', '$2y$13$eXz55ZEMG9fMrgoFpM2DJuLVflG2qE0OwUxMkh2zMqjz6r5UJh46C', 'Kevin Miranda', 'seller', '2025-05-07 18:28:42'),
(2, 'buyer@buyer.com', '$2y$13$oyqYn4DE5NEPrXyC6Scwj.9hSEYBj1YN76Fhjc/gpIz2tzrn2EvUq', 'Don Henessy', 'buyer', '2025-05-07 18:29:56'),
(3, 'admin@ksc.com', '$2y$13$ysQot8jPUcbThdyvf0tT7.0MIDy6MokgbX.BBqU5N4g9qXzjiBlXa', 'KSC Admin', 'admin', '2025-05-07 19:15:57'),
(4, 'kevsmir07@gmail.com', '$2y$13$sVArGNWkiP3XRDK6CmPz/u5B8lwvhw/IkRpOyytvz88sgFW4Syvlm', 'Carlex Lazaga', 'buyer', '2025-05-12 19:59:16'),
(5, 'test@test1.com', '$2y$13$rL5Tc9roDze1mud/tAbhy.msEajdMjpHCTMDLPJbv6WhV8H01RzPW', 'Test1', 'seller', '2025-05-13 20:03:20'),
(6, 'sam@sam.com', '$2y$13$41Wdl9o8L8FIPSi5hjNJH.89h9eOWkAqgkfXez1vigXEGAMoO1wOO', 'Samantha Ticsaysss', 'buyer', '2025-05-14 01:05:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
