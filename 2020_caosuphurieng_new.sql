-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2024 at 09:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2020_caosuphurieng1`
--

-- --------------------------------------------------------

--
-- Table structure for table `lh_seo`
--

CREATE TABLE `lh_seo` (
                          `id` int(11) NOT NULL,
                          `seo_title_vi` varchar(255) DEFAULT NULL,
                          `seo_description_vi` varchar(255) DEFAULT NULL,
                          `seo_keywords_vi` varchar(255) DEFAULT NULL,
                          `seo_title_en` varchar(255) DEFAULT NULL,
                          `seo_description_en` varchar(255) DEFAULT NULL,
                          `seo_keywords_en` varchar(255) DEFAULT NULL,
                          `seo_title_cn` varchar(255) DEFAULT NULL,
                          `seo_description_cn` varchar(255) DEFAULT NULL,
                          `seo_keywords_cn` varchar(255) DEFAULT NULL,
                          `duongdantin` varchar(255) DEFAULT NULL,
                          `icon` varchar(255) DEFAULT NULL,
                          `favico` varchar(255) DEFAULT NULL,
                          `robots` mediumtext DEFAULT NULL,
                          `tenbaiviet_vi` varchar(255) DEFAULT NULL,
                          `tenbaiviet_en` varchar(255) DEFAULT NULL,
                          `tenbaiviet_cn` varchar(255) DEFAULT NULL,
                          `sodienthoai_vi` varchar(255) DEFAULT NULL,
                          `diachi_vi` varchar(255) DEFAULT NULL,
                          `diachi_en` varchar(255) DEFAULT NULL,
                          `diachi_cn` varchar(255) DEFAULT NULL,
                          `hotline_vi` varchar(255) DEFAULT NULL,
                          `email_vi` varchar(255) DEFAULT NULL,
                          `em_ip` varchar(255) DEFAULT NULL,
                          `em_taikhoan` varchar(255) DEFAULT NULL,
                          `em_pass` varchar(255) DEFAULT NULL,
                          `js_google_anilatic` mediumtext DEFAULT NULL,
                          `khoa_website` mediumtext DEFAULT NULL,
                          `is_khoasite` tinyint(4) NOT NULL DEFAULT 0,
                          `is_https` tinyint(1) NOT NULL DEFAULT 0,
                          `fb_app` varchar(255) DEFAULT NULL,
                          `fb_id` varchar(255) DEFAULT NULL,
                          `is_comment` tinyint(4) NOT NULL DEFAULT 0,
                          `is_lang` tinyint(4) NOT NULL DEFAULT 0,
                          `is_saochep` tinyint(1) NOT NULL DEFAULT 0,
                          `is_tiengviet` tinyint(1) NOT NULL DEFAULT 1,
                          `menu_hinhanh` tinyint(4) NOT NULL DEFAULT 0,
                          `menu_hinhanh_size` varchar(50) DEFAULT NULL,
                          `menu_hinhanh_hv` tinyint(4) NOT NULL DEFAULT 0,
                          `menu_danhmuc` tinyint(4) NOT NULL DEFAULT 0,
                          `menu_kieuhienthi` tinyint(4) NOT NULL DEFAULT 0,
                          `show_fb` tinyint(1) NOT NULL DEFAULT 0,
                          `url_fb` varchar(255) DEFAULT NULL,
                          `show_zalo` tinyint(1) NOT NULL DEFAULT 0,
                          `url_zalo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lh_seo`
--

INSERT INTO `lh_seo` (`id`, `seo_title_vi`, `seo_description_vi`, `seo_keywords_vi`, `seo_title_en`, `seo_description_en`, `seo_keywords_en`, `seo_title_cn`, `seo_description_cn`, `seo_keywords_cn`, `duongdantin`, `icon`, `favico`, `robots`, `tenbaiviet_vi`, `tenbaiviet_en`, `tenbaiviet_cn`, `sodienthoai_vi`, `diachi_vi`, `diachi_en`, `diachi_cn`, `hotline_vi`, `email_vi`, `em_ip`, `em_taikhoan`, `em_pass`, `js_google_anilatic`, `khoa_website`, `is_khoasite`, `is_https`, `fb_app`, `fb_id`, `is_comment`, `is_lang`, `is_saochep`, `is_tiengviet`, `menu_hinhanh`, `menu_hinhanh_size`, `menu_hinhanh_hv`, `menu_danhmuc`, `menu_kieuhienthi`, `show_fb`, `url_fb`, `show_zalo`, `url_zalo`) VALUES
(1, 'CÔNG TY CỔ PHẦN VẬN TẢI BIỂN CONTAINER THÁI BÌNH DƯƠNG', 'CÔNG TY CỔ PHẦN VẬN TẢI BIỂN CONTAINER THÁI BÌNH DƯƠNG', 'CÔNG TY CỔ PHẦN VẬN TẢI BIỂN CONTAINER THÁI BÌNH DƯƠNG', 'PACIFIC CONTAINER SHIPPING JOINT STOCK COMPANY', 'PACIFIC CONTAINER SHIPPING JOINT STOCK COMPANY', 'PACIFIC CONTAINER SHIPPING JOINT STOCK COMPANY', '', '', '', 'datafiles', '/2024_template_user_guide/datafiles/images/02_about.jpg', '1', '', 'CÔNG TY CỔ PHẦN VẬN TẢI BIỂN CONTAINER THÁI BÌNH DƯƠNG', 'PACIFIC CONTAINER SHIPPING JOINT STOCK COMPANY', '', '', 'Tầng 15 Tòa tháp Hòa Bình, 106 Hoàng Quốc Việt, Nghĩa Đô, Cầu Giấy, Hà Nội', '15th Floor, Hoa Binh Tower, 106 Hoang Quoc Viet, Nghia Do, Cau Giay, Hanoi', '', '', '', '', '', '', '', '', 0, 0, '', '', 1, 1, 0, 1, 0, '(100px x 100px)', 0, 0, 1, 1, '', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lh_seo`
--
ALTER TABLE `lh_seo`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lh_seo`
--
ALTER TABLE `lh_seo`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;