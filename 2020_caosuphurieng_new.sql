-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2024 at 08:58 AM
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
-- Table structure for table `lh_step`
--

CREATE TABLE `lh_step` (
                           `id` int(11) NOT NULL,
                           `tenbaiviet_vi` varchar(255) DEFAULT NULL,
                           `tenbaiviet_en` varchar(255) DEFAULT NULL,
                           `tenbaiviet_cn` varchar(255) DEFAULT NULL,
                           `p1_vi` varchar(255) DEFAULT NULL,
                           `p1_en` varchar(255) DEFAULT NULL,
                           `p1_cn` varchar(255) DEFAULT NULL,
                           `p2_vi` varchar(255) DEFAULT NULL,
                           `p2_en` varchar(255) DEFAULT NULL,
                           `p2_cn` varchar(255) DEFAULT NULL,
                           `p3_vi` mediumtext DEFAULT NULL,
                           `p3_en` mediumtext DEFAULT NULL,
                           `p3_cn` varchar(255) DEFAULT NULL,
                           `noidung_vi` mediumtext DEFAULT NULL,
                           `noidung_en` mediumtext DEFAULT NULL,
                           `noidung_cn` mediumtext DEFAULT NULL,
                           `seo_name` varchar(255) DEFAULT NULL,
                           `catasort` int(11) DEFAULT 0,
                           `step` tinyint(4) NOT NULL DEFAULT 0,
                           `ngaydang` int(11) NOT NULL DEFAULT 0,
                           `duongdantin` varchar(255) DEFAULT NULL,
                           `icon` varchar(255) DEFAULT NULL,
                           `seo_title_vi` varchar(255) DEFAULT NULL,
                           `seo_title_en` varchar(255) DEFAULT NULL,
                           `seo_title_cn` varchar(255) DEFAULT NULL,
                           `seo_description_vi` varchar(255) DEFAULT NULL,
                           `seo_description_en` varchar(255) DEFAULT NULL,
                           `seo_description_cn` varchar(255) DEFAULT NULL,
                           `seo_keywords_vi` varchar(255) DEFAULT NULL,
                           `seo_keywords_en` varchar(255) DEFAULT NULL,
                           `seo_keywords_cn` varchar(255) DEFAULT NULL,
                           `num_view` int(11) NOT NULL DEFAULT 0,
                           `opt` tinyint(1) NOT NULL DEFAULT 0,
                           `opt1` tinyint(1) NOT NULL DEFAULT 0,
                           `showhi` tinyint(1) NOT NULL DEFAULT 1,
                           `size_img` varchar(255) DEFAULT NULL,
                           `size_img_dm` varchar(255) DEFAULT NULL,
                           `map_google` mediumtext DEFAULT NULL,
                           `tenbaiviet_jp` varchar(255) DEFAULT NULL,
                           `p1_jp` varchar(255) DEFAULT NULL,
                           `p2_jp` varchar(255) DEFAULT NULL,
                           `p3_jp` varchar(255) DEFAULT NULL,
                           `noidung_jp` mediumtext DEFAULT NULL,
                           `seo_title_jp` varchar(255) DEFAULT NULL,
                           `seo_description_jp` varchar(255) DEFAULT NULL,
                           `seo_keywords_jp` varchar(255) DEFAULT NULL,
                           `mota` longtext DEFAULT NULL,
                           `noidung_vi_2` longtext DEFAULT NULL,
                           `mota2` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lh_step`
--

INSERT INTO `lh_step` (`id`, `tenbaiviet_vi`, `tenbaiviet_en`, `tenbaiviet_cn`, `p1_vi`, `p1_en`, `p1_cn`, `p2_vi`, `p2_en`, `p2_cn`, `p3_vi`, `p3_en`, `p3_cn`, `noidung_vi`, `noidung_en`, `noidung_cn`, `seo_name`, `catasort`, `step`, `ngaydang`, `duongdantin`, `icon`, `seo_title_vi`, `seo_title_en`, `seo_title_cn`, `seo_description_vi`, `seo_description_en`, `seo_description_cn`, `seo_keywords_vi`, `seo_keywords_en`, `seo_keywords_cn`, `num_view`, `opt`, `opt1`, `showhi`, `size_img`, `size_img_dm`, `map_google`, `tenbaiviet_jp`, `p1_jp`, `p2_jp`, `p3_jp`, `noidung_jp`, `seo_title_jp`, `seo_description_jp`, `seo_keywords_jp`, `mota`, `noidung_vi_2`, `mota2`) VALUES
(1, 'Giới thiệu', 'Introduce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', NULL, 'gioi-thieu', 1, 1, 1720432378, 'datafiles', '1719450580_01_about.jpg', 'Giới thiệu', 'Introduce', '', 'Giới thiệu', 'Introduce', '', 'Giới thiệu', 'Introduce', '', 0, 0, 0, 1, '500x500', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(2, 'Dịnh vụ', 'Product', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'dich-vu', 2, 4, 1720488748, 'datafiles', '1719450597_s_features_quote_bg.jpg', 'Dịnh vụ', 'Product', '', 'Dịnh vụ', 'Product', '', 'Dịnh vụ', 'Product', '', 10, 0, 0, 1, '500x500', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(11, 'Tài liệu kỹ thuật', 'Technical document', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tai-lieu-ky-thuat', 10, 7, 1589680932, 'datafiles', NULL, 'Tài liệu kỹ thuật', 'Technical document', '', 'Tài liệu kỹ thuật', 'Technical document', '', 'Tài liệu kỹ thuật', 'Technical document', '', 20, 0, 0, 1, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(4, 'Hệ thống quản lý văn bản', 'Document management system', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'he-thong-quan-ly-van-ban', 4, 35, 1589725422, 'datafiles', NULL, 'Hệ thống quản lý văn bản', 'Document management system', '', 'Hệ thống quản lý văn bản', 'Document management system', '', 'Hệ thống quản lý văn bản', 'Document management system', '', 20, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(13, 'Hình ảnh hoạt động', 'Active image', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hinh-anh-hoat-dong', 13, 6, 1589681989, 'datafiles', NULL, 'Hình ảnh hoạt động', 'Active image', '', 'Hình ảnh hoạt động', 'Active image', '', 'Hình ảnh hoạt động', 'Active image', '', 20, 0, 0, 0, '400x270', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(14, 'Văn bản', 'Document', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'van-ban', 14, 1, 1589682646, 'datafiles', NULL, 'Văn bản', 'Document', '', 'Văn bản', 'Document', '', 'Văn bản', 'Document', '', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(19, 'Sản phẩm', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'san-pham', 18, 2, 1720751027, 'datafiles', NULL, 'Sản phẩm', '', '', 'Sản phẩm', '', '', 'Sản phẩm', '', '', 0, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(6, 'Liên hệ', 'Contact', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'lien-he', 6, 5, 1719450244, 'datafiles', NULL, 'Liên hệ', 'Contact', '', 'Liên hệ', 'Contact', '', 'Liên hệ', 'Contact', '', 0, 0, 0, 1, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(7, 'Tin tức và sự kiện', 'News', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tin-tuc', 7, 3, 1720171197, 'datafiles', NULL, 'Tin tức và sự kiện', 'News', '', 'Tin tức và sự kiện', 'News', '', 'Tin tức và sự kiện', 'News', '', 15, 0, 0, 1, '400x270', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(8, 'Đối tác', 'Dependent units', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'doi-tac', 8, 12, 1720152342, 'datafiles', NULL, 'Đối tác', 'Dependent units', '', 'Đối tác', 'Dependent units', '', 'Đối tác', 'Dependent units', '', 15, 0, 0, 1, '400x270', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(16, 'popup_video', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'popup-video', 16, 36, 1719545708, 'datafiles', NULL, 'popup_video', '', '', 'popup_video', '', '', 'popup_video', '', '', 1, 0, 0, 1, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(10, 'Thư viện Video', 'Technical document', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'thu-vien-video', 11, 8, 1720152665, 'datafiles', NULL, 'Thư viện Video', 'Technical document', '', 'Thư viện Video', 'Technical document', '', 'Thư viện Video', 'Technical document', '', 20, 0, 0, 1, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(17, 'popup_liên_he', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'popup-lien-he', 17, 37, 1719545782, 'datafiles', NULL, 'popup_liên_he', '', '', 'popup_liên_he', '', '', 'popup_liên_he', '', '', 0, 0, 0, 1, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
(3, 'Thành tích', 'Achievements', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'thanh-tich', 3, 1, 1589680353, 'datafiles', NULL, 'Thành tích', 'Achievements', '', 'Thành tích', 'Achievements', '', 'Thành tích', 'Achievements', '', 0, 0, 0, 0, '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lh_step`
--
ALTER TABLE `lh_step`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lh_step`
--
ALTER TABLE `lh_step`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;