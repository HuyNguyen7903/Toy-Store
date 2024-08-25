-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 25, 2024 lúc 02:42 PM
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
(443, 'HOT WHEELS HKX42', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE SƯU TẬP', 'Đồ Chơi Siêu Xe Khủng Long T-Rex Hot Whells HKX42', 'Hot Whells', 1359000.00, 1087000.00, 20, 32, '../images/HW-TRex.png', '2024-08-25 11:51:17', '2024-08-25 12:41:08', '<p>Tham gia cuộc phiêu lưu cùng Bộ đồ chơi Hot Wheels™ City T-Rex Chomp-Down™ và trở thành người hùng giải cứu thế giới! Với tính năng trượt tốc độ và vòng quay mạnh mẽ, bạn sẽ phóng xe Hot Wheels® để hạ gục khủng long khổng lồ. Khi bị đánh bại, đôi mắt giận dữ của quái vật chuyển từ màu vàng rực rỡ sang biểu tượng X bất tỉnh.</p><p>Bộ đồ chơi đi kèm với một chiếc xe Hot Wheels® và có thể kết nối với các bộ khác để tạo ra những cuộc phiêu lưu bất tận. Dành cho trẻ em từ 4 tuổi trở lên. Màu sắc và họa tiết có thể thay đổi, mang lại sự bất ngờ và thích thú cho mọi cuộc chơi.</p>', 'HOT WHEELS CITY', 'TRUNG QUỐC', 'HKX42', '4 tuổi trở lên', 'Mỹ', '../images/HW-TRex.png,../images/HW-TRex2.png,../images/HW-TRex3.png,../images/HW-TRex4.png'),
(444, 'PAW PATROL 6060759', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE LẮP RÁP,XE SƯU TẬP,ĐỒ CHƠI SÁNG TẠO,ĐỒ CHƠI LẮP GHÉP', 'Đồ chơi xe cảnh sát biến hình Paw Patrol The Movie - Chase PAW PATROL 6060759', 'PAW PATROL', 1299000.00, 1039000.00, 20, 20, '../images/paw patroy.png', '2024-08-25 11:59:16', '2024-08-25 12:01:21', '<p> Lấy cảm hứng từ thương hiệu nổi tiếng của Canada và bộ phim hoạt hình đình đám \"Đội Chó Cứu Hộ Paw Patrol\", sản phẩm này mang thế giới phiêu lưu từ màn ảnh nhỏ đến hiện thực qua bộ phim \"Paw Patrol The Movie\". </p> <p> Bộ đồ chơi độc đáo này bao gồm hai xe trong một. Chiếc xe cảnh sát tuần tra có khả năng biến hình đầy ấn tượng, với lớp vỏ giáp kiên cố che giấu một chiếc mô tô siêu tốc bên dưới. Chiếc mô tô này giúp chú chó cứu hộ dũng cảm Chase dễ dàng vượt qua những địa hình khó khăn nhất. Đèn và còi hụ chân thực, kết hợp với hệ thống bắn đạn siêu đẳng, giúp Chase luôn hoàn thành xuất sắc mọi nhiệm vụ cứu hộ. </p>', 'PAWPATROL PLAYSET', 'TRUNG QUỐC', '6060759', '3 tuổi trở lên', 'CANADA', '../images/paw patroy.png,../images/paw patroy2.png,../images/paw patroy3.png,../images/paw patroy4.png,../images/paw patroy5.png'),
(445, 'RASTAR R92900/WHITE', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE SƯU TẬP', 'Xe Điều Khiển 1:24 Bmw 3.0 Csl Trắng Rastar R92900', 'Rastar', 479000.00, 479000.00, 0, 23, '../images/rastar.png', '2024-08-25 12:04:03', '2024-08-25 12:33:18', '<p> <strong >Đồ Chơi Xe Điều Khiển 1:24 Bmw 3.0 Csl Trắng Rastar R92900 </strong> gây ấn tượng với những đặc điểm nổi bật sau đây: </p> <ul> <li> Tỷ lệ 1:24: Mô phỏng kích thước xe thật với tỷ lệ 1:24, mỗi chi tiết đều được thu nhỏ một cách tỉ mỉ. </li> <li> Điều khiển linh hoạt: Xe có khả năng điều khiển tiến, lùi, rẽ trái, và rẽ phải, mang lại trải nghiệm lái xe thú vị. </li> <li> Thiết kế tinh xảo: Mọi chi tiết của xe đều được chăm chút tỉ mỉ, từ khung xe đến nội thất, đảm bảo sự tinh tế và chân thực. </li> <li> Chất liệu cao cấp: Xe được làm từ nhựa và kim loại cao cấp, tăng độ bền và đảm bảo sự chắc chắn trong quá trình sử dụng. </li> <li> Bánh xe cao su: Bánh xe được làm từ cao su chất lượng, giúp tăng độ bám với bề mặt, cho cảm giác lái đầm và êm hơn. </li> <li> Bảo hành 30 ngày: Sản phẩm được bảo hành 30 ngày tại ToyStore nếu phát hiện lỗi từ nhà sản xuất. </li> </ul> <p> Bộ sản phẩm bao gồm một xe điều khiển và một điều khiển từ xa. Lưu ý, sản phẩm không kèm theo pin. </p>', '', 'TRUNG QUỐC', 'R92900', '6 tuổi trở lên', 'Trung Quốc', '../images/rastar.png,../images/rastar2.png'),
(447, 'PABO34', 'BÁN CHẠY, ĐỒ CHƠI SÁNG TẠO, BÚT MÀU VÀ BẢNG VẼ', 'Đồ chơi trẻ em: Bảng vẽ đa năng Xanh Grown Up PAB034', 'GROWN UP', 469000.00, 375000.00, 20, 52, '../images/pab0.png', '2024-08-25 12:18:20', '2024-08-25 12:18:20', '<p> Bảng vẽ đa năng chân đứng 2 mặt PAB034 là một công cụ tuyệt vời để phát triển trí tuệ, khuyến khích sự sáng tạo và nâng cao kỹ năng vận động của trẻ thông qua các hoạt động vẽ, viết, và tô màu. </p> <p> <strong>Đồ Chơi Trẻ Em: Bảng Vẽ Đa Năng Xanh Grown Up PAB034 </strong> gây ấn tượng với những đặc điểm nổi bật sau đây: </p> <ul> <li> Thiết kế hai mặt tiện lợi: Bé có thể sử dụng đồng thời cả mặt bảng phấn và bút lông, giúp tăng thêm niềm vui sáng tạo. </li> <li> Chỉnh chiều cao linh hoạt: Bảng vẽ có thể điều chỉnh chiều cao phù hợp với bé, với hai mức: tối thiểu 52 cm và tối đa 57 cm. </li> <li> An toàn và chắc chắn: Khung bảng được thiết kế chắc chắn với các góc bo tròn, đảm bảo an toàn cho bé trong quá trình sử dụng. </li> <li> Bề mặt bảng rộng: Không gian rộng rãi cho phép bé thỏa sức sáng tạo và phác họa những gì mình tưởng tượng. </li> <li> 54 vật dụng đi kèm: Sản phẩm đi kèm với bút lông, phấn, bộ dụng cụ vẽ, cùng với sticker nam châm gồm chữ số, chữ cái, và phép tính, giúp bé học tập hiệu quả hơn. </li> <li> Phát triển kỹ năng tự tin: Bảng vẽ giúp bé luyện tập sự tự tin khi thể hiện suy nghĩ và trình bày trước mọi người. </li> </ul> <p>Sản phẩm này được khuyến khích sử dụng cho trẻ em trên 3 tuổi.</p>', 'DRAWING BOARD', 'TRUNG QUỐC', 'PAB034', '3 tuổi trở lên', 'Việt Nam', '../images/pab0.png, ../images/pab02.png, ../images/pab03.png, ../images/pab04.png'),
(448, 'HOT WHEELS GJM77', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE LẮP RÁP,XE SƯU TẬP,ĐỒ CHƠI SÁNG TẠO,ĐỒ CHƠI LẮP GHÉP', 'Bộ đường đua Hot Wheels vòng xoay thần tốc HOT WHEELS GJM77', 'Hot Whells', 1389000.00, 972000.00, 30, 0, '../images/HW-action.png', '2024-08-25 12:35:37', '2024-08-25 12:36:08', '<p> Bộ sản phẩm Hot Wheels Action bao gồm tất cả những thứ mà mọi đứa trẻ cần để khảo nghiệm khả năng lái xe của mình. Với vòng xoay thần tốc, 2 bệ phóng cực mạnh và 2 siêu xe Hot Wheels bên trong, các bạn nhỏ có thể thách thức khả năng của chính min hf hoặc bạn của mình. Phóng xe Hot Wheels xuyên qua vòng xoay thần tốc và đến được lá cờ để giành điểm. Phe nào đạt điểm cao nhất sẽ giành chiến thắng chung cuộc </p>', ' HOT WHEELS ACTION', 'TRUNG QUỐC', 'GJM77', '5 tuổi trở lên', 'Mỹ', '../images/HW-action.png,../images/HW-action2.png,../images/HW-action3.png,../images/HW-action4.png');

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=449;

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
