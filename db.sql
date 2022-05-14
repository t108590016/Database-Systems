-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-05-14 15:48:30
-- 伺服器版本： 10.4.19-MariaDB
-- PHP 版本： 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `bssdb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `ISBN` varchar(13) NOT NULL,
  `Category` varchar(10) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `ImageURL` text NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`ISBN`, `Category`, `Description`, `ImageURL`, `Name`) VALUES
('1234567890123', 'IXD', '怎麼沒有文發係', './img/61dcf16833eb4門.png', '中文書'),
('9786269546725', 'CE', '雅典日研所編著, 2022', './img/2ca83d0b.jpg', '我的菜日文: 快速學會50音'),
('9789572191750', 'EECS', 'QQ3,2021', './img/B7.png', '微算機'),
('9789572196359', 'EECS', 'Elaine,2021', './img/B3.png', '電子學'),
('9789579282048', 'CE', 'Mike,2019', './img/B4.png', '工程數學'),
('9789862360811', 'EE', 'Hannnah,2018', './img/B2.png', '微積分(上)'),
('9789862802021', 'CSIE', 'qq1,2020', './img/B6.png', '數位邏輯'),
('9789863782872', 'EE', 'qq4,2016', './img/B8.png', '微積分'),
('9789865036638', 'CSIE', 'Jack,2020', './img/B1.png', '計算機概論'),
('9789869803724', 'IXD', 'Ann,2018', './img/B5.png', '中級英文'),
('9867892445', 'CE', 'qq6,2016', './img/B9.png', '法文');

-- --------------------------------------------------------

--
-- 資料表結構 `manager`
--

CREATE TABLE `manager` (
  `MANAGER_ID` int(10) UNSIGNED NOT NULL,
  `USER_ID` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `manager`
--

INSERT INTO `manager` (`MANAGER_ID`, `USER_ID`) VALUES
(1, '106AC1016'),
(2, '107A50039'),
(3, '108590016'),
(4, '108590451'),
(5, '108830035'),
(6, '108AC1026');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `USER_ID` varchar(9) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Token` varchar(50) DEFAULT NULL,
  `PhoneNum` varchar(10) NOT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`USER_ID`, `Name`, `Token`, `PhoneNum`, `Department`, `password`) VALUES
('106AC1016', '陳旻昌', '904859irjeut', '0932345678', 'ID', '12345'),
('107A50039', '黃發泉', '21uiut89in12', '0922345678', 'CVD', '12345'),
('108590000', 't', NULL, '0912345678', 'CSIE', '12345'),
('108590016', '陳琴蓮', 'iojtgio21ji4', '0912345678', 'CSIE', '12345'),
('108590451', '陸詠涵', '129u04jkqfle', '0913345678', 'CSIE', '12345'),
('108830035', '陳佳均', 'e90fajodjowe', '0923345678', 'CSIE', '12345'),
('108AC1026', '林寧', 'fjiewjfiowel', '0933345678', 'CSIE', '12345');

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `Reciever` varchar(9) NOT NULL,
  `Sender` varchar(9) NOT NULL,
  `Topic` varchar(255) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `Date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`Reciever`, `Sender`, `Topic`, `Content`, `Date`) VALUES
('108590451', '108590016', '123', '123', '2022-01-10 10:51:10'),
('107A50039', '108590000', '親我剛剛下單囉', '麻煩確認一下', '2022-01-11 02:46:40'),
('108590451', '108590000', '親我剛剛下單囉', '麻煩確認一下', '2022-01-11 02:48:07'),
('108590000', '108590451', '收到了', '2/29下午在櫻花樹下交貨', '2022-01-11 02:51:04');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Price` int(11) NOT NULL,
  `Finished` tinyint(1) DEFAULT 0,
  `SellerID` varchar(9) NOT NULL,
  `BuyerID` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`ID`, `Date`, `Price`, `Finished`, `SellerID`, `BuyerID`) VALUES
(3, '2022-01-10 11:02:38', 150, 0, '108590451', '108590016'),
(4, '2022-01-10 11:02:50', 50, 0, '108590451', '108590016'),
(5, '2022-01-10 11:49:02', 150, 0, '108590451', '108590016'),
(6, '2022-01-10 11:49:52', 150, 0, '108590451', '108590016'),
(7, '2022-01-10 11:50:24', 150, 0, '108590451', '108590016'),
(8, '2022-01-10 11:54:00', 460, 0, '108590451', '108590016'),
(9, '2022-01-11 02:37:25', 400, 0, '108590451', '108590016'),
(10, '2022-01-11 02:37:47', 200, 0, '108590451', '108590016'),
(11, '2022-01-11 02:44:10', 200, 1, '108590451', '108590000'),
(12, '2022-01-11 03:41:57', 123, 0, '108590451', '108590451'),
(13, '2022-01-11 03:48:39', 123, 0, '108590451', '108590451');

-- --------------------------------------------------------

--
-- 資料表結構 `purchaseitem`
--

CREATE TABLE `purchaseitem` (
  `OrderID` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `purchaseitem`
--

INSERT INTO `purchaseitem` (`OrderID`, `ISBN`) VALUES
(3, '9789572191750'),
(4, '9867892445'),
(5, '9789572191750'),
(6, '9789572191750'),
(7, '9789572191750'),
(8, '9789572196359'),
(9, '9789579282048'),
(10, '9789863782872'),
(11, '9789862802021'),
(12, '1234567890123'),
(13, '9786269546725');

-- --------------------------------------------------------

--
-- 資料表結構 `sell`
--

CREATE TABLE `sell` (
  `ISBN` varchar(13) NOT NULL,
  `Price` int(11) NOT NULL,
  `SellerID` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `sell`
--

INSERT INTO `sell` (`ISBN`, `Price`, `SellerID`) VALUES
('9789862360811', 350, '108590451'),
('9789869803724', 380, '108590451'),
('9867892445', 50, '108590451'),
('9789862802021', 300, '108590000'),
('1234567890123', 123, '108590451'),
('9786269546725', 123, '108590451'),
('1234567890123', 123, '108590451'),
('9786269546725', 123, '108590016'),
('9789572191750', 123, '108590016'),
('9789579282048', 123, '107A50039');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- 資料表索引 `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`MANAGER_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`USER_ID`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD KEY `message_ibfk_1` (`Reciever`),
  ADD KEY `message_ibfk_2` (`Sender`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orders_ibfk_1` (`SellerID`),
  ADD KEY `orders_ibfk_2` (`BuyerID`);

--
-- 資料表索引 `purchaseitem`
--
ALTER TABLE `purchaseitem`
  ADD KEY `purchaseitem_ibfk_1` (`OrderID`),
  ADD KEY `purchaseitem_ibfk_2` (`ISBN`);

--
-- 資料表索引 `sell`
--
ALTER TABLE `sell`
  ADD KEY `sell_ibfk_1` (`ISBN`),
  ADD KEY `sell_ibfk_2` (`SellerID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `member` (`USER_ID`);

--
-- 資料表的限制式 `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`Reciever`) REFERENCES `member` (`USER_ID`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`Sender`) REFERENCES `member` (`USER_ID`);

--
-- 資料表的限制式 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `member` (`USER_ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`BuyerID`) REFERENCES `member` (`USER_ID`);

--
-- 資料表的限制式 `purchaseitem`
--
ALTER TABLE `purchaseitem`
  ADD CONSTRAINT `purchaseitem_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `purchaseitem_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`);

--
-- 資料表的限制式 `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `sell_ibfk_2` FOREIGN KEY (`SellerID`) REFERENCES `member` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
