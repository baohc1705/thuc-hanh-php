-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 12:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

DROP DATABASE IF EXISTS bookstore;
CREATE DATABASE bookstore CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE bookstore;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `description`, `status`) VALUES
(8, 'Comic', '1765328457_category-comic.png', 'Truyện tranh comic marvel', 1),
(9, 'Comic DC', '1765328482_category-comic-dc.png', 'Truyện tranh comic DC', 1),
(10, 'Đồ Chơi', '1765328540_category-do-choi.png', 'Đồ chơi lưu niệm cho trẻ em', 1),
(11, 'IT - Công nghệ', '1765328577_category-it.png', 'Sách công nghệ cho sinh viên, người đi làm', 1),
(12, 'Manga', '1765328603_category-manga.png', 'Truyện tranh Nhật bản', 1),
(13, 'Màu vẽ', '1765328633_category-mau-ve.png', 'Văn phòng phẩm', 1),
(14, 'Thú bông', '1765328654_category-thu-bong.png', 'Đồ chơi cho trẻ', 1),
(15, 'Tiểu thuyết', '1765328687_category-tieu-thuyet.png', 'Tiểu thuyết Việt Nam', 1),
(16, 'Truyện Ngắn', '1765328724_category-van-hoc.png', 'Truyện ngắn Việt Nam', 1),
(17, 'Bút, Viết', '1765328755_category-van-phong.png', 'Văn phòng phẩm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `recipient` varchar(150) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `note` text NOT NULL,
  `status` varchar(250) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `received_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `recipient`, `phone`, `address`, `note`, `status`, `payment_status`, `payment_method`, `created_at`, `received_at`) VALUES
('202506121630225678', 9, 179000, 'Nguyễn Văn An', '0901234567', '123 Lê Lợi, Quận 1, TP.HCM', 'Giao trước 17h', 'delivered', 'paid', 'vnpay', '2025-06-12 09:30:22', '2025-12-12 10:42:55'),
('202506151805338912', 10, 89000, 'Trần Thị Bé', '0912345678', '45 Nguyễn Trãi, Quận 5', '', 'confirmed', 'paid', 'cod', '2025-06-15 11:05:33', '2025-12-12 10:42:55'),
('202506182022449876', 11, 567000, 'Lê Minh Châu', '0934567890', '88 Cao Thắng, Quận 3', 'Gọi trước khi giao', 'pending', 'unpaid', 'vnpay', '2025-06-18 13:22:44', '2025-12-12 10:42:55'),
('202506221748557891', 9, 145000, 'Huỳnh Chí Bảo', '0337778965', 'ấp Chiến Thắng, Long An', '', 'delivered', 'paid', 'cod', '2025-06-22 10:48:55', '2025-12-12 10:42:55'),
('202506291934561234', 10, 29000, 'Phạm Ngọc Diễm', '0945678901', '12 Trần Hưng Đạo, Quận 1', 'Giao nhanh giúp shop', 'confirmed', 'paid', 'vnpay', '2025-06-29 12:34:56', '2025-12-12 10:42:55'),

('202507031656783210', 11, 612000, 'brian123', '0337778965', 'Cao Lỗ, Quận 8', '123', 'delivered', 'paid', 'vnpay', '2025-07-03 09:00:00', '2025-12-12 10:42:55'),
('202507081409874563', 9, 78000, 'Trần Văn Em', '0956789012', '56 Nguyễn Thị Minh Khai, Q3', '', 'confirmed', 'paid', 'cod', '2025-07-08 09:00:00', '2025-12-12 10:42:55'),
('202507122033992345', 10, 167000, 'Nguyễn Thị Lan', '0967890123', '99 Lê Văn Sỹ, Phú Nhuận', 'Để trước cửa', 'pending', 'unpaid', 'vnpay', '2025-07-12 09:00:00', '2025-12-12 10:42:55'),
('202507181245123456', 11, 59000, 'Lê Hoàng Long', '0978901234', '321 Điện Biên Phủ, Bình Thạnh', '', 'delivered', 'paid', 'cod', '2025-07-18 05:45:12', '2025-12-12 10:42:55'),
('202507222256348912', 9, 215000, 'chi bao', '0337778965', 'ấp Chiến Thắng', 'Test đơn hàng', 'confirmed', 'paid', 'vnpay', '2025-07-22 15:56:34', '2025-12-12 10:42:55'),
('202507281812450987', 10, 45000, 'Phạm Văn Minh', '0989012345', '78 Nguyễn Văn Cừ, Quận 5', '', 'delivered', 'paid', 'cod', '2025-07-28 11:12:45', '2025-12-12 10:42:55'),

('202508022134561278', 11, 567000, 'Trần Ngọc Nhi', '0909876543', '55 Pasteur, Quận 1', 'Giao giờ hành chính', 'pending', 'unpaid', 'vnpay', '2025-08-02 14:34:56', '2025-12-12 10:42:55'),
('202508071556782134', 9, 28000, 'Nguyễn Anh Khoa', '0918765432', '11 Võ Văn Tần, Quận 3', '', 'confirmed', 'paid', 'cod', '2025-08-07 09:00:00', '2025-12-12 10:42:55'),
('202508122108893456', 10, 115000, 'Lê Thị Mai', '0927654321', '222 Hai Bà Trưng, Quận 1', '123', 'delivered', 'paid', 'vnpay', '2025-08-12 09:00:00', '2025-12-12 10:42:55'),
('202508172323904567', 11, 98000, 'Huỳnh Chí Bảo', '0337778965', 'Cao Lỗ, TP.HCM', '', 'confirmed', 'paid', 'cod', '2025-08-17 13:34:59', '2025-12-12 10:42:55'),
('202508222345125678', 9, 56000, 'Trần Quốc Phong', '0936543210', '33 Nguyễn Thái Học, Quận 1', 'Giao nhanh', 'pending', 'unpaid', 'vnpay', '2025-08-22 16:45:12', '2025-12-12 10:42:55'),
('202508272056236789', 10, 75000, 'Nguyễn Thị Quỳnh', '0945432109', '88 Lý Tự Trọng, Quận 1', '', 'delivered', 'paid', 'cod', '2025-08-27 13:56:23', '2025-12-12 10:42:55'),

('202509011534347891', 11, 45000, 'Lê Văn Sang', '0954321098', '99 Phạm Ngọc Thạch, Quận 3', 'Gọi trước 30 phút', 'confirmed', 'paid', 'vnpay', '2025-09-01 08:34:34', '2025-12-12 10:42:55'),
('202509062145458912', 9, 129000, 'brian123', '0337778965', 'ấp Chiến Thắng', '', 'received', 'paid', 'cod', '2025-09-06 14:45:45', '2025-12-12 10:56:56'),
('202509112256569023', 10, 567000, 'Trần Thị Thảo', '0963210987', '111 Bùi Thị Xuân, Quận 1', 'Giao sau 16h', 'pending', 'unpaid', 'vnpay', '2025-09-11 15:56:56', '2025-12-12 10:42:55'),
('202509162034670134', 11, 89000, 'Nguyễn Văn Tí', '0972109876', '45 Trần Quang Khải, Quận 1', '', 'confirmed', 'paid', 'cod', '2025-09-16 09:00:00', '2025-12-12 10:42:55'),
('202509211445781245', 9, 29000, 'Phạm Thị Út', '0981098765', '66 Nguyễn Đình Chiểu, Q3', '123', 'delivered', 'paid', 'vnpay', '2025-09-21 09:00:00', '2025-12-12 10:42:55'),
('202509262312892356', 10, 45000, 'Huỳnh Chí Bảo', '0337778965', 'Cao Lỗ', 'Test', 'confirmed', 'paid', 'cod', '2025-09-26 09:00:00', '2025-12-12 10:42:55'),

('202510011823903467', 11, 167000, 'Lê Thị Vân', '0909871234', '77 Lê Thánh Tôn, Quận 1', '', 'pending', 'unpaid', 'vnpay', '2025-10-01 09:00:00', '2025-12-12 10:42:55'),
('202510062034014578', 9, 612000, 'Trần Văn Xê', '0918762345', '88 Nam Kỳ Khởi Nghĩa, Q1', 'Giao nhanh', 'received', 'paid', 'cod', '2025-10-06 13:34:01', NULL),
('202510112045125689', 10, 78000, 'Nguyễn Thị Yến', '0927653456', '99 Huỳnh Thúc Kháng, Q1', '', 'confirmed', 'paid', 'vnpay', '2025-10-11 13:45:12', '2025-12-12 10:42:55'),
('202510162256236790', 11, 59000, 'chi bao', '0337778965', 'ấp Chiến Thắng', '123', 'delivered', 'paid', 'cod', '2025-10-16 15:56:23', '2025-12-12 10:42:55'),
('202510211708347901', 9, 28000, 'Phạm Văn Z', '0936544567', '111 Tôn Đức Thắng, Quận 1', '', 'pending', 'unpaid', 'vnpay', '2025-10-21 10:08:34', '2025-12-12 10:42:55'),
('202510272234458912', 10, 115000, 'Trần Ngọc Ánh', '0945435678', '222 Nguyễn Huệ, Quận 1', 'Giao giờ hành chính', 'confirmed', 'paid', 'cod', '2025-10-27 15:34:45', '2025-12-12 10:42:55'),

('202511011356569023', 11, 567000, 'Lê Minh Đức', '0954326789', '333 Bùi Viện, Quận 1', '', 'delivered', 'paid', 'vnpay', '2025-11-01 06:56:56', '2025-12-12 10:42:55'),
('202511062145670134', 9, 45000, 'brian123', '0337778965', 'Cao Lỗ, TP.HCM', 'Test cuối năm', 'confirmed', 'paid', 'cod', '2025-11-06 09:00:00', '2025-12-12 10:42:55'),
('202511111934781245', 10, 89000, 'Nguyễn Văn Hùng', '0963217890', '444 Lê Lợi, Quận 1', '', 'pending', 'unpaid', 'vnpay', '2025-11-11 09:00:00', '2025-12-12 10:42:55'),
('202511162256892356', 11, 29000, 'Trần Thị Kim', '0972108901', '555 Nguyễn Trãi, Quận 5', 'Giao nhanh', 'delivered', 'paid', 'cod', '2025-11-16 09:00:00', '2025-12-12 10:42:55'),
('202511211823903467', 9, 567000, 'Huỳnh Chí Bảo', '0337778965', 'ấp Chiến Thắng', '', 'confirmed', 'paid', 'vnpay', '2025-11-21 09:00:00', '2025-12-12 10:42:55'),
('202511272045014578', 10, 45000, 'Phạm Văn Lâm', '0981099012', '666 Hai Bà Trưng, Q1', '123', 'delivered', 'paid', 'cod', '2025-11-27 13:45:01', '2025-12-12 10:42:55'),

('202512012156125689', 11, 179000, 'Lê Thị Mai', '0909870123', '777 Pasteur, Quận 3', '', 'pending', 'unpaid', 'vnpay', '2025-12-01 14:56:12', '2025-12-12 10:42:55'),
('202512062034236790', 9, 612000, 'chi bao', '0337778965', 'Cao Lỗ', 'Đơn hàng cuối năm', 'confirmed', 'paid', 'cod', '2025-12-06 13:34:23', '2025-12-12 10:42:55'),
('202512111608347901', 10, 567000, 'Nguyễn Văn Tèo', '0918763456', '888 Lê Lợi, Quận 1', 'Giao trước Tết', 'delivered', 'paid', 'vnpay', '2025-12-11 09:08:34', '2025-12-12 10:42:55'),
('202512121712266876', 15, 137000, 'Test', '0337771234', 'ấp Chiến Thắng', 'để trước cửa', 'received', 'paid', 'vnpay', '2025-12-12 10:12:26', '2025-12-12 17:28:57');


-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` varchar(150) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`) VALUES
(1, '202506121630225678', 26, 1, 45000, 45000),
(2, '202506121630225678', 25, 1, 567000, 567000),
(3, '202506121630225678', 21, 1, 29000, 29000),
(4, '202506151805338912', 14, 1, 89000, 89000),
(5, '202506182022449876', 25, 1, 567000, 567000),
(6, '202506221748557891', 11, 1, 125000, 125000),
(7, '202506221748557891', 20, 1, 28000, 28000),
(8, '202506291934561234', 21, 1, 29000, 29000),
(9, '202507031656783210', 25, 1, 567000, 567000),
(10, '202507031656783210', 26, 1, 45000, 45000),
(11, '202507081409874563', 19, 1, 78000, 78000),
(12, '202507122033992345', 16, 1, 167000, 167000),
(13, '202507181245123456', 27, 1, 59000, 59000),
(14, '202507222256348912', 26, 2, 45000, 90000),
(15, '202507222256348912', 25, 1, 125000, 125000),
(16, '202507281812450987', 26, 1, 45000, 45000),
(17, '202508022134561278', 25, 1, 567000, 567000),
(18, '202508071556782134', 20, 1, 28000, 28000),
(19, '202508122108893456', 12, 1, 115000, 115000),
(20, '202508172323904567', 13, 1, 98000, 98000),
(21, '202508222345125678', 15, 1, 56000, 56000),
(22, '202508272056236789', 10, 1, 75000, 75000),
(23, '202509011534347891', 26, 1, 45000, 45000),
(24, '202509062145458912', 24, 1, 45000, 45000),
(25, '202509062145458912', 19, 1, 78000, 78000),
(26, '202509112256569023', 25, 1, 567000, 567000),
(27, '202509162034670134', 14, 1, 89000, 89000),
(28, '202509211445781245', 21, 1, 29000, 29000),
(29, '202509262312892356', 26, 1, 45000, 45000),
(30, '202510011823903467', 16, 1, 167000, 167000),
(31, '202510062034014578', 25, 1, 567000, 567000),
(32, '202510062034014578', 26, 1, 45000, 45000),
(33, '202510112045125689', 19, 1, 78000, 78000),
(34, '202510162256236790', 27, 1, 59000, 59000),
(35, '202510211708347901', 20, 1, 28000, 28000),
(36, '202510272234458912', 12, 1, 115000, 115000),
(37, '202511011356569023', 25, 1, 567000, 567000),
(38, '202511062145670134', 26, 1, 45000, 45000),
(39, '202511111934781245', 14, 1, 89000, 89000),
(40, '202511162256892356', 21, 1, 29000, 29000),
(41, '202511211823903467', 25, 1, 567000, 567000),
(42, '202511272045014578', 26, 1, 45000, 45000),
(43, '202512012156125689', 26, 2, 45000, 90000),
(44, '202512012156125689', 21, 1, 29000, 29000),
(45, '202512062034236790', 25, 1, 567000, 567000),
(46, '202512062034236790', 26, 1, 45000, 45000),
(47, '202512111608347901', 25, 1, 567000, 567000),
(56, '202512121712266876', 19, 1, 78000, 78000),
(57, '202512121712266876', 27, 1, 59000, 59000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(150) DEFAULT NULL,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `createAt` datetime NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `author`, `price`, `image`, `description`, `stock`, `status`, `createAt`, `category_id`) VALUES
(8, 'Spiderman - One more day', 'Huynh Chi Bao', 45000, '1765328954_product-img-2.jpg', 'Truyện tranh spiderman', 200, 1, '2025-12-10 08:09:14', 8),
(9, 'Spiderman - 21', 'Huynh Chi Bao', 60000, '1765329068_product-img-1.jpg', 'truyện tranh comic marvel', 200, 1, '2025-12-10 08:11:08', 8),
(10, 'Spiderman - 3', 'Huynh Chi Bao', 75000, '1765329125_product-img-3.jpg', 'truyện tranh comic marvel', 100, 1, '2025-12-10 08:12:05', 8),
(11, 'Thám tử Conan', 'Huynh Chi Bao', 125000, '1765329336_product-img-4.jpg', 'Thám tử lừng danh conan', 100, 1, '2025-12-10 08:15:36', 12),
(12, 'Spiderman - Tập 31', 'Huynh Chi Bao', 115000, '1765329394_product-img-5.jpg', 'truyện tranh comic marvel', 100, 1, '2025-12-10 08:16:34', 8),
(13, 'Spiderman - Tập 19', 'Huynh Chi Bao', 98000, '1765329445_product-img-6.jpg', 'truyện tranh marvel', 100, 1, '2025-12-10 08:17:25', 8),
(14, 'Amazing Spiderman', 'Huynh Chi Bao', 89000, '1765329498_product-img-8.jpg', 'truyện tranh marvel', 100, 1, '2025-12-10 08:18:18', 8),
(15, 'Iron man', 'Huynh Chi Bao', 56000, '1765329538_product-img-9.jpg', 'truyện tranh marvel\r\n', 100, 1, '2025-12-10 08:18:58', 8),
(16, 'Iron man 2', 'Huynh Chi Bao', 167000, '1765329581_product-img-10.jpg', 'truyện tranh marvel', 100, 1, '2025-12-10 08:19:41', 8),
(17, 'Batman', 'Huynh Chi Bao', 56000, '1765329617_product-img-13.jpg', 'truyện tranh dc', 150, 1, '2025-12-10 08:20:17', 9),
(18, 'Batman 2', 'Huynh Chi Bao', 67000, '1765329644_product-img-15.jpg', 'Truyện tranh dc', 150, 1, '2025-12-10 08:20:44', 9),
(19, 'Batman 3', 'Huynh Chi Bao', 78000, '1765329667_product-img-16.jpg', 'truyện tranh dc', 150, 1, '2025-12-10 08:21:07', 9),
(20, '7 Viên ngọc rồng - tập 12', 'Huynh Chi Bao', 28000, '1765329721_product-img-17.jpg', 'Truyện tranh nhật bản', 150, 1, '2025-12-10 08:22:01', 12),
(21, '7 viên ngọc rồng tập 12', 'Huynh Chi Bao', 29000, '1765329762_product-img-18.jpg', 'truyện tranh nhật bản', 150, 1, '2025-12-10 08:22:42', 12),
(22, '7 viên ngọc rồng tập 57', 'Huynh Chi Bao', 57000, '1765329797_product-img-19.jpg', 'truyện tranh nhật bản', 150, 1, '2025-12-10 08:23:17', 12),
(23, 'Spring Boot tutorial', 'Huynh Chi Bao', 123000, '1765329878_spring-boot.jpg', 'sách dạy spring boot cho người mới', 150, 1, '2025-12-10 08:24:38', 11),
(24, 'PHP and MySQL', 'Huynh Chi Bao', 45000, '1765329970_php.png', 'sách dạy lập trình', 150, 1, '2025-12-10 08:26:10', 11),
(25, 'Gundam bandai', 'Huynh Chi Bao', 567000, '1765330073_gundem-1.png', 'đồ chơi cho trẻ', 150, 1, '2025-12-10 08:27:53', 10),
(26, 'Gundam v2 bandai', 'Huynh Chi Bao', 45000, '1765330213_gundam-2.png', 'đồ chơi trẻ em', 150, 1, '2025-12-10 08:29:09', 10),
(27, 'Lão Hạc', 'Nam Cao', 59000, '1765330445_laohac.png', 'truyện ngắn việt nam', 400, 1, '2025-12-10 08:34:05', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `address`, `role`, `status`, `created_at`) VALUES
(9, 'bao', '$2y$10$rL/DjbYkLFESlN8llt5e8eIF5u817TurTdsnwdKY1e1KEdRi3.1UW', 'Huỳnh Họa Bảo', 'chibao@gmail.com', '0337778965', 'ấp Chiến Thắng', 1, 1, '2025-12-10 08:49:41'),
(10, 'brian123', '$2y$10$./NS/oP.XXb0A8EGCyzzuOht1asoe4xV4njtmWlLL118L0leBmOFG', 'Dev Blue', 'abc@gmail.com', NULL, NULL, 0, 1, '2025-12-11 10:43:40'),
(11, 'chibao', '$2y$10$k8gS5IWn1VWGq9LQdT.KD.ziK45mEmh.o4NEfWiMK1FyOOSi831cm', 'Huỳnh Chí Bảo', 'devblue404@gmail.com', '0337778965', 'ấp Chiến Thắng', 0, 1, '2025-12-11 10:59:10'),
(12, 'dev123', '$2y$10$ZuG.Og7Z3hcrN/AU3374C.UWSBBTYfS6A9uRCmA77igWFsvpsaQOy', 'Brian Bennet', 'abc123@gmail.com', NULL, NULL, 0, 1, '2025-12-12 05:13:44'),
(14, 'admin', '$2y$10$qlfy0pplUY2cpJMIyiJyUujukz54NxJ5r6do3dLFcK95Vawtqeaxq', 'Huỳnh Chí Bảo', 'admin@gmail.com', '', '', 1, 1, '2025-12-12 10:05:53'),
(15, 'test', '$2y$10$rJ/mGthZYpHT9rjceekuNOO0CzfLhO4fQPYZYdrefy.BdVCg6cAZa', 'Test', 'test@gmail.com', '', '', 0, 1, '2025-12-12 10:09:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product` (`product_id`),
  ADD KEY `fk_order` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
