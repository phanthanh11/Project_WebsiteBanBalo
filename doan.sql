-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th1 17, 2024 lúc 09:28 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hoa_don_id` bigint(20) UNSIGNED NOT NULL,
  `san_pham_id` bigint(20) UNSIGNED NOT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 0,
  `don_gia` double NOT NULL,
  `thanh_tien` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_hoa_don`
--

INSERT INTO `chi_tiet_hoa_don` (`id`, `hoa_don_id`, `san_pham_id`, `so_luong`, `don_gia`, `thanh_tien`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 7, 6, 1, 765000, 765000, '2023-12-12 07:37:02', '2023-12-12 07:37:02', NULL),
(7, 6, 5, 1, 720000, 720000, '2023-12-12 07:17:28', '2023-12-12 07:17:28', NULL),
(6, 6, 6, 2, 765000, 1530000, '2023-12-12 07:17:28', '2023-12-12 07:17:28', NULL),
(12, 11, 6, 2, 765000, 1530000, '2023-12-15 21:23:57', '2023-12-15 21:23:57', NULL),
(11, 10, 3, 2, 540000, 1080000, '2023-12-15 21:20:32', '2023-12-15 21:20:32', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_sp`
--

CREATE TABLE `chi_tiet_sp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `san_pham_id` bigint(20) UNSIGNED NOT NULL,
  `loai_sp_id` bigint(20) UNSIGNED NOT NULL,
  `nha_sx_id` bigint(20) UNSIGNED NOT NULL,
  `ten_sp` varchar(255) NOT NULL,
  `gia` varchar(50) NOT NULL,
  `chat_lieu` varchar(100) DEFAULT NULL,
  `so_ngan` varchar(100) DEFAULT NULL,
  `mau_sac` varchar(50) DEFAULT NULL,
  `khoi_luong` varchar(100) DEFAULT NULL,
  `kich_thuoc` varchar(100) DEFAULT NULL,
  `tai_trong` varchar(100) DEFAULT NULL,
  `ngan_lap` varchar(100) DEFAULT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 0,
  `giam_gia` varchar(10) NOT NULL DEFAULT '0',
  `hinh_anh` longtext DEFAULT NULL,
  `mo_ta` longtext DEFAULT NULL,
  `link_youtube` varchar(100) DEFAULT NULL,
  `new` int(11) NOT NULL DEFAULT 0,
  `tinh_trang` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_sp`
--

INSERT INTO `chi_tiet_sp` (`id`, `san_pham_id`, `loai_sp_id`, `nha_sx_id`, `ten_sp`, `gia`, `chat_lieu`, `so_ngan`, `mau_sac`, `khoi_luong`, `kich_thuoc`, `tai_trong`, `ngan_lap`, `so_luong`, `giam_gia`, `hinh_anh`, `mo_ta`, `link_youtube`, `new`, `tinh_trang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Balo Laptop Sành Điệu AVAR BOP AI751 - Black', '900000', 'Oxford Textile mật độ cao + Polyester fabric', '1 ngăn chính - nhiều ngăn phụ', 'Black', '1.1', '45 x 30 x 15', '15', '15.6', 0, '0', '[\"balo-laptop-mikkor-ralph-red-2 (1).jpg\",\"balo-laptop-mikkor-ralph-red-6.jpg\",\"balo-laptop-mikkor-ralph-red-7.jpg\",\"balo-laptop-mikkor-ralph-red-5.jpg\",\"balo-laptop-mikkor-ralph-red-2.jpg\",\"balo-laptop-mikkor-ralph-red-3.jpg\",\"balo-laptop-mikkor-ralph-red-4.jpg\",\"balo-laptop-mikkor-the-hopkins-black-3.jpg\"]', 'Đẹp và phong cách', NULL, 0, 0, '2023-09-12 08:06:57', '2023-12-31 06:13:50', '2023-12-31 06:13:50'),
(2, 2, 1, 2, 'Balo Laptop Mikkor Ralph - Navy', '600000', 'Vải hoàn toàn mới chống thấm', '1 ngăn laptop - 1 ngăn chính - nhiều ngăn phụ nhỏ', 'Navy', '0.5', '26 x 12 x 4', '20', '15.6', 0, '20', '[\"balo-laptop-mikkor-ralph-navy-6.jpg\",\"balo-laptop-mikkor-ralph-navy-1.jpg\",\"balo-laptop-mikkor-ralph-navy-5.jpg\",\"balo-laptop-mikkor-ralph-navy-2.jpg\",\"balo-laptop-mikkor-ralph-navy-4.jpg\",\"balo-laptop-mikkor-ralph-navy-3.jpg\"]', 'Đẹp và phong cách', NULL, 0, 0, '2023-12-10 04:08:55', '2023-12-31 06:08:00', '2023-12-31 06:08:00'),
(3, 3, 1, 2, 'Balo Laptop Mikkor Ralph - Graphite', '600000', 'vải hoàn toàn mới chống thấm', '1 ngăn laptop - 1 ngăn chính - nhiều ngăn phụ nhỏ', 'Graphite', '0.5', '26 x 12 x 40', '20', '15.6', 2, '10', '[\"balo-laptop-mikkor-ralph-d-grey-1.jpg\",\"balo-laptop-mikkor-ralph-d-grey-2.jpg\",\"balo-laptop-mikkor-ralph-d-grey-5.jpg\",\"balo-laptop-mikkor-ralph-d-grey-6.jpg\",\"balo-laptop-mikkor-ralph-d-grey-4.jpg\",\"balo-laptop-mikkor-ralph-d-grey-3.jpg\"]', 'Đẹp và phong cách', NULL, 1, 0, '2023-12-10 04:30:53', '2023-12-31 06:13:31', '2023-12-31 06:13:31'),
(5, 5, 2, 1, 'Balo Du Lịch SimpleCarry Mattan 6 - Navy', '800000', 'Polyester trượt nước', '1 ngăn lớn và 2 ngăn phụ kiện', 'Navy', '1', '52 x 30 x 20', '35', '18', 4, '10', '[\"balo-du-lich-simplecarry-mattan-6-grey-2.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-1.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-3.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-7.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-6.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-4.jpg\",\"balo-du-lich-simplecarry-mattan-6-grey-5.jpg\"]', 'Đẹp và chất', NULL, 0, 0, '2023-12-10 22:54:02', '2023-12-31 06:13:35', '2023-12-31 06:13:35'),
(6, 6, 2, 1, 'Balo Du Lịch Đa Năng REEYEE - BLACK', '850000', 'Oxford Textile mật độ cao + Polyester fabric', '1 ngăn chính - nhiều ngăn phụ', 'BLACK', '1.2', '52 x 31 x 19', '15', '15.6', 1, '10', '[\"balo-du-lich-da-nang-reeyee-ry1052-1.jpg\",\"balo-du-lich-da-nang-reeyee-ry1052-3.jpg\",\"balo-du-lich-da-nang-reeyee-ry1052-2.jpg\"]', 'Chuẩn', NULL, 1, 0, '2023-12-15 23:01:03', '2023-12-31 06:14:40', '2023-12-31 06:14:40'),
(7, 7, 1, 2, 'Balo Laptop Sang Trọng MARK RYDEN MR9813 - Black', '800000', 'Oxford Textile mật độ cao + Polyester fabric', '1 ngăn chính - nhiều ngăn phụ', 'Black', '0.75', '43 x 30 x 10', '10', '15.6', 20, '0', '[\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-6.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-1.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-5.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-3.jpg\",\"balo-laptop-sang-trong-mark-ryden-mr-9813-black-8.jpg\"]', 'New', 'Gv5a70e6FDk', 1, 0, '2023-12-12 03:23:23', '2023-12-31 06:38:46', NULL),
(8, 8, 1, 3, 'Balo Laptop Sakos Guardian i14 - Red', '860000', 'Polyester PE PU', '1 ngăn chính - 1 ngăn laptop - nhiều ngăn phụ', 'Red', '1.1', '30x18x44', '15', '15.6', 20, '25', '[\"balo-laptop-sakos-guardian-red-5 (1).png\",\"balo-laptop-sakos-guardian-red-2 (1).png\",\"balo-laptop-sakos-guardian-red-1 (1).png\",\"balo-laptop-sakos-guardian-red-4 (1).png\",\"balo-laptop-sakos-guardian-red-2.png\"]', 'Đẹp và phong cách dành cho sinh viên dùng laptop', NULL, 0, 0, '2023-12-12 04:05:51', '2023-12-12 04:38:59', NULL),
(9, 9, 3, 3, 'Balo Thời Trang Sakos Neo Sparkle USA - Pink', '640000', 'Polyester trượt nước', '1 ngăn chính - 1 ngăn phụ', 'Pink', '0.41', '42x31x13', '10', '14', 20, '0', '[\"balo-thoi-trang-sakos-neo-sparkley-1.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-4.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-2.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-5.jpg\",\"balo-thoi-trang-sakos-neo-sparkley-3.jpg\"]', 'Balo đẹp dành cho nữ và phù hợp với Genz', NULL, 0, 0, '2023-12-12 04:13:06', '2023-12-12 04:38:49', NULL),
(10, 10, 1, 4, 'Balo Laptop SimpleCarry B2B17 i15 - Blue', '590000', 'Polyester trượt nước', '2 ngăn chính - 1 ngăn phụ', 'Blue', '0.7', '28x10x43', '25', '15.6', 20, '0', '[\"balo-laptop-simplecarry-b2b17-i15-navy-1.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-5.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-3.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-2.jpg\",\"balo-laptop-simplecarry-b2b17-i15-navy-4.jpg\"]', 'Đẹp', NULL, 0, 0, '2023-12-12 04:22:56', '2023-12-12 04:39:22', NULL),
(11, 11, 9, 4, 'Túi trống thể thao du lịch Simplecarry SD3', '520000', 'Polyester trượt nước', '3', 'Nhiều màu', '0.6', '52x29x32', '35', '0', 5, '10', '[\"tui-xach-the-thao sc1.jpg\",\"tui-xach-the-thao-s3.jpg\",\"tui-xach-the-thao-sc2.jpg\"]', 'túi xách du lịch', NULL, 0, 0, '2023-12-31 06:07:24', '2023-12-31 06:07:24', NULL),
(12, 12, 3, 4, 'Balo thời trang Simplecarry Kantan', '299000', 'Vải Polyester chống bám bụi, chống thấm nước', '2', 'Nhiều màu', '0.5', '43 x 34 x 18', '15', '1', 4, '10', '[\"simplecarry1.jpeg\",\"simplecarry2.jpg\",\"simplecarry3.jpg\"]', 'balo thời trang đẹp', NULL, 0, 0, '2023-12-31 06:10:07', '2023-12-31 06:10:07', NULL),
(13, 13, 1, 7, 'Balo laptop Parkland WestPort', '650000', '100% polyester tái chế', '3', 'Xanh rêu', '1,1', '43 x 34 x 18', '25', '2', 2, '10', '[\"20230816_8OAV3motdp.jpeg\",\"20230816_K8gdOYsxst.jpeg\",\"20230816_PtaiZ2tRTU.jpeg\",\"20230816_tW8cpHojUs.jpeg\"]', 'Balo parkland', NULL, 0, 0, '2023-12-31 06:35:10', '2023-12-31 06:35:51', NULL),
(14, 14, 14, 8, 'Vali nhôm nguyên khối RS1807', '3000000', 'Nhôm nguyên khối', '2', 'Đen', '4.5', '67x42x26', '35', '0', 3, '10', '[\"vali-nhom-rs1807-24-inch-m-black-1.jpg\",\"vali-nhom-rs1807-24-inch-m-black-2.jpg\",\"vali-nhom-rs1807-24-inch-m-black-3.jpg\",\"vali-nhom-rs1807-24-inch-m-black-4.jpg\",\"vali-nhom-rs1807-24-inch-m-black-5.jpg\"]', 'Vali cao cấp', NULL, 0, 0, '2023-12-31 06:44:54', '2023-12-31 06:45:41', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chi_tiet_sp_id` bigint(20) UNSIGNED NOT NULL,
  `diem` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_hd` varchar(255) NOT NULL,
  `khach_hang_id` bigint(20) UNSIGNED NOT NULL,
  `tong_tien` double NOT NULL,
  `ngay_dat` datetime NOT NULL,
  `dia_chi_nhan` varchar(255) NOT NULL,
  `hinh_thuc_thanh_toan` varchar(100) DEFAULT NULL,
  `ghi_chu` varchar(255) DEFAULT NULL,
  `tinh_trang` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `ma_hd`, `khach_hang_id`, `tong_tien`, `ngay_dat`, `dia_chi_nhan`, `hinh_thuc_thanh_toan`, `ghi_chu`, `tinh_trang`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'HD2023-12-10 14:17:28', 54, 2250000, '2023-12-10 14:17:28', 'Số 129+131 Lê Thanh Nghị – Hai Bà Trưng – Hà Nội', NULL, 'OK', 'Đã duyệt', '2023-09-10 07:17:28', '2023-12-31 01:36:00', NULL),
(7, 'HD2023-12-10 14:37:02', 55, 765000, '2023-12-10 14:37:02', 'Số 43 Thái Hà – Đống Đa – Hà Nội', NULL, 'aaa', 'Đã duyệt', '2023-12-10 07:37:02', '2024-01-17 18:08:39', NULL),
(8, 'HD2023-12-16 04:14:11', 56, 540000, '2023-12-16 04:14:11', ' A1-6 Lô 8A – Lê Hồng Phong – Ngô Quyền – Hải Phòng', NULL, 'OK', 'Đang duyệt', '2023-12-15 21:14:11', '2023-12-15 21:14:11', NULL),
(9, 'HD2023-12-16 04:20:32', 57, 1080000, '2023-12-16 04:20:32', 'Số 398 Nguyễn Văn Cừ – Long Biên – Hà Nội', NULL, 'Ok', 'Đang duyệt', '2023-12-15 21:20:32', '2023-12-15 21:20:32', NULL),
(10, 'HD2023-12-16 04:23:57', 56, 1530000, '2023-12-16 04:23:57', 'Số 520 Cách Mạng Tháng Tám – Quận 3 – TP. Hồ Chí Minh', NULL, 'OK', 'Đang duyệt', '2023-12-15 21:23:57', '2023-12-15 21:23:57', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `vai_tro_id` int(10) UNSIGNED NOT NULL,
  `google_id` varchar(30) DEFAULT NULL,
  `provider_id` varchar(50) DEFAULT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `ten` varchar(50) DEFAULT NULL,
  `sdt` varchar(10) DEFAULT NULL,
  `dia_chi` varchar(100) DEFAULT NULL,
  `gioi_tinh` varchar(100) DEFAULT NULL,
  `hinh_dai_dien` varchar(255) DEFAULT NULL,
  `bi_khoa` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `email`, `password`, `vai_tro_id`, `google_id`, `provider_id`, `provider`, `ten`, `sdt`, `dia_chi`, `gioi_tinh`, `hinh_dai_dien`, `bi_khoa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(54, 'tuyendk9999@gmail.com', '$2y$10$mbj91xDjD..pQQZkV.ppXOfZGg.h4tYr1QCgJcXuilmFI2Jx1mTcS', 1, NULL, NULL, NULL, 'Nguyễn Du', '0343123456', NULL, NULL, NULL, 0, '2023-12-10 07:03:57', '2023-12-31 01:23:31', '2023-12-31 01:23:31'),
(55, 'tuyen01@gmai.com', NULL, 1, NULL, NULL, NULL, 'Nguyễn Khánh', '0121212121', NULL, 'Nam', NULL, 0, '2023-12-10 07:37:02', '2023-12-10 07:37:02', NULL),
(56, 'tuyenzt69@gmail.com', '$2y$10$WjAYiUjfHXTwuraZz5yXaeSUXkSxlVKMVPKvQmacbChFg3.x5s1VS', 1, NULL, NULL, NULL, 'Dương Quá', '0999999999', NULL, NULL, NULL, 1, '2023-12-15 21:13:08', '2023-12-31 09:50:20', NULL),
(57, 'tuyen02@gmail.com', NULL, 1, NULL, NULL, NULL, 'Tiểu Long Nữ', '0935356789', NULL, 'Nam', NULL, 0, '2023-12-15 21:20:32', '2023-12-15 21:20:32', NULL),
(58, 'tuyenphung99@gmail.com', '$2y$10$K0tUhn/hO7XozUySh53PBuzjHBXr6.wTPIn49V/xeLjXOUMDIe0s.', 1, NULL, NULL, NULL, 'Trương Vô Kỵ', '0123456789', 'địa chỉ số 1', 'Nam', '1703985925.jpg', 0, '2023-12-31 01:24:35', '2023-12-31 01:25:42', NULL),
(59, 'tuyenphung01@gmail.com', '$2y$10$iHfyVsp9aJ7V48AknxWaeu6OlJIOOV1IX4VUOuWEL07v/eP3ZQXZO', 1, NULL, NULL, NULL, 'Tạ Tốn', '0123353535', 'địa chỉ số 2', 'Nữ', '1705516362.jpg', 0, '2024-01-17 18:31:53', '2024-01-17 18:32:58', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sp`
--

CREATE TABLE `loai_sp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_sp`
--

INSERT INTO `loai_sp` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Balo Laptop', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(2, 'Balo du lịch', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(3, 'Balo thời trang', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(4, 'Balo học sinh', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(5, 'Balo da', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(6, 'Balo chống nước', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(7, 'Túi xách nam', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(8, 'Túi xách nữ', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(9, 'Túi xách du lịch', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(10, 'Túi xách thời trang', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(11, 'Túi xách chống sốc', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(12, 'Túi xách máy ảnh', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(13, 'Vali kéo trẻ em', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL),
(14, 'Vali du lich', '2023-12-06 10:00:00', '2023-12-06 10:00:00', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nha_san_xuat`
--

CREATE TABLE `nha_san_xuat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nha_san_xuat`
--

INSERT INTO `nha_san_xuat` (`id`, `ten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AVAR', '2023-12-08 08:03:14', '2023-12-08 08:03:14', NULL),
(2, 'Mikor', '2023-12-08 08:03:26', '2023-12-08 08:03:26', NULL),
(3, 'SAKOS', '2023-12-12 03:58:17', '2023-12-12 03:58:17', NULL),
(4, 'SimpleCarry', '2023-12-12 04:14:35', '2023-12-12 04:14:35', NULL),
(5, 'Larvender', '2023-12-31 01:15:29', '2023-12-31 01:15:29', NULL),
(6, 'Sharon', '2023-12-31 06:15:48', '2023-12-31 06:15:48', NULL),
(7, 'Parkland', '2023-12-31 06:31:02', '2023-12-31 06:31:02', NULL),
(8, 'OEM', '2023-12-31 06:41:47', '2023-12-31 06:41:47', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quan_tri_vien`
--

CREATE TABLE `quan_tri_vien` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ten_tai_khoan` varchar(30) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `vai_tro_id` int(10) UNSIGNED NOT NULL,
  `ten` varchar(50) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `sdt` varchar(10) DEFAULT NULL,
  `bi_khoa` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quan_tri_vien`
--

INSERT INTO `quan_tri_vien` (`id`, `ten_tai_khoan`, `mat_khau`, `vai_tro_id`, `ten`, `email`, `sdt`, `bi_khoa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '$2y$10$6e4IgiK6qH047Guh2zOPuOuJXu0vzhXLUN7xiEUmLrAwlAoJuFIMK', 1, 'Quản trị viên', NULL, NULL, 0, '2023-12-12 08:00:23', '2023-12-12 08:00:23', NULL),
(6, 'user', '123456', 2, 'Tuyên Phùng', 'user@gmail.com', '0123456789', 0, '2023-12-12 07:39:40', '2024-01-15 09:55:42', '2024-01-15 09:55:42'),
(7, 'PVT', '123456', 2, 'Tuyên Phùng', 'tuyendk9999@gmail.com', '0328730391', 0, '2023-12-31 09:45:16', '2023-12-31 09:45:16', NULL),
(8, 'KCC', '$2y$10$9hYjUHM9wRarCwO0MQzJu.dtlL8BBukrX1KHMRAIBhivMcIj5LA.i', 2, 'Sharon', 'vantuyen.phung0912@gmail.com', '0323123456', 1, '2024-01-15 09:55:03', '2024-01-15 09:55:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ma_sp` varchar(255) NOT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id`, `ma_sp`, `hinh_anh`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Balo01', 'balo-laptop-mikkor-ralph-red-2 (1).jpg', '2023-12-08 08:06:57', '2023-12-31 06:13:50', '2023-12-31 06:13:50'),
(2, 'Balo02', 'balo-laptop-mikkor-ralph-navy-6.jpg', '2023-12-10 04:08:55', '2023-12-31 06:08:00', '2023-12-31 06:08:00'),
(3, 'Balo03', 'balo-laptop-mikkor-ralph-d-grey-1.jpg', '2023-12-10 04:30:53', '2023-12-31 06:13:31', '2023-12-31 06:13:31'),
(5, 'Balo04', 'balo-du-lich-simplecarry-mattan-6-grey-2.jpg', '2023-12-10 22:54:02', '2023-12-31 06:13:35', '2023-12-31 06:13:35'),
(6, 'Balo05', 'balo-du-lich-da-nang-reeyee-ry1052-1.jpg', '2023-12-10 23:01:03', '2023-12-31 06:14:40', '2023-12-31 06:14:40'),
(7, 'BaloMark', 'balo-laptop-sang-trong-mark-ryden-mr-9813-black-6.jpg', '2023-12-16 03:23:23', '2023-12-16 03:23:24', NULL),
(8, 'Balosakos', 'balo-laptop-sakos-guardian-red-5 (1).png', '2023-12-18 04:05:51', '2023-12-18 04:05:51', NULL),
(9, 'Balosako01', 'balo-thoi-trang-sakos-neo-sparkley-1.jpg', '2023-12-18 04:13:06', '2023-12-18 04:13:06', NULL),
(10, 'BaloSC01', 'balo-laptop-simplecarry-b2b17-i15-navy-1.jpg', '2023-11-18 04:22:56', '2023-11-18 04:22:56', NULL),
(11, 'tuixach01', 'tui-xach-the-thao sc1.jpg', '2023-12-31 06:07:24', '2023-12-31 06:07:24', NULL),
(12, 'Balo06', 'simplecarry1.jpeg', '2023-12-31 06:10:07', '2023-12-31 06:10:07', NULL),
(13, 'Balo07', '20230816_8OAV3motdp.jpeg', '2023-12-31 06:35:10', '2023-12-31 06:35:11', NULL),
(14, 'ValiCC01', 'vali-nhom-rs1807-24-inch-m-black-1.jpg', '2023-12-31 06:44:54', '2023-12-31 06:45:41', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `link`, `image`, `created_at`, `updated_at`, `position`) VALUES
(10, '326459119_557486462950400_7954390709342763808_n.jpg', '326459119_557486462950400_7954390709342763808_n.jpg', '2023-12-31 01:26:24', '2024-01-15 10:24:56', 2),
(9, 'slide_1_balo.png', 'slide_1_balo.png', '2023-12-31 01:26:14', '2024-01-15 10:24:56', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vai_tro`
--

CREATE TABLE `vai_tro` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vai_tro`
--

INSERT INTO `vai_tro` (`id`, `ten`, `created_at`, `updated_at`) VALUES
(1, 'Quản trị viên', '2023-12-08 08:00:22', '2023-12-08 08:00:22'),
(2, 'Nhân viên', '2023-12-08 08:00:22', '2023-12-08 08:00:22'),
(3, 'Khách hàng', '2023-12-08 08:00:22', '2023-12-08 08:00:22');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_sp`
--
ALTER TABLE `chi_tiet_sp`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `khach_hang_email_unique` (`email`);

--
-- Chỉ mục cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nha_san_xuat`
--
ALTER TABLE `nha_san_xuat`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quan_tri_vien`
--
ALTER TABLE `quan_tri_vien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `vai_tro`
--
ALTER TABLE `vai_tro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_sp`
--
ALTER TABLE `chi_tiet_sp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `nha_san_xuat`
--
ALTER TABLE `nha_san_xuat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `quan_tri_vien`
--
ALTER TABLE `quan_tri_vien`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `vai_tro`
--
ALTER TABLE `vai_tro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
