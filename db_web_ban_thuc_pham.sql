-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 08:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web_ban_thuc_pham`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`) VALUES
(1, 'lê hữu vinh', 'yeuthethao37@gmail.com', '4297f44b13955235245b2497399d7a93', '0335944671'),
(4, 'Hoàng Văn Tuấn', 'tuankhi@gmail.com', '4297f44b13955235245b2497399d7a93', '0394853875'),
(6, 'Lê Thị Long', 'longnam123@gmail.com', '4297f44b13955235245b2497399d7a93', '0999555888');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `admin_id`, `roles_id`) VALUES
(7, 6, 3),
(31, 1, 1),
(32, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Thịt gà đông lạnh', 1, '2022-03-08'),
(2, 'Thịt gà tươi sạch', 1, '2022-03-08'),
(3, 'Thịt bò Úc Mỹ ngon', 1, '2022-03-08'),
(4, 'Thịt lợn', 1, '2022-03-08'),
(5, 'Thịt trâu Ấn Độ', 1, '2022-03-08'),
(6, 'Hải sản', 1, '2022-03-08'),
(7, 'Gạo sạch cao cấp', 1, '2022-03-08'),
(8, 'Gia vị tẩm ướp', 0, '2022-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `name`, `code`, `amount`, `condition`, `rate`, `updated_at`, `created_at`) VALUES
(7, 'Ngày phụ nữ thế giới', 'WOMANDAY', 20, 'percent', '10', '2022-03-09', '2022-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `total_money` varchar(50) NOT NULL,
  `status` varchar(255) DEFAULT 'Đang chờ xử lý',
  `reason` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customer_id`, `shipping_id`, `payment`, `total_money`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(4, 1, 4, 'cash', '35000.00', 'Đơn đã hủy', 'Hàng xấu vkl cũng bán', '2022-03-09 00:00:00', '2022-03-13'),
(5, 1, 5, 'atm', '70000.00', 'Đơn đã hủy', 'Đặt hàng vì đam mê thôi', '2022-03-09 00:00:00', '2022-03-13'),
(6, 1, 6, 'atm', '375000.00', 'Đơn đã hủy', 'Đang hết tiền', '2022-03-09 00:00:00', '2022-03-13'),
(7, 1, 7, 'momo', '375000.00', 'Đơn đã hủy', 'Thích thì hủy ok', '2022-03-09 00:00:00', '2022-03-13'),
(9, 3, 9, 'cash', '485000.00', 'Đã thanh toán-chờ nhận hàng', NULL, '2022-03-13 16:23:21', '2022-03-13'),
(10, 1, 10, 'atm', '35000.00', 'Đang chờ xử lý', NULL, '2022-03-14 01:41:39', '2022-03-14'),
(11, 1, 11, 'atm', '35000.00', 'Đang chờ xử lý', NULL, '2022-03-14 01:47:40', '2022-03-14'),
(12, 1, 12, 'atm', '35000.00', 'Đơn đã hủy', 'Thích thì hủy chứ lý do cái gì', '2022-03-14 01:50:04', '2022-03-13'),
(13, 1, 13, 'atm', '35000.00', 'Đang chờ xử lý', NULL, '2022-03-14 02:11:55', '2022-03-14'),
(14, 1, 14, 'atm', '35000.00', 'Đang chờ xử lý', NULL, '2022-03-14 02:12:46', '2022-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_quantyti` varchar(50) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_quantyti`, `created_at`) VALUES
(2, 2, 2, 'Ba chỉ bò Úc', '150000', '7', '2022-03-08'),
(3, 2, 3, 'Đùi', '200000', '7', '2022-03-08'),
(4, 3, 1, 'Ức gà', '35000', '4', '2022-03-08'),
(5, 3, 2, 'Ba chỉ bò Úc', '150000', '5', '2022-03-08'),
(6, 3, 3, 'Đùi', '200000', '3', '2022-03-08'),
(7, 4, 1, 'Ức gà', '35000', '1', '2022-03-09'),
(8, 5, 1, 'Ức gà', '35000', '6', '2022-03-09'),
(9, 6, 1, 'Ức gà', '35000', '5', '2022-03-09'),
(10, 6, 3, 'Đùi', '200000', '1', '2022-03-09'),
(11, 7, 1, 'Ức gà', '35000', '5', '2022-03-09'),
(12, 7, 3, 'Đùi', '200000', '3', '2022-03-09'),
(13, 8, 1, 'Ức gà', '35000', '5', '2022-03-09'),
(14, 8, 3, 'Đùi', '200000', '1', '2022-03-09'),
(15, 9, 1, 'Ức gà', '35000', '1', '2022-03-13'),
(16, 9, 2, 'Ba chỉ bò Úc', '150000', '3', '2022-03-13'),
(17, 10, 1, 'Ức gà', '35000', '1', '2022-03-14'),
(18, 11, 1, 'Ức gà', '35000', '1', '2022-03-14'),
(19, 12, 1, 'Ức gà', '35000', '1', '2022-03-14'),
(20, 13, 1, 'Ức gà', '35000', '1', '2022-03-14'),
(21, 14, 1, 'Ức gà', '35000', '1', '2022-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `price` varchar(255) NOT NULL,
  `exp` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `count_sold` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `origin`, `price`, `exp`, `category_id`, `description`, `image`, `count`, `count_sold`, `status`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Ức gà', 'Huyện Yên Thành, Tỉnh Nghệ An', '35000', '2023-07-06', 1, 'Sản phẩm được làm đông ở nhiệt độ -5 độ C, đảm bảo an toàn vệ sinh thực phẩm.', 'uc-ga-dong-lanh.jpg', 2, 14, '1', 'Được kiểm định chất lượng ISO 1999, công nghệ dây chuyền sản xuất hiện đại chuẩn châu Âu.', '2022-03-08', '2022-03-13'),
(2, 'Ba chỉ bò Úc', 'Memborn, Australia', '150000', '2023-01-09', 3, 'Sản phẩm nhập khẩu nguyên bản tại Úc, những chú bò được chăn nuôi với công nghệ hiện đại, thức ăn của bò luôn đảm bảo tiêu chuẩn.', 'bo-uc.jpg', 9980, 21, '1', 'Được viện khoa học thực phẩm Úc chứng nhận an toàn vệ sinh thực phẩm, sản phẩm được người dân Úc ưa chuộng nhất năm 2021', '2022-03-08', '2022-03-13'),
(3, 'Đùi', 'Mumbai, India', '200000', '2023-07-06', 5, 'Sản phẩm đùi nguyên chất với các thớ thịt thơm ngon, đảm bảo hàm lượng dĩnh dưỡng cao, an toàn vệ sinh thực phẩm khi đến tay người tiêu dùng.', 'thit trau an do.jpg', 9986, 15, '1', 'Sản phẩm nhập khẩu từ Ấn Độ với các kiểm định khắt khe của nước sở tại, được hiệp hội thịt Ấn Độ bảo đảm chất lượng.', '2022-03-08', '2022-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'author'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `notes` text NOT NULL,
  `pay_method` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `name`, `email`, `phone`, `address`, `notes`, `pay_method`, `created_at`) VALUES
(1, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0335947793', 'xóm Mỹ Thành, Yên Thành, Nghệ An.', 'Giao vào buổi trưa nhé bayby của em.', 'cash', '2022-03-08 00:00:00'),
(2, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0335947793', 'xóm Mỹ Thành, Yên Thành, Nghệ An.', 'Giao vào buổi trưa nhé bayby của em.', 'cash', '2022-03-08 00:00:00'),
(3, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0394853875', '20/12 Lê Văn Chí', 'ok', 'cash', '2022-03-08 18:03:51'),
(4, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'csdc', 'csdcscscds', 'cash', '2022-03-09 02:30:41'),
(5, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0394853875', 'cscsc', 'cdssd', 'atm', '2022-03-09 15:13:00'),
(6, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', 'ok baby', 'atm', '2022-03-09 15:37:40'),
(7, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', 'll', 'momo', '2022-03-09 15:38:14'),
(8, 'lê hữu vinh', 'yeuthethao37@gmail.com', '0163 594 4671', 'quang sơn ,đô lương ,nghệ an', 'dddcd', 'atm', '2022-03-09 15:58:15'),
(9, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '0394853875', '20/12 Lê Văn Chí', 'Giao nhanh nha đang cần gấp', 'cash', '2022-03-13 16:23:21'),
(10, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', 'Đặt chơi chơi vậy đó', 'atm', '2022-03-14 01:41:39'),
(11, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 đường 3/2 phường 8 quận 10', 'Đặt  để test thôi chứ tiền đâu mua', 'atm', '2022-03-14 01:47:40'),
(12, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 đường 3/2 phường 8 quận 10', 'Giao lẹ không là anh bom hàng đấy', 'atm', '2022-03-14 01:50:04'),
(13, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 đường 3/2 phường 8 quận 10', 'Giao lẹ không là anh bom hàng đấy', 'atm', '2022-03-14 02:11:55'),
(14, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', '0374502693', '22/12 Lê Văn Chí', '33', 'atm', '2022-03-14 02:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'Nguyễn Công Hòa', 'Linhbc98@gmail.com', 'hoayeulinh', '0394853875', '2022-03-08 15:26:23'),
(3, 'Lê Thị Hoài Linh', 'yeuhoa98@gmail.com', '123123', '0335947793', '2022-03-08 15:27:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
