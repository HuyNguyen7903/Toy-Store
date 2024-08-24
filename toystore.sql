-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 24, 2024 lúc 05:49 PM
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
-- Cơ sở dữ liệu: `toystore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `toy_products`
--

CREATE TABLE `toy_products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) NOT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `detailed_description` text DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `brand_origin` varchar(255) DEFAULT NULL,
  `sub_images` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `toy_products`
--

INSERT INTO `toy_products` (`product_id`, `name`, `category`, `description`, `brand`, `original_price`, `discounted_price`, `discount_percentage`, `quantity`, `image_url`, `created_at`, `updated_at`, `detailed_description`, `theme`, `origin`, `code`, `age`, `brand_origin`, `sub_images`) VALUES
(37, 'HOT WHEELS HKX420', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,ĐỒ CHƠI SÁNG TẠO', 'Đồ Chơi Siêu Xe Khủng Long T-Rex Hot Wheels', 'Hot Wheels', 1359000.00, 1087000.00, 19, 0, '../images/HW-TRex.png', '2024-08-20 08:34:34', '2024-08-24 15:14:49', 'Tham gia cuộc phiêu lưu cùng Bộ đồ chơi Hot Wheels™ City T-Rex Chomp-Down™ và trở thành người hùng giải cứu thế giới! Với tính năng trượt tốc độ và vòng quay mạnh mẽ, bạn sẽ phóng xe Hot Wheels® để hạ gục khủng long khổng lồ. Khi bị đánh bại, đôi mắt giận dữ của quái vật sẽ chuyển từ màu vàng rực rỡ sang biểu tượng X bất tỉnh\r\nBộ đồ chơi đi kèm với một chiếc xe Hot Wheels® và có thể kết nối với các bộ khác để tạo ra những cuộc phiêu lưu bất tận. Dành cho trẻ em từ 4 tuổi trở lên. Màu sắc và họa tiết có thể thay đổi, mang lại sự bất ngờ và thích thú cho mọi cuộc chơi.', 'HOT WHEELS CITY', 'TRUNG QUỐC', 'HKX42', '4 tuổi trở lên', 'Mỹ', '[\"..\\/images\\/pab0.png\"]'),
(38, 'PAW PATROL 6060759', '', 'Đồ chơi xe cảnh sát biến hình Paw Patrol The Movie - Chase PAW PATROL 6060759', 'PAW Patrol', 1299000.00, 1039000.00, 20, 0, '../images/paw patroy.png', '2024-08-20 08:34:34', '2024-08-24 13:50:50', '', '', '', 'h', '', '', ''),
(39, 'RASTAR R92900/WHITE', 'FLASH SALE,BÁN CHẠY', 'Đồ Chơi Xe Điều Khiển 1:24 - BMW 3.0 CSL - Màu Trắng', 'Rastar', 479000.00, 479000.00, 0, 1, '../images/rastar.png', '2024-08-20 08:34:34', '2024-08-24 15:15:53', '', '', '', 'd', '', '', ''),
(40, 'Bảng vẽ đa năng PAB034 Xanh', '', 'Đồ chơi trẻ em: Bảng vẽ đa năng PAB034 Xanh', 'Pabo', 469000.00, 375000.00, 20, 1, '../images/pab0.png', '2024-08-20 08:34:34', '2024-08-20 08:34:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'HOT WHEELS GJM77 đâs', 'BÁN CHẠY', 'Bộ đường đua Hot Wheels vòng xoay thần tốc', 'Hot Wheels', 1389000.00, 972000.00, 30, 0, '../images/HW-action.png', '2024-08-20 08:34:34', '2024-08-24 15:23:23', '', '', '', 's', '', '', ''),
(55, 'Hot Wheels Turbo Racer', 'BÁN CHẠY', 'Xe Hot Wheels Turbo Racer với khả năng tăng tốc cao', 'Hot Wheels', 1399000.00, 1099000.00, 21, 15, '../images/hot_wheels_turbo_racer.png', '2024-08-18 02:00:00', '2024-08-24 15:17:09', '<p>Trải nghiệm tốc độ cực đại với xe Hot Wheels Turbo Racer. Xe có khả năng tăng tốc nhanh chóng và thiết kế thể thao tuyệt đẹp.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-TURBO', '4 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_turbo_racer.png\",\"../images/hot_wheels_turbo_racer2.png\",\"../images/hot_wheels_turbo_racer3.png\"]'),
(56, 'Hot Wheels Track Builder', '', 'Bộ xây dựng đường đua Hot Wheels với các phụ kiện đa dạng', 'Hot Wheels', 1899000.00, 1499000.00, 21, 20, '../images/hot_wheels_track_builder.png', '2024-08-18 02:15:00', '2024-08-18 02:15:00', '<p>Tạo ra các đường đua độc đáo với bộ xây dựng Hot Wheels Track Builder. Bộ sản phẩm bao gồm nhiều phụ kiện để bạn tùy chỉnh theo ý muốn.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-TRACK', '5 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_track_builder.png\",\"../images/hot_wheels_track_builder2.png\",\"../images/hot_wheels_track_builder3.png\"]'),
(57, 'Hot Wheels Monster Trucks', '', 'Xe tải khủng long Hot Wheels Monster Trucks với tính năng phá hủy', 'Hot Wheels', 1599000.00, 1299000.00, 19, 12, '../images/hot_wheels_monster_trucks.png', '2024-08-18 02:30:00', '2024-08-18 02:30:00', '<p>Khám phá thế giới khủng long với xe tải Hot Wheels Monster Trucks. Xe có thiết kế mạnh mẽ và khả năng phá hủy mạnh mẽ.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-MONSTER', '4 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_monster_trucks.png\",\"../images/hot_wheels_monster_trucks2.png\",\"../images/hot_wheels_monster_trucks3.png\"]'),
(58, 'Hot Wheels Street Racer', '', 'Xe đua đường phố Hot Wheels Street Racer với thiết kế thể thao', 'Hot Wheels', 1499000.00, 1199000.00, 20, 10, '../images/hot_wheels_street_racer.png', '2024-08-18 02:45:00', '2024-08-18 02:45:00', '<p>Xe đua Hot Wheels Street Racer với thiết kế thể thao và tốc độ cao. Phù hợp cho các cuộc đua đường phố kịch tính.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-STREET', '4 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_street_racer.png\",\"../images/hot_wheels_street_racer2.png\",\"../images/hot_wheels_street_racer3.png\"]'),
(59, 'Hot Wheels Racing Set', '', 'Bộ đua Hot Wheels Racing Set với các đường đua đa dạng', 'Hot Wheels', 2099000.00, 1699000.00, 19, 18, '../images/hot_wheels_racing_set.png', '2024-08-18 03:00:00', '2024-08-18 03:00:00', '<p>Trải nghiệm các cuộc đua kịch tính với bộ đua Hot Wheels Racing Set. Bộ sản phẩm bao gồm nhiều đường đua và phụ kiện để bạn thỏa sức sáng tạo.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-RACING', '5 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_racing_set.png\",\"../images/hot_wheels_racing_set2.png\",\"../images/hot_wheels_racing_set3.png\"]'),
(60, 'Hot Wheels Power Booster', '', 'Bộ tăng tốc Hot Wheels Power Booster cho các đường đua thêm thú vị', 'Hot Wheels', 1799000.00, 1399000.00, 22, 14, '../images/hot_wheels_power_booster.png', '2024-08-18 03:15:00', '2024-08-18 03:15:00', '<p>Thêm sức mạnh cho các đường đua với bộ tăng tốc Hot Wheels Power Booster. Bộ sản phẩm giúp xe đua của bạn có thêm tốc độ và khả năng tăng cường hiệu suất.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-BOOSTER', '4 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_power_booster.png\",\"../images/hot_wheels_power_booster2.png\",\"../images/hot_wheels_power_booster3.png\"]'),
(61, 'Hot Wheels Drift King', '', 'Xe Drift King Hot Wheels với khả năng drift mượt mà', 'Hot Wheels', 1599000.00, 1249000.00, 22, 11, '../images/hot_wheels_drift_king.png', '2024-08-18 03:30:00', '2024-08-18 03:30:00', '<p>Trải nghiệm drift mượt mà với xe Drift King Hot Wheels. Xe có thiết kế đặc biệt để thực hiện các màn drift ấn tượng.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-DRIFT', '4 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_drift_king.png\",\"../images/hot_wheels_drift_king2.png\",\"../images/hot_wheels_drift_king3.png\"]'),
(62, 'Hot Wheels Fire Truck', '', 'Xe cứu hỏa Hot Wheels với chức năng phun nước', 'Hot Wheels', 1699000.00, 1399000.00, 18, 8, '../images/hot_wheels_fire_truck.png', '2024-08-18 03:45:00', '2024-08-18 03:45:00', '<p>Xe cứu hỏa Hot Wheels với chức năng phun nước và thiết kế chi tiết. Phù hợp cho các trò chơi cứu hỏa và cứu hộ.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-FIRE', '4 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_fire_truck.png\",\"../images/hot_wheels_fire_truck2.png\",\"../images/hot_wheels_fire_truck3.png\"]'),
(63, 'Hot Wheels Speed Series', '', 'Bộ xe đua Speed Series Hot Wheels với các mẫu xe tốc độ cao', 'Hot Wheels', 1799000.00, 1499000.00, 17, 16, '../images/hot_wheels_speed_series.png', '2024-08-18 04:00:00', '2024-08-18 04:00:00', '<p>Bộ xe đua Speed Series Hot Wheels bao gồm nhiều mẫu xe tốc độ cao. Sản phẩm lý tưởng cho những cuộc đua tốc độ và các cuộc thi.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-SPEED', '5 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_speed_series.png\",\"../images/hot_wheels_speed_series2.png\",\"../images/hot_wheels_speed_series3.png\"]'),
(64, 'Hot Wheels City Chase', '', 'Xe đua Hot Wheels City Chase với thiết kế hiện đại', 'Hot Wheels', 1499000.00, 1199000.00, 20, 9, '../images/hot_wheels_city_chase.png', '2024-08-18 04:15:00', '2024-08-18 04:15:00', '<p>Khám phá thành phố với xe đua Hot Wheels City Chase. Xe có thiết kế hiện đại và hiệu suất cao, phù hợp cho các cuộc đua thành phố.</p>', 'HOT WHEELS', 'TRUNG QUỐC', 'HW-CITY', '4 tuổi trở lên', 'Trung Quốc', '[\"../images/hot_wheels_city_chase.png\",\"../images/hot_wheels_city_chase2.png\",\"../images/hot_wheels_city_chase3.png\"]'),
(442, 'huyasd ad', 'HÀNG MỚI,FLASH SALE', '12', 'a ', 2.00, 2.00, 12, 12, '../images/HW-TRex.png', '2024-08-24 15:19:22', '2024-08-24 15:20:25', '', '', '', 'sa', '', '', '../images/HW-TRex.png,../images/HW-TRex.png,../images/HW-TRex.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cart_product` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_product` (`product_id`);

--
-- Chỉ mục cho bảng `toy_products`
--
ALTER TABLE `toy_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `wishlist_product` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `toy_products`
--
ALTER TABLE `toy_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_product` FOREIGN KEY (`product_id`) REFERENCES `toy_products` (`product_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_product` FOREIGN KEY (`product_id`) REFERENCES `toy_products` (`product_id`);

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_product` FOREIGN KEY (`product_id`) REFERENCES `toy_products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
