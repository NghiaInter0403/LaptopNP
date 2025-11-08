-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 08, 2025 lúc 03:21 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlyhang1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `madondathang` int(11) NOT NULL,
  `mamathang` int(11) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `dongia` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dondathang`
--

CREATE TABLE `dondathang` (
  `madondathang` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `ngaydat` date NOT NULL,
  `noigiao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `mamathang` int(11) NOT NULL,
  `soluong` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh`
--

CREATE TABLE `hinh` (
  `mahinh` int(11) NOT NULL,
  `mamathang` int(11) DEFAULT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh`
--

INSERT INTO `hinh` (`mahinh`, `mamathang`, `hinhanh`) VALUES
(1, 1, 'legion.png'),
(2, 2, 'dellinspiron.png'),
(4, 4, 'hppavilion.png'),
(5, 5, 'loq.png'),
(6, 6, 'slim7.png'),
(7, 7, 'thinkpad.png'),
(8, 8, 'thinkbook.png'),
(9, 9, 'ideapad.png'),
(10, 10, 'hp14.png'),
(11, 11, 'HP245.png'),
(12, 12, 'hpvitus16.png'),
(13, 13, 'HP250G9.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mathang`
--

CREATE TABLE `mathang` (
  `mamathang` int(11) NOT NULL,
  `tenmathang` varchar(150) NOT NULL,
  `mathuonghieu` int(11) DEFAULT NULL,
  `giaban` decimal(15,2) NOT NULL CHECK (`giaban` >= 0),
  `motasanpham` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mathang`
--

INSERT INTO `mathang` (`mamathang`, `tenmathang`, `mathuonghieu`, `giaban`, `motasanpham`) VALUES
(1, 'Lenovo legion 5', 1, 30000000.00, 'RTX 4050, Ram 16Gb, SSD 512gb, Tảng nhiệt siêu mát, màng hình tần số quét 120Hz'),
(2, 'Dell Inspiron', 2, 18000000.00, 'I7-1255U/16GB/1TB PCIE/15.6 FHD/CẢM ỨNG/WIN11/ĐEN'),
(4, 'hpdalivion', 6, 19000000.00, 'I5-1335U/16GB/512GB PCIE/14.0 FHD/WIN11/BẠC'),
(5, 'Lenovo LOQ', 1, 22190000.00, 'R5-7235HS/16GB/1TB PCIE/VGA 6GB RTX3050/15.6 FHD 144HZ/WIN11/XÁM'),
(6, 'Lenovo Slim 7', 1, 23990000.00, 'Core i5-1135G7/8GB/512GB PCIE/14.0 FHD/WIN10/XANH 82A3002QVN'),
(7, 'Lenovo thinkpad', 1, 28990000.00, 'Ultra 5 225U, 16GB, 512GSSD, 14.0 WUXGA, NoOs, Đen'),
(8, 'Lenovo ThinkBook', 1, 22190000.00, 'R5-7235HS/16GB/1TB PCIE/VGA 6GB RTX3050/15.6 FHD 144HZ/WIN11/XÁM'),
(9, 'Lenovo idea pad', 1, 14690000.00, 'I5-1135G7/8GB/256GB PCIE/15.6 FHD/WIN11/XÁM'),
(10, 'HP 14 ', 6, 15290000.00, 'I5-1335U/16GB/512GB PCIE/14.0 FHD/WIN11/BẠC'),
(11, 'HP 245 G10 BG5U8PT', 6, 14090000.00, 'R7-7730U/16GB/512GB PCIE/14.0 FHD/WIN11/BẠC'),
(12, 'HP Victus 16', 6, 22990000.00, 'R5-7640HS/32GB/512GB PCIE/VGA 6GB RTX4050/16.1 FHD'),
(13, 'HP 250 G9', 6, 13990000.00, 'I5-1235U/16GB/512GB PCIE/15.6 FHD/WIN11/BẠC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `mathuonghieu` int(11) NOT NULL,
  `tenthuonghieu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`mathuonghieu`, `tenthuonghieu`) VALUES
(1, 'Lenovo'),
(2, 'Dell'),
(3, 'Asus'),
(4, 'Macbook'),
(5, 'Acer'),
(6, 'HP');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `tendangnhap` varchar(50) NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `matkhau` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `hoten`, `tendangnhap`, `ngaysinh`, `diachi`, `sdt`, `matkhau`, `role`) VALUES
(1, 'admin', 'admin', '2005-03-04', 'BacLieu', '0352755926', '123456', 'admin'),
(2, 'user', 'user', '2024-12-25', 'CanTho', '0123456789', '12345', 'user'),
(3, 'nghia', 'nghia', '2005-04-03', 'Bạc Liêu', '0352755926', '123456', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`madondathang`,`mamathang`),
  ADD KEY `mamathang` (`mamathang`);

--
-- Chỉ mục cho bảng `dondathang`
--
ALTER TABLE `dondathang`
  ADD PRIMARY KEY (`madondathang`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `mamathang` (`mamathang`);

--
-- Chỉ mục cho bảng `hinh`
--
ALTER TABLE `hinh`
  ADD PRIMARY KEY (`mahinh`),
  ADD KEY `mamathang` (`mamathang`);

--
-- Chỉ mục cho bảng `mathang`
--
ALTER TABLE `mathang`
  ADD PRIMARY KEY (`mamathang`),
  ADD KEY `mathuonghieu` (`mathuonghieu`);

--
-- Chỉ mục cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`mathuonghieu`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tendangnhap` (`tendangnhap`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dondathang`
--
ALTER TABLE `dondathang`
  MODIFY `madondathang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `hinh`
--
ALTER TABLE `hinh`
  MODIFY `mahinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `mathang`
--
ALTER TABLE `mathang`
  MODIFY `mamathang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `mathuonghieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`madondathang`) REFERENCES `dondathang` (`madondathang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`mamathang`) REFERENCES `mathang` (`mamathang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `dondathang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`mamathang`) REFERENCES `mathang` (`mamathang`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hinh`
--
ALTER TABLE `hinh`
  ADD CONSTRAINT `hinh_ibfk_1` FOREIGN KEY (`mamathang`) REFERENCES `mathang` (`mamathang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `mathang`
--
ALTER TABLE `mathang`
  ADD CONSTRAINT `mathang_ibfk_1` FOREIGN KEY (`mathuonghieu`) REFERENCES `thuonghieu` (`mathuonghieu`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
