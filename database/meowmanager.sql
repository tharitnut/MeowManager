-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2025 at 07:53 AM
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
-- Database: `meowmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cats`
--

CREATE TABLE `tbl_cats` (
  `cat_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ',
  `cat_name` varchar(50) NOT NULL COMMENT 'ชื่อของแมว',
  `breed` varchar(50) NOT NULL COMMENT 'สายพันธ์ของแมว',
  `age` int(3) NOT NULL COMMENT 'อายุของแมว',
  `health_status` text NOT NULL COMMENT 'สุขภาพของแมว',
  `cat_pic` varchar(255) NOT NULL COMMENT 'รูปภาพของแมว',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล\r\n(อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cats`
--

INSERT INTO `tbl_cats` (`cat_id`, `cat_name`, `breed`, `age`, `health_status`, `cat_pic`, `timestamp`) VALUES
(1, 'Asteroid Destroyer', 'Persian', 3, 'Good', 'uploads/cat/94zilNAnYtGUbeiOUql5J2BQeDTicTR5QSMXlZxH.jpg', '2025-09-17 20:56:47'),
(2, 'Simba', 'Domestic Shorthair', 5, 'Sleepy 24/7', 'uploads/cat/QBiuRy4kmjJgaopil6rt8rKhuw7O9sL1PZSZ2mNL.jpg', '2025-09-17 21:46:26'),
(3, 'Pixel', 'Domestic Shorthair', 3, 'Zoom', 'uploads/cat/NR8ZEljL8lLQfx7nCtj5uWthVb5xL7qmwDChwjHK.jpg', '2025-09-17 21:47:02'),
(4, 'Bella', 'Scottish Fold', 6, 'Good', 'uploads/cat/QOf5hLjXQe7lKVyeDHeogLR7yGytqE4SBRCqfURz.jpg', '2025-09-17 21:02:52'),
(5, 'Milo', 'Domestic Shorthair', 2, 'Good', 'uploads/cat/06i18AKnOfZF19IwODsCKOcRXg29UOOvzzYqkWPO.jpg', '2025-09-17 21:03:19'),
(6, 'Smokey', 'British Shorthair', 1, 'Good', 'uploads/cat/QOmrFfbFi2cPY8Xf3bb9Mbpn3OQLeIZXJSRx7E1p.jpg', '2025-09-17 21:11:27'),
(7, 'Cloudy', 'Persian', 1, 'Good', 'uploads/cat/sIKpZi9LMWYlK7TIvJgWd01G8NgXtQKHECHF5rvg.jpg', '2025-09-17 21:36:52'),
(8, 'Pudding', 'Domestic Shorthair', 2, 'Good', 'uploads/cat/yfhqQ7e78AaMOmOi51D4nnFGiku0yLlA76PpxlCO.jpg', '2025-10-01 05:39:50'),
(9, 'OIIA', 'Munchkin', 4, 'Spin', 'uploads/cat/FVYAfFl134qscY5a1YUu9bSO13em75Apo1kFnRjG.jpg', '2025-10-01 05:40:57'),
(10, 'Boss', 'Domestic Shorthair', 6, 'Drunk', 'uploads/cat/Q2FL851xrJKhVmiqHfBsJDW5OjYfXPMM8mT6t7iF.jpg', '2025-10-01 05:41:32'),
(11, 'Latte', 'Siamese', 8, 'Good', 'uploads/cat/003QNJ22mxkjKZ2a7VAZ3hRHIzJF9LEs1TaYQQ6L.jpg', '2025-10-01 05:41:59'),
(12, 'Mochi', 'Domestic Shorthair', 1, 'Hit?', 'uploads/cat/HE8D2JJEb6ThXQWE7NWlNuu1yNTnfuQY4Hw9FNEx.jpg', '2025-10-01 05:42:40'),
(13, 'Martini', 'Domestic Shorthair', 7, 'Sit', 'uploads/cat/41W8B6cAEkR1K2XLWERMARE4IodebfEiYm9xukuk.jpg', '2025-10-01 05:43:11'),
(14, 'Marmalade', 'Domestic Shorthair', 2, 'Good', 'uploads/cat/o6oWChDfJBXiZFPajTZm32edM9JUVXbo2ajSEWx5.jpg', '2025-10-01 05:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employees`
--

CREATE TABLE `tbl_employees` (
  `employee_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ',
  `user_id` int(6) NOT NULL COMMENT 'รหัสผู้ใช้จากตาราง tbl_users',
  `first_name` varchar(50) NOT NULL COMMENT 'ชื่อของพนักงาน',
  `last_name` varchar(50) NOT NULL COMMENT 'นามสกุลของพนักงาน',
  `nickname` varchar(50) NOT NULL COMMENT 'ชื่อเล่นของพนักงาน',
  `telephone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์ของพนักงาน',
  `email` varchar(50) NOT NULL COMMENT 'อีเมล์ของพนักงาน',
  `birth_date` date NOT NULL COMMENT 'วันเกิดของพนักงาน',
  `hire_date` date NOT NULL COMMENT 'วันที่จ้างพนักงาน',
  `position` enum('Admin','Staff') NOT NULL COMMENT 'ตำแหน่งงาน',
  `employee_pic` varchar(255) NOT NULL COMMENT 'รูปภาพของพนักงาน',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล (อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employees`
--

INSERT INTO `tbl_employees` (`employee_id`, `user_id`, `first_name`, `last_name`, `nickname`, `telephone`, `email`, `birth_date`, `hire_date`, `position`, `employee_pic`, `timestamp`) VALUES
(1, 1, 'John', 'Doe', 'Johnny', '0812345678', 'john.doe@example.com', '1990-01-15', '2023-09-01', 'Admin', 'uploads/employee/4561f13e-0756-442e-b464-4b5a2ddb430d.jpg', '2025-09-17 20:29:15'),
(2, 2, 'Bharat', 'Kumar', 'B', '0921112222', 'bharat.k@example.com', '1988-11-05', '2022-01-15', 'Staff', 'uploads/employee/c003ebba-a0ab-42ad-ab07-60866eec2460.jpg', '2025-09-17 20:30:05'),
(3, 3, 'Alice', 'Smith', 'Ali', '0894567890', 'alice.smith@example.com', '1995-06-22', '2024-03-10', 'Staff', 'uploads/employee/08b7fcdf-19cd-48d6-8ff8-1c067beede83.jpg', '2025-09-17 20:30:51'),
(4, 4, 'Yuki', 'Chan', 'Yuu', '0857776666', 'yuki.chan@example.com', '1993-12-18', '2023-08-10', 'Admin', 'uploads/employee/233f95c7-5785-42a0-ad8d-e47905a9bf36.jpg', '2025-09-17 20:31:43'),
(5, 5, 'Linh', 'Tran', 'Lin', '0833334444', 'linh.tran@example.com', '1992-03-09', '2023-01-05', 'Staff', 'uploads/employee/b97e794a-146e-43c8-89e3-af525d8bf77b.jpg', '2025-09-17 20:32:23'),
(6, 6, 'Kevin', 'Miller', 'Kev', '0879998888', 'kevin.miller@example.com', '1998-09-30', '2024-06-20', 'Staff', 'uploads/employee/ee4f8828-6425-4203-8024-88395b81b8c2.jpg', '2025-09-17 20:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `member_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ',
  `user_id` int(6) NOT NULL COMMENT 'รหัสผู้ใช้จากตาราง tbl_users',
  `first_name` varchar(50) NOT NULL COMMENT 'ชื่อของสมาชิก',
  `last_name` varchar(50) NOT NULL COMMENT 'นามสกุลของสมาชิก',
  `telephone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์ของสมาชิก',
  `email` varchar(50) NOT NULL COMMENT 'อีเมล์ของสมาชิก',
  `birth_date` date NOT NULL COMMENT 'วันเกิดของสมาชิก',
  `point` int(10) NOT NULL COMMENT 'คะแนนสะสม',
  `register_date` date NOT NULL COMMENT 'วันที่สมัครสมาชิก',
  `member_pic` varchar(255) NOT NULL COMMENT 'รูปภาพของสมาชิก',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล\r\n(อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`member_id`, `user_id`, `first_name`, `last_name`, `telephone`, `email`, `birth_date`, `point`, `register_date`, `member_pic`, `timestamp`) VALUES
(1, 7, 'Sunisa', 'Wongchai', '0815559090', 'sunisa.w@example.com', '1997-04-12', 6, '2024-09-10', 'uploads/member/bd8133c0-5883-4f7b-bb20-7b62ae50e083.jpg', '2025-09-17 20:39:00'),
(2, 8, 'Krit', 'Tanan', '0891234567', 'krit.tanan@example.com', '2001-11-03', 1, '2023-06-22', 'uploads/member/430b97b9-d311-480c-9159-274676915bf7.jpg', '2025-09-17 20:39:32'),
(3, 9, 'Mimi', 'Chen', '0822324876', 'mimi.chen@example.com', '1995-02-17', 2, '2024-02-01', 'uploads/member/89c8fa56-f9c1-455a-adc4-39a206ff9adc.jpg', '2025-09-17 20:40:18'),
(4, 10, 'Arjun', 'Mehta', '0867774321', 'arjun.mehta@example.com', '1992-07-29', 3, '2024-08-12', 'uploads/member/fhuFuGNDJZ4Zb2yurVq1t5xkBpOlCie1inp3E4vs.jpg', '2025-09-17 20:40:51'),
(5, 11, 'Lilly', 'Rose', '0808889999', 'lilly.rose@example.com', '1999-05-14', 1, '2023-05-20', 'uploads/member/4698a9cb-0a5f-42ed-9a74-07124d139a23.jpg', '2025-09-17 20:41:25'),
(6, 12, 'Max', 'Anderson', '0873216540', 'max.anderson@example.com', '1990-10-08', 9, '2024-01-01', 'uploads/member/3c9051e2-8c84-44a3-beaf-745e050907f2.jpg', '2025-09-17 20:41:57'),
(7, 13, 'Nattaporn', 'Kittisak', '0845551212', 'nattaporn.k@example.com', '1996-09-25', 5, '2024-09-01', 'uploads/member/88fd33b6-292f-48e6-85f6-b20fd8131bbe.jpg', '2025-09-17 20:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_items`
--

CREATE TABLE `tbl_menu_items` (
  `item_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ',
  `item_name` varchar(50) NOT NULL COMMENT 'ชื่อเมนู',
  `category` enum('Food','Drink') NOT NULL COMMENT 'ประเภทของเมนู',
  `item_price` decimal(12,2) NOT NULL COMMENT 'ราคา',
  `item_pic` varchar(255) NOT NULL COMMENT 'รูปภาพของเมนู',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล\r\n(อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_menu_items`
--

INSERT INTO `tbl_menu_items` (`item_id`, `item_name`, `category`, `item_price`, `item_pic`, `timestamp`) VALUES
(1, 'Croissants (Set of 2)', 'Food', 85.00, 'uploads/menuitem/ylgYKQu4LmWkc3XDXJYw6JGk39nM1NrOkgLJs7D9.png', '2025-09-17 23:23:30'),
(2, 'Cat Paw Cookies (Set of 3)', 'Food', 55.00, 'uploads/menuitem/EyTiOuzRTNFN8mTSOdBfbJinzgj6e1dzXi6KVMe5.png', '2025-09-17 23:23:30'),
(3, 'Macarons (Set of 3)', 'Food', 95.00, 'uploads/menuitem/daXkuZslVhXCMSXLogQOutSn5G9OvCSpH2LWpynI.png', '2025-09-17 23:23:30'),
(4, 'Mini Pancake Stack with Maple Syrup', 'Food', 95.00, 'uploads/menuitem/rhMn2uJufpuPGAw6Adjn1rJQfinZwliL7PnSXg2U.png', '2025-09-17 23:23:30'),
(5, 'Crispy French Fries', 'Food', 75.00, 'uploads/menuitem/z7FeKrE8J0mbQzak6wgM0OrYRixbrDSowb5FFTHV.png', '2025-09-17 23:23:30'),
(6, 'Tuna Sandwiches (Set of 2)', 'Food', 85.00, 'uploads/menuitem/eXhFUqPWk4tovHEC1ZLRbBYBNdpj47MNYhMTSwbR.png', '2025-09-17 23:23:30'),
(7, 'Salmon Onigiris (Set of 2)', 'Food', 65.00, 'uploads/menuitem/IJbHdMWP702AfkYk5zqqFkUzVodIDKlIuQdcSBaz.png', '2025-09-17 23:23:30'),
(8, 'Chicken Teriyaki Rice Bowl', 'Food', 120.00, 'uploads/menuitem/UqjykUQP66V0kx96dFPbwmzY9zs1yFc2rM72yqt4.png', '2025-09-17 23:23:30'),
(9, 'Ramen Bowl', 'Food', 160.00, 'uploads/menuitem/c5SXEA7Vv4AMe8LW5cMRd5W8x0guE9ietwMCnusG.png', '2025-09-17 23:23:30'),
(10, 'Grilled Chicken Caesar Salad', 'Food', 110.00, 'uploads/menuitem/9N3EYWQySIINJG2SaPZMqX8A8ssHQEXa7Nt9wMTk.png', '2025-09-17 23:23:30'),
(11, 'Burger', 'Food', 140.00, 'uploads/menuitem/z3kToRGyVNtW2B0bhsk2czIxTNMhM5LEYisbUGoj.png', '2025-09-17 23:23:30'),
(12, 'Cheese Omelette with Toast', 'Food', 90.00, 'uploads/menuitem/UE07G4DhKHoKilBbsamXkFRPPHKCLwYO66pyetN3.png', '2025-09-17 23:23:30'),
(13, 'Spaghetti Carbonara', 'Food', 140.00, 'uploads/menuitem/GIwDwuroNFSvVB9TunnFSUZgnj8yRcLkR4d0lNYQ.png', '2025-09-17 23:23:30'),
(14, 'Chocolate Lava Cake', 'Food', 130.00, 'uploads/menuitem/qwBB82aehLgPKSmTaOWJTu2RmcUvA8fp1aa9AmUs.png', '2025-09-17 23:23:30'),
(15, 'Hot Cappuccino', 'Drink', 70.00, 'uploads/menuitem/YQjP2HwWqX2WAqJ7Hy5rrEUPoMFuYpkixgqWrzyQ.png', '2025-09-17 23:23:30'),
(16, 'Matcha Latte (Hot/Iced)', 'Drink', 85.00, 'uploads/menuitem/xLzK8OLWgI04YQdZcJwpVr6xeDBQyFw3dWHx3oUD.png', '2025-09-17 23:23:30'),
(17, 'Mint Tea', 'Drink', 70.00, 'uploads/menuitem/GoI7uC8sbdPwOfL7vhbyiWCUAtFYHR3qV1m3Rylz.png', '2025-09-17 23:23:30'),
(18, 'Iced Latte', 'Drink', 75.00, 'uploads/menuitem/vPpQN4uUBO6Iw5Wb8thb23FV1wH3aSJxBSSP1tIF.png', '2025-09-17 23:23:30'),
(19, 'Caramel Macchiato', 'Drink', 90.00, 'uploads/menuitem/OLIhhvP4nAg9dKOKvLBAZIRl9fVO4JGm3rtDsXqx.png', '2025-09-17 23:23:30'),
(20, 'Thai Milk Tea', 'Drink', 65.00, 'uploads/menuitem/TzYR87Io8Yf83SfMa2l8yBoxuyaak67IDgcCb28a.png', '2025-09-17 23:23:30'),
(21, 'Fresh Orange Juice', 'Drink', 70.00, 'uploads/menuitem/SiJA8nbMWQbkZcP1SRXFYr1KSlR8CoXQ5Zv69y8P.png', '2025-09-17 23:23:30'),
(22, 'Honey Lemon Soda', 'Drink', 60.00, 'uploads/menuitem/gJDLxyAca2tmGICebCNKWl3nOpokxK9ZfdDBUsHf.png', '2025-09-17 23:23:30'),
(23, 'Iced Chocolate', 'Drink', 80.00, 'uploads/menuitem/zcukvKBLv9VQglwl6k0kaczF2jWzearVjUNDLg7t.png', '2025-09-17 23:23:30'),
(24, 'Strawberry Smoothie', 'Drink', 95.00, 'uploads/menuitem/YCdyrjTzjrK9RhTdM9i5ZdIFxuCgtqeqQP7J1xJo.png', '2025-09-17 23:23:30'),
(25, 'Blueberry Soda', 'Drink', 85.00, 'uploads/menuitem/gy5hE4s7Wywr1FgC7C2IKyBaLpjvUrhm5W9y2QTY.png', '2025-09-17 23:23:30'),
(26, 'Vanilla Cream Soda', 'Drink', 90.00, 'uploads/menuitem/B87Wcri0Dgu1In0M4boTpoDyPiXq479DZu7KJXHU.png', '2025-09-17 23:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ',
  `member_id` int(6) NOT NULL COMMENT 'รหัสสมาชิกที่สั่งอาหาร',
  `employee_id` int(6) NOT NULL COMMENT 'รหัสพนักงานที่รับออเดอร์',
  `order_date` date NOT NULL COMMENT 'วันที่สั่งออเดอร์',
  `total_price` decimal(12,2) NOT NULL COMMENT 'ราคารวมของออเดอร์',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล\r\n(อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `member_id`, `employee_id`, `order_date`, `total_price`, `timestamp`) VALUES
(1, 6, 4, '2025-09-18', 495.00, '2025-09-17 22:05:24'),
(2, 7, 6, '2025-09-28', 790.00, '2025-09-28 11:00:40'),
(3, 2, 2, '2025-09-28', 1035.00, '2025-09-28 11:01:06'),
(4, 5, 5, '2025-09-28', 85.00, '2025-09-28 11:01:14'),
(5, 2, 1, '2025-09-28', 640.00, '2025-09-28 11:01:42'),
(6, 3, 4, '2025-09-28', 1000.00, '2025-09-28 11:02:22'),
(7, 7, 5, '2025-10-01', 575.00, '2025-09-30 18:43:22'),
(8, 2, 1, '2025-10-01', 65.00, '2025-09-30 19:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `order_detail_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ',
  `order_id` int(6) NOT NULL COMMENT 'รหัสออเดอร์',
  `item_id` int(6) NOT NULL COMMENT 'รหัสเมนู',
  `quantity` int(3) NOT NULL COMMENT 'จำนวน',
  `price` decimal(12,2) NOT NULL COMMENT 'ราคาของออเดอร์',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล\r\n(อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_detail_id`, `order_id`, `item_id`, `quantity`, `price`, `timestamp`) VALUES
(1, 1, 3, 2, 65.00, '2025-09-17 22:05:24'),
(2, 1, 5, 1, 140.00, '2025-09-17 22:05:24'),
(3, 1, 11, 3, 75.00, '2025-09-17 22:05:24'),
(4, 2, 7, 3, 65.00, '2025-09-28 11:00:40'),
(5, 2, 1, 2, 85.00, '2025-09-28 11:00:40'),
(6, 2, 21, 2, 70.00, '2025-09-28 11:00:40'),
(7, 2, 24, 3, 95.00, '2025-09-28 11:00:40'),
(8, 3, 18, 3, 75.00, '2025-09-28 11:01:06'),
(9, 3, 19, 2, 90.00, '2025-09-28 11:01:06'),
(10, 3, 14, 4, 130.00, '2025-09-28 11:01:06'),
(11, 3, 2, 2, 55.00, '2025-09-28 11:01:06'),
(12, 4, 6, 1, 85.00, '2025-09-28 11:01:14'),
(13, 5, 23, 2, 80.00, '2025-09-28 11:01:42'),
(14, 5, 9, 3, 160.00, '2025-09-28 11:01:42'),
(15, 6, 26, 3, 90.00, '2025-09-28 11:02:22'),
(16, 6, 6, 2, 85.00, '2025-09-28 11:02:22'),
(17, 6, 11, 4, 140.00, '2025-09-28 11:02:22'),
(18, 7, 9, 2, 160.00, '2025-09-30 18:43:22'),
(19, 7, 17, 1, 70.00, '2025-09-30 18:43:22'),
(20, 7, 22, 2, 60.00, '2025-09-30 18:43:22'),
(21, 7, 20, 1, 65.00, '2025-09-30 18:43:22'),
(22, 8, 7, 1, 65.00, '2025-09-30 19:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotions`
--

CREATE TABLE `tbl_promotions` (
  `promotion_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ',
  `promotion_detail` text NOT NULL COMMENT 'รายละเอียดโปรโมชั่น',
  `promotion_pic` varchar(255) NOT NULL COMMENT 'รูปภาพของโปรโมชั่น',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล\r\n(อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_promotions`
--

INSERT INTO `tbl_promotions` (`promotion_id`, `promotion_detail`, `promotion_pic`, `timestamp`) VALUES
(1, '🎉 รับฟรี! ขนมแมวเลีย 1 ซอง 🐟 (มูลค่า 23 บาท)\r\nเมื่อสั่ง 🥤 วนิลาครีมโซดา + 🍪 คุกกี้อุ้งมือแมว', 'uploads/promotion/p8nG9wK4HtQSn8BufbLXJJUmb2Bq7IthKJ2jlsVM.png', '2025-09-28 09:24:14'),
(2, '⭐ สะสมแต้ม ⭐\r\n🐶🐱 สะสมครบ 10 แต้ม รับฟรี! เครื่องดื่ม 1 แก้ว 🥤🎁', 'uploads/promotion/MkfFvzOwHuw1kusW9SVqtYQKEKh1YajJrXhhR6DO.png', '2025-09-28 09:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotion_usages`
--

CREATE TABLE `tbl_promotion_usages` (
  `usage_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัต',
  `member_id` int(6) NOT NULL COMMENT 'รหัสสมาชิกที่ใช้ส่วนลด',
  `promotion_id` int(6) NOT NULL COMMENT 'รหัสโปรโมชั่น',
  `date_used` date NOT NULL COMMENT 'วันที่ใช้โปรโมชั่น',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล\r\n(อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(6) NOT NULL COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ',
  `username` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้สำหรับเข้าสู่ระบบ',
  `password` varchar(255) NOT NULL COMMENT 'รหัสผ่านสำหรับเข้าสู่ระบบ',
  `role` enum('Employee','Member') NOT NULL COMMENT 'บทบาทของผู้ใช้',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาที่บันทึกข้อมูล (อัตโนมัติ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `role`, `timestamp`) VALUES
(1, 'jdoe', '$2y$12$J5LnMBGaONP3.oOoJyso6ODu0Gtsk10/.bMF1GCg8IxlCNkY0twoS', 'Employee', '2025-09-17 20:29:15'),
(2, 'bkumar', '$2y$10$kGNSzxh4FG9JKbSR/Hz5B.92YRR2sswsUduqLP1Okm7JrVtGyeiNq', 'Employee', '2025-09-17 20:30:05'),
(3, 'asmith', '$2y$10$RSpdHB.Gv/mPcGiBxMkrS.YRxMMfrrUaI/JD6sUQfZSri/0tW.oNS', 'Employee', '2025-09-17 20:30:51'),
(4, 'ychan', '$2y$10$/Dj0SBpzvbtfLjGygpdqguJVZh3ZUdd1fRAL/XKSNQChrumAfh.YK', 'Employee', '2025-09-17 20:31:43'),
(5, 'ltran', '$2y$10$JYH5eLowOm9VWEYMz2sFJOAtVl6eabplIX2/vTYsg6Gisql5Bw5oW', 'Employee', '2025-09-17 20:32:23'),
(6, 'kmiller', '$2y$12$nyQvn5TJjoBIs/.ORb9UxernfnLXSmDGjcN2V5IKUc.1Q5DwWmVMq', 'Employee', '2025-09-17 20:32:59'),
(7, 'sunnyday', '$2y$12$V1tC/e6PT6FxjkAif4G26.7F7c9P0HqXYikX6KXh2YMlRBfEXJM3K', 'Member', '2025-09-17 20:39:00'),
(8, 'gamerx', '$2y$10$ZMnUqDonSrGfGkrImFqihOftalmOPdOFrbP6gtGFHM036ZTehDc/m', 'Member', '2025-09-17 20:39:32'),
(9, 'mimi88', '$2y$10$R2WZ/SdTZpCiwYPJZA.oJu.NVdK0CzOj4J.l2uTNPqsDbiTm9L/Ti', 'Member', '2025-09-17 20:40:18'),
(10, 'artlover', '$2y$10$5CDeQzQZuElq28sUSSzpeusXaX29frg45bvDSaBl2p5lxx5qZ2i9a', 'Member', '2025-09-17 20:40:51'),
(11, 'lillyrose', '$2y$10$AmWjYWMhl6yfUABY0dki8Oo4KMF590B9jpee1WqcQ9v2any0Yk76q', 'Member', '2025-09-17 20:41:25'),
(12, 'maxpower', '$2y$10$U0bBbxjteJZ1qj7ls64uE.mILi4Vp2n27ThNgEBJV2/qzJqFa10FS', 'Member', '2025-09-17 20:41:57'),
(13, 'nova123', '$2y$10$nGMRRcq6phL9qpGuYsFSOuWECqrfVJcqjfEIfaVejNRxO2vLdYwVW', 'Member', '2025-09-17 20:43:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cats`
--
ALTER TABLE `tbl_cats`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `fk_user_id_member` (`user_id`);

--
-- Indexes for table `tbl_menu_items`
--
ALTER TABLE `tbl_menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_member_id_order` (`member_id`),
  ADD KEY `fk_emp_id_order` (`employee_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD UNIQUE KEY `order_id` (`order_id`,`item_id`),
  ADD KEY `fk_item_id_order_detail` (`item_id`);

--
-- Indexes for table `tbl_promotions`
--
ALTER TABLE `tbl_promotions`
  ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `tbl_promotion_usages`
--
ALTER TABLE `tbl_promotion_usages`
  ADD PRIMARY KEY (`usage_id`),
  ADD KEY `fk_user_id_promo_use` (`member_id`),
  ADD KEY `fk_promo_id_promo_use` (`promotion_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cats`
--
ALTER TABLE `tbl_cats`
  MODIFY `cat_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `employee_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_menu_items`
--
ALTER TABLE `tbl_menu_items`
  MODIFY `item_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ', AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `order_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `order_detail_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_promotions`
--
ALTER TABLE `tbl_promotions`
  MODIFY `promotion_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดย\r\nอัตโนมัติ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_promotion_usages`
--
ALTER TABLE `tbl_promotion_usages`
  MODIFY `usage_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัต';

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID ที่ถูกสร้างโดยอัตโนมัติ', AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD CONSTRAINT `fk_user_id_member` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `fk_emp_id_order` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employees` (`employee_id`),
  ADD CONSTRAINT `fk_member_id_order` FOREIGN KEY (`member_id`) REFERENCES `tbl_members` (`member_id`);

--
-- Constraints for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `fk_item_id_order_detail` FOREIGN KEY (`item_id`) REFERENCES `tbl_menu_items` (`item_id`),
  ADD CONSTRAINT `fk_order_id_order_detail` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`order_id`);

--
-- Constraints for table `tbl_promotion_usages`
--
ALTER TABLE `tbl_promotion_usages`
  ADD CONSTRAINT `fk_promo_id_promo_use` FOREIGN KEY (`promotion_id`) REFERENCES `tbl_promotions` (`promotion_id`),
  ADD CONSTRAINT `fk_user_id_promo_use` FOREIGN KEY (`member_id`) REFERENCES `tbl_members` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
