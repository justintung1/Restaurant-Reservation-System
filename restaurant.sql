-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.6-MariaDB
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `restaurant`
--

-- --------------------------------------------------------

--
-- 資料表結構 `manage`
--

CREATE TABLE `manage` (
  `kn` int(11) NOT NULL,
  `account` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `manage`
--

INSERT INTO `manage` (`kn`, `account`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `kn` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `texting` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`kn`, `name`, `date`, `texting`) VALUES
(1, '童翌展', '2021-06-12 18:00:00', '哈哈哈哈哈哈'),
(2, '童翌展', '2021-06-12 08:39:43', '利用訂位系統後十分方便，都不必再排隊等位子了'),
(3, '蔡詠麟', '2021-06-12 20:29:20', '好用的系統><'),
(4, '童翌展', '2021-06-12 20:45:29', '我是版主'),
(5, '童翌展', '2021-06-12 20:53:34', '大家好'),
(8, '童翌展', '2021-06-12 20:57:33', 'good, good'),
(9, '童翌展', '2021-06-13 00:18:14', 'good morning'),
(10, '黃靖雯', '2021-06-15 11:09:29', 'Hello'),
(11, '林小明', '2021-06-14 12:05:33', '這家餐廳給五星好評!!!!'),
(13, '童翌展', '2021-06-19 22:52:50', '測試');

-- --------------------------------------------------------

--
-- 資料表結構 `order_f`
--

CREATE TABLE `order_f` (
  `kn` int(11) NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(2) NOT NULL,
  `orderid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `order_f`
--

INSERT INTO `order_f` (`kn`, `mobile`, `number`, `orderid`, `date`, `time`) VALUES
(29, '0905185457', 3, 'dNK5er5bxr', '2021-06-20', '13:00:00'),
(31, '0928709863', 1, 'B1pPp2QIMw', '2021-06-25', '18:30:00'),
(35, '0905185457', 1, 'ZZatyEQTHE', '2021-06-24', '18:00:00'),
(36, '0928709863', 4, 'KyZtJz5hvq', '2021-07-01', '12:00:00'),
(40, '0905185457', 2, 'M0fKO09jpL', '2021-07-09', '19:00:00'),
(42, '0905185457', 7, 'Klip178379', '2021-08-05', '13:00:00'),
(43, '0905185457', 3, '3qptRrSXti', '2021-06-20', '17:30:00'),
(44, '0905185457', 4, 'P1G72vVEIA', '2021-06-20', '18:00:00'),
(45, '0905185457', 2, 'iabVPDKinx', '2021-06-20', '19:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `kn` int(11) NOT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`kn`, `account`, `password`, `name`, `phone`) VALUES
(1, 'admin', '1234', '童翌展', '0905185457'),
(2, 'yeeann', 'asdf', '蔡詠麟', '0928709863'),
(3, 'abcd', 'abcd', '林小明', '0978645851'),
(7, 'qwer', 'qwer', '王大同', '0988754361'),
(8, 'zxcv', 'zxcv', '黃靖雯', '0945681347'),
(10, 'goodman', 'good0', '吳宗宸', '0903585156');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`kn`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`kn`);

--
-- 資料表索引 `order_f`
--
ALTER TABLE `order_f`
  ADD PRIMARY KEY (`kn`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kn`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `manage`
--
ALTER TABLE `manage`
  MODIFY `kn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `message`
--
ALTER TABLE `message`
  MODIFY `kn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_f`
--
ALTER TABLE `order_f`
  MODIFY `kn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `kn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
