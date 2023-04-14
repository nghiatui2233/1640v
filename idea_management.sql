-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 08, 2023 lúc 06:24 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `idea_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_account`
--

CREATE TABLE `tbl_account` (
  `account_Id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `department_Id` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_account`
--

INSERT INTO `tbl_account` (`account_Id`, `fullname`, `email`, `gender`, `date_of_birth`, `address`, `phone`, `password`, `department_Id`, `role`) VALUES
(1, 'Nghia', 'nghia@gmail.com', 'Male', '2023-03-27', 'TP.Can Tho', '021352876', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(2, 'Duong Vu Tuong', 'staff@gmail.com', '', '2023-04-03', '', '', 'e10adc3949ba59abbe56e057f20f883e', 1, 0),
(3, 'Quan Vinh', 'vinh@gmail.com', '', '2023-04-03', '', '', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(5, 'Nhan', 'nhan@gmail.com', 'Other', '0000-00-00', 'TP.Can Tho', '0215781', 'e10adc3949ba59abbe56e057f20f883e', 1, 0),
(6, 'Dat', 'dat@gmail.com', 'Male', '0000-00-00', 'TP.Can Tho', '0125485220', 'e10adc3949ba59abbe56e057f20f883e', 0, 0),
(7, 'staff1', 'nghiatui2233@gmail.com', 'FeMale', '2023-04-05', 'TP.Can Tho', '0125485220', 'e10adc3949ba59abbe56e057f20f883e', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_Id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`category_Id`, `categoryName`) VALUES
(1, 'Event'),
(2, 'Opinions about teaching'),
(3, 'Infrastructure'),
(4, 'Club'),
(5, 'Workshop');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_Id` int(11) NOT NULL,
  `content` text NOT NULL,
  `feedback_Id` int(11) NOT NULL,
  `date_comment` date NOT NULL DEFAULT current_timestamp(),
  `account_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_Id`, `content`, `feedback_Id`, `date_comment`, `account_Id`) VALUES
(10, 'may noi qua dung luon', 24, '2023-04-07', 1),
(11, 'tao cung nghi vay', 24, '2023-04-07', 1),
(12, 'tru luong', 24, '2023-04-07', 7),
(13, 'tao da thay', 24, '2023-04-07', 7),
(14, 'chuẩn bị thất nghiệp hết nhe!', 24, '2023-04-07', 7),
(16, 'âssssssssssssssss', 17, '2023-04-07', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_Id` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_department`
--

INSERT INTO `tbl_department` (`department_Id`, `departmentName`) VALUES
(0, 'Bussiness'),
(1, 'Computer');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_Id` int(11) NOT NULL,
  `post_Id` int(11) DEFAULT NULL,
  `department_Id` int(11) DEFAULT NULL,
  `file` longblob DEFAULT NULL,
  `date_submited` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `feedback` text DEFAULT NULL,
  `likes` bigint(20) DEFAULT NULL,
  `liked_by` text NOT NULL,
  `account_Id` int(11) DEFAULT NULL,
  `anonymous` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_feedback`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_idea`
--

CREATE TABLE `tbl_idea` (
  `idea_Id` int(11) NOT NULL,
  `content` text NOT NULL,
  `thumb_up` bigint(20) NOT NULL,
  `thumb_down` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_Id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_Id` int(11) NOT NULL,
  `department_Id` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_ending` datetime NOT NULL,
  `content` text NOT NULL,
  `account_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_post`
--

INSERT INTO `tbl_post` (`post_Id`, `title`, `category_Id`, `department_Id`, `date_create`, `date_ending`, `content`, `account_Id`) VALUES
(28, 'aaaaaaaa', 2, 1, '2023-04-04 04:30:09', '2023-04-12 11:30:00', 'ssssssssssssss', 1),
(29, 'hhhhhhhh', 2, 1, '2023-04-04 04:30:47', '2023-04-19 11:30:00', 'aaaaaaaaaaaaaaaaaaaaaaa', 1),
(30, 'âsas', 1, 1, '2023-04-06 08:30:37', '2023-04-06 15:30:00', 'aaaaaaaaaaaa', 1),
(31, '31', 3, 1, '2023-04-06 08:42:14', '2023-04-06 15:42:00', '31', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_Id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `gender` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `position` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thumbup`
--

CREATE TABLE `tbl_thumbup` (
  `thumbUp_Id` int(11) NOT NULL,
  `account_Id` int(11) NOT NULL,
  `feedback_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`account_Id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_Id`);

--
-- Chỉ mục cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_Id`);

--
-- Chỉ mục cho bảng `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_Id`);

--
-- Chỉ mục cho bảng `tbl_idea`
--
ALTER TABLE `tbl_idea`
  ADD PRIMARY KEY (`idea_Id`);

--
-- Chỉ mục cho bảng `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_Id`);

--
-- Chỉ mục cho bảng `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_Id`);

--
-- Chỉ mục cho bảng `tbl_thumbup`
--
ALTER TABLE `tbl_thumbup`
  ADD PRIMARY KEY (`thumbUp_Id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `account_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `tbl_idea`
--
ALTER TABLE `tbl_idea`
  MODIFY `idea_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `post_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staff_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_thumbup`
--
ALTER TABLE `tbl_thumbup`
  MODIFY `thumbUp_Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
