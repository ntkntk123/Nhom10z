-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2024 at 04:22 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bai_viet`
--

CREATE TABLE `bai_viet` (
  `id_bai_viet` int NOT NULL,
  `tieu_de` varchar(55) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id_binh_luan` int NOT NULL,
  `id_khach_hang` int NOT NULL,
  `id_san_pham` int NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_tao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `trang_thai` int NOT NULL DEFAULT '1' COMMENT '1: hiện'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `binh_luan`
--

INSERT INTO `binh_luan` (`id_binh_luan`, `id_khach_hang`, `id_san_pham`, `noi_dung`, `ngay_tao`, `trang_thai`) VALUES
(1, 3, 4, 'TEST', '2024-11-29 06:04:40', 0),
(2, 1, 4, 'EHHE', '2024-11-29 06:38:38', 0),
(3, 1, 5, 'hello', '2024-12-01 01:43:06', 1),
(4, 1, 4, '01/12/2024', '2024-12-01 01:47:20', 0),
(5, 1, 4, '01/12/2024', '2024-12-01 01:47:46', 0),
(6, 1, 4, 'test', '2024-12-01 01:48:30', 0),
(7, 1, 4, 'hehe', '2024-12-01 02:00:53', 0),
(8, 1, 5, 'hello2', '2024-12-01 05:19:51', 0),
(9, 1, 4, 'HELLLOOOO', '2024-12-01 06:38:26', 0),
(10, 1, 4, '17:07', '2024-12-01 10:07:12', 0),
(11, 15, 24, 'Ngonn', '2024-12-01 14:46:55', 1),
(12, 1, 6, 'vippp', '2024-12-01 14:58:09', 0),
(13, 1, 6, 'vip2', '2024-12-01 14:58:14', 0),
(14, 1, 4, '1', '2024-12-01 18:46:17', 0),
(15, 1, 4, '2', '2024-12-01 18:46:22', 0),
(16, 1, 4, '1', '2024-12-02 05:03:06', 1),
(17, 1, 4, '5', '2024-12-02 05:56:56', 1),
(18, 1, 5, 'Đen như cho', '2024-12-02 06:03:51', 1),
(19, 1, 6, 'hehehe', '2024-12-02 06:43:27', 1),
(20, 1, 20, 'vler', '2024-12-02 08:57:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `id` int NOT NULL,
  `id_don_hang` int NOT NULL,
  `id_san_pham` int NOT NULL,
  `so_luong` int NOT NULL,
  `gia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`id`, `id_don_hang`, `id_san_pham`, `so_luong`, `gia`) VALUES
(1, 2, 5, 1, '111.00'),
(2, 1, 5, 1, '111.00'),
(3, 2, 7, 2, '100000.00'),
(4, 2, 42, 1, '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `id` int NOT NULL,
  `id_gio_hang` int NOT NULL,
  `id_san_pham` int NOT NULL,
  `so_luong` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id_danh_muc` int NOT NULL,
  `ten_danh_muc` varchar(55) NOT NULL,
  `trang_thai` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`id_danh_muc`, `ten_danh_muc`, `trang_thai`) VALUES
(1, 'Áo Nam 2', 1),
(2, 'Áo Nữ 2', 1),
(3, 'Áo Nam', 1),
(4, 'Áo Nam 3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id_don_hang` int NOT NULL,
  `id_khach_hang` int NOT NULL,
  `ten_khach_hang` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dia_chi` text,
  `payment_method` varchar(50) DEFAULT NULL,
  `tong_tien` decimal(10,2) DEFAULT NULL,
  `ngay_dat_hang` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id_don_hang`, `id_khach_hang`, `ten_khach_hang`, `email`, `phone`, `dia_chi`, `payment_method`, `tong_tien`, `ngay_dat_hang`) VALUES
(1, 30, 'khaiz', 'trongkhai618@gmail.com', '0888292005', 'aaa', 'Tiền mặt', '111.00', '2024-12-02 17:14:27'),
(2, 30, 'khaiz', 'trongkhai618@gmail.com', '0325 540 535', 'aaa', 'Tiền mặt', '200001.00', '2024-12-02 17:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_gio_hang` int NOT NULL,
  `id_khach_hang` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`id_gio_hang`, `id_khach_hang`) VALUES
(1, 1),
(12, 15);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id_khach_hang` int NOT NULL,
  `ten_khach_hang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int DEFAULT '0',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `trang_thai` int NOT NULL DEFAULT '0' COMMENT '0: hiện ; 1: ẩn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`id_khach_hang`, `ten_khach_hang`, `username`, `password`, `phone`, `email`, `role`, `create_at`, `trang_thai`) VALUES
(1, 'Nguyễn Danh Dũng', 'admin', '1', '0888292005', 'khaidz@gmail.com', 1, '2024-11-17 02:42:29', 0),
(2, '', '121', '1', '', 'abc@gmail.com', 1, '2024-11-17 04:09:59', 0),
(3, 'Dũng', '1', '1', NULL, 'dungndph51446@gmail.com', 0, '2024-11-17 04:14:07', 1),
(4, 'Nguyễn Danh Dũng', 'dungxnd', '1', NULL, 'nguyendanhdung79@gmail.com', 0, '2024-11-17 07:46:32', 1),
(15, 'Dũng ND', 'dungx', '1', '0987635261', 'nguyendanhdung479@gmail.com', 0, '2024-12-01 14:41:12', 0),
(17, 'dung05', 'Dũng 2005', 'dung2005', '0987635261', '1@gmail.com', 0, '2024-12-02 01:56:24', 1),
(29, 'Nguyeenx Danh Dunxg', 'dungx2', '111111', '0987625612', 'nguyendanhdung479@gmail.com', 0, '2024-12-02 08:37:31', 0),
(30, 'khaikaka', 'khai2005ntk', '111111', '0488438936', 'tranvanhuy102@hotmail.com', 0, '2024-12-02 16:33:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id_san_pham` int NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `id_danh_muc` int DEFAULT NULL,
  `hinh_anh` text,
  `mo_ta` text,
  `gia` decimal(10,2) NOT NULL,
  `so_luong` int DEFAULT '0',
  `trang_thai` int DEFAULT '1',
  `an_hien` int NOT NULL DEFAULT '1' COMMENT '1: hiện',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id_san_pham`, `ten_san_pham`, `id_danh_muc`, `hinh_anh`, `mo_ta`, `gia`, `so_luong`, `trang_thai`, `an_hien`, `create_at`) VALUES
(3, 'Áo 1KK', 3, 'data:image/jpeg;base64,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', 'XỊN XÒ AND PROVIP', '111.00', 0, 1, 0, '2024-11-29 04:34:27'),
(4, 'Áo CC', 3, 'data:image/jpeg;base64,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', 'Using a combination of grid and utility classes, cards can be made horizontal in a mobile-friendly and responsive way. In the example below, we remove the grid gutters with .g-0 and use .col-md-* classes to make the card horizontal at the md breakpoint. Further adjustments may be needed depending on your card content. Accessibility tip: Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies like screen readers. Please ensure the meaning is obvious from the content itself (e.g., the visible text with a sufficient color contrast) or is included through alternative means, such as additional text hidden with the .visually-hidden class.', '111222.00', 99, 2, 1, '2024-11-29 04:34:27'),
(5, 'Áo nam ', 1, 'https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/November2024/24CMCW.KM005_-_Navy_1.jpg', 'Using a combination of grid and utility classes, cards can be made horizontal in a mobile-friendly and responsive way. In the example below, we remove the grid gutters with .g-0 and use .col-md-* classes to make the card horizontal at the md breakpoint. Further adjustments may be needed depending on your card content. Accessibility tip: Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies like screen readers. Please ensure the meaning is obvious from the content itself (e.g., the visible text with a sufficient color contrast) or is included through alternative means, such as additional text hidden with the .visually-hidden class.', '111.00', 0, 1, 1, '2024-11-29 04:34:27'),
(6, 'Áo Nữ 99', 2, './uploads/17328571442505.png', '&amp;lt;br /&amp;gt;\r\n&amp;lt;b&amp;gt;Deprecated&amp;lt;/b&amp;gt;:  htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in &amp;lt;b&amp;gt;C:\\laragon\\www\\dự án 1\\Nhom10z\\admin\\formUpdateSanPham.php&amp;lt;/b&amp;gt; on line &amp;lt;b&amp;gt;183&amp;lt;/b&amp;gt;&amp;lt;br /&amp;gt;\r\n', '112099.00', 0, 1, 1, '2024-11-29 04:34:27'),
(7, 'Áo hehe', 1, './uploads/17330187642943.png', '121', '100000.00', 1, 0, 1, '2024-11-29 04:34:27'),
(8, 'HEHEHE', 2, './uploads/17322635271589_2.png', '121', '100010.00', 10, 0, 1, '2024-11-29 04:34:27'),
(10, 'AKA', 2, NULL, '', '12121.00', 99, 1, 1, '2024-11-29 04:34:27'),
(11, 'KAKA21', 4, NULL, '', '1213.00', 10, 0, 1, '2024-11-29 04:34:27'),
(12, 'HEHA', 1, NULL, '', '121212.00', 1, 0, 1, '2024-11-29 04:34:27'),
(13, 'Áo Khoác', 3, './uploads/1732505612ok.jpg', 'Không có', '200000.00', 21, 0, 1, '2024-11-29 04:34:27'),
(14, 'Áo Khoác 2', 3, './uploads/173250568276799446edb57236a1d23e50452ae4c2.jpg', 'Không có mô tả hehe', '100000.00', 10, 0, 1, '2024-11-29 04:34:27'),
(18, 'hehe', 4, NULL, 'jkjkj', '989.00', 778, 1, 1, '2024-11-29 04:43:34'),
(20, 'Áo', 2, './uploads/17328571175.png', 'ffs', '13123.00', 214, 0, 1, '2024-11-29 05:11:57'),
(23, 'Áo 99990', 4, './uploads/1733019052vn-11134201-7r98o-ltdz5k8b7nykf4.jpg', 'hihe', '1212112.00', 1, 0, 1, '2024-12-01 02:10:52'),
(24, 'áo 0909', 3, './uploads/1733019129sg-11134201-7qvd7-libsrrkcxzwtbd.jpg', 'Áo nam', '333333.00', 1, 0, 1, '2024-12-01 02:12:09'),
(26, '2', 2, './uploads/1733019199sg-11134201-7qvd7-libsrrkcxzwtbd.jpg', '2', '2.00', 2, 0, 1, '2024-12-01 02:13:19'),
(30, 'TEST Áo', 1, './uploads/17330568868.png', '99', '999.00', 999, 1, 1, '2024-12-01 12:41:26'),
(31, 'TEST Áo2', 1, './uploads/1733057142163.png', '', '100000.00', 1, 1, 1, '2024-12-01 12:45:42'),
(32, 'TEST Áo 99', 4, './uploads/1733057181ImgEffect 4.png', '', '9090.00', 999, 1, 1, '2024-12-01 12:46:21'),
(33, 'TEST Áo', 2, './uploads/1733057684165.png', '1131', '100000.00', 1212, 1, 0, '2024-12-01 12:54:44'),
(38, 'VMWare', 4, NULL, '', '9999.00', 1, 1, 0, '2024-12-01 15:25:53'),
(39, 'HEHEHIHI', 3, './uploads/1733066792ImgEffect 20.png', '313', '13131.00', 1, 1, 1, '2024-12-01 15:26:32'),
(40, 'TEST Áo 999', 1, './uploads/1733116450165.png', '1', '10008765.00', 2, 0, 0, '2024-12-02 05:14:10'),
(41, 'Nhóm 10', 4, NULL, 'Nhom10', '1.00', 1, 1, 0, '2024-12-02 06:58:58'),
(42, 'Đang bán', 1, './uploads/1733129731ImgEffect 11.png', '1', '1.00', 1, 1, 1, '2024-12-02 08:55:31'),
(43, 'Ngừng bán', 3, './uploads/1733129754ImgEffect 24.png', '1', '1.00', 1, 2, 0, '2024-12-02 08:55:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bai_viet`
--
ALTER TABLE `bai_viet`
  ADD PRIMARY KEY (`id_bai_viet`);

--
-- Indexes for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id_binh_luan`),
  ADD KEY `binh_luan_ibfk_1` (`id_khach_hang`),
  ADD KEY `binh_luan_ibfk_2` (`id_san_pham`);

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_don_hang` (`id_don_hang`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Indexes for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gio_hang` (`id_gio_hang`),
  ADD KEY `id_san_pham` (`id_san_pham`);

--
-- Indexes for table `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id_danh_muc`),
  ADD UNIQUE KEY `ten_danh_muc` (`ten_danh_muc`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id_don_hang`),
  ADD KEY `id_khach_hang` (`id_khach_hang`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id_gio_hang`),
  ADD UNIQUE KEY `id_khach_hang` (`id_khach_hang`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id_khach_hang`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_san_pham`),
  ADD KEY `san_pham_ibfk_1` (`id_danh_muc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bai_viet`
--
ALTER TABLE `bai_viet`
  MODIFY `id_bai_viet` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `id_binh_luan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `id_danh_muc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id_don_hang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id_gio_hang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id_khach_hang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_san_pham` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `khach_hang` (`id_khach_hang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `binh_luan_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `chi_tiet_gio_hang_ibfk_1` FOREIGN KEY (`id_gio_hang`) REFERENCES `gio_hang` (`id_gio_hang`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_gio_hang_ibfk_2` FOREIGN KEY (`id_san_pham`) REFERENCES `san_pham` (`id_san_pham`) ON DELETE CASCADE;

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `khach_hang` (`id_khach_hang`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_khach_hang`) REFERENCES `khach_hang` (`id_khach_hang`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id_danh_muc`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
