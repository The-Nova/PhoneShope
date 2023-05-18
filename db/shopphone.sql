--
-- Tạo database: qlshopephone
--

CREATE DATABASE qlshopephone;

--
-- Cấu trúc bảng cho bảng `users`
--
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4  NOT NULL DEFAULT '202cb962ac59075b964b07152d234b70',
  `role` int(11) NOT NULL,
  `createdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` ( `name`, `email`, `password`, `role`) VALUES
( 'TheNova', 'thenova@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
( 'Nguyễn Văn B', 'nvb@gmail.com', '202cb962ac59075b964b07152d234b70', 3),
( 'Nguyễn Văn C', 'nvc@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 3),
( 'Nguyễn Văn D', 'nvd@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
( 'Nguyễn Văn E', 'nve@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 3);

-------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `cmt` int(15) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `createdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` ( `name`, `email`, `address`, `phone`, `cmt`, `password`) VALUES
( 'Nguyễn Văn A', 'nva@gmail.com', 'sỐ 1, đường A, phường B, quận Bắc Từ Liêm, Hà Nội', '123456', 245516518, '202cb962ac59075b964b07152d234b70'),
( 'test', 'test@gmail.com', 'sỐ 2, đường AB, phường BD, quận Bắc Từ Liêm, Hà Nội', '123456', 8649844, '202cb962ac59075b964b07152d234b70'),
( 'Nguyễn Văn E@', 'nve@gmail.com', 'sỐ 53, đường AG, phường BE, quận Nam Từ Liêm, Hà Nội', '123456', 54854584, '202cb962ac59075b964b07152d234b70'),
( 'Nguyễn Văn B', 'nvb@gmail.com', 'sỐ 133, đường JK, phường K, quận Ba Đình, Hà Nội', '123', 165465454, '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------


--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `displayhomepage` int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` ( `parent_id`, `name`, `displayhomepage`) VALUES
( 0, 'IPhone', 0),
( 1, 'IPhone 13', 1),
( 0, 'Sam Sung', 0),
( 4, 'Samsung Note X', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `description` varchar(4000) NOT NULL,
  `content` text NOT NULL,
  `hot` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `createdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` ( `name`, `description`, `content`, `hot`, `photo`, `price`, `discount`, `category_id`) VALUES
( 'dfsafda', '', '', 0, '1615992973_1.jpg', 11111000, 11, 4),
( 'sgdghd', '<p>dagfa</p>\r\n', '<p>sdgs</p>\r\n', 0, '1636966517_11.jpg', 12000000, 11, 1);

-- --------------------------------------------------------


--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `datepay` date NOT NULL,
  `createdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` float NOT NULL,
  `saleprice` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `note` varchar(500) NOT NULL DEFAULT '0',
  `datecancel` date NOT NULL,
  PRIMARY KEY (id)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` ( `customer_id`, `datepay`, `price`, `saleprice`, `status`, `note`, `datecancel`) VALUES
( 1, '2022-11-05',  32000000, 100000, 0, '0', '0000-00-00'),
( 1, '2022-11-05',  15400000, 100000, 1, '0', '0000-00-00'),
( 2, '2022-11-10',  12350000, 200000, 1, '0', '0000-00-00'),
( 3, '0000-00-00', 2500000, 50000, 2, 'Hàng không đúng', '2022-11-12'),
( 2, '2022-11-04',  1250000, 20000, 1, '0', '0000-00-00'),
( 2, '0000-00-00',  270000, 0, 2, 'Không thấy giao hàng', '2022-11-01');

-- --------------------------------------------------------


--
-- Cấu trúc bảng cho bảng `orderdetails` dang lam
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `sale` int(11) NOT NULL DEFAULT '0',
  `createdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastupdate` date NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderdetails`
--

INSERT INTO `orderdetails` ( `order_id`, `product_id`, `quantity`, `price`, `sale`) VALUES
( 6, 11, 3, 5000000, 10),
( 6, 6, 5, 8000000, 0),
( 7, 11, 1, 5000000, 33),
( 7, 4, 1, 6000000, 5),
( 7, 7, 1, 9000000, 0),
( 8, 14, 2, 500000, 0),
( 8, 9, 2, 11000000, 0),
( 9, 21, 1, 3000000, 0),
( 9, 17, 2, 8000000, 0),
( 10, 13, 1, 700000, 0),
( 11, 10, 1, 12000000, 10);

-- --------------------------------------------------------


--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `star` int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `rating` ( `product_id`, `star`) VALUES
( 1, 4),
( 2, 5),
( 3, 5),
( 25, 2),
( 24, 3),
( 23, 2),
( 22, 1),
( 21, 5),
( 20, 4),
( 19, 5),
( 18, 5),
( 17, 4),
( 16, 2),
( 15, 5),
( 14, 2),
( 4, 5);


-- --------------------------------------------------------


--
-- Cấu trúc bảng cho bảng `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `color` varchar(20) NOT NULL,
  `quantity` int(4) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `types` ( `product_id`, `photo`,`color`,`quantity` ) VALUES
(58,'1681354951_tải xuống.jpg','Màu đỏ',22),
(58,'1681354951_tải xuống.jpg','Màu xanh',2),
(58,'1681354951_tải xuống.jpg','Màu tím',22),
(58,'1681354951_tải xuống.jpg','Màu xanh lá',22),
(58,'1681354951_tải xuống.jpg','Màu vàng kim',22);
