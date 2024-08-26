-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 26, 2024 lúc 06:15 PM
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
(443, 'HOT WHEELS HKX42', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE SƯU TẬP', 'Đồ Chơi Siêu Xe Khủng Long T-Rex Hot Whells HKX42', 'Hot Whells', 1359000.00, 1087000.00, 20, 32, '../images/HW-TRex.png', '2024-08-25 11:51:17', '2024-08-26 14:38:28', '<p>Tham gia cuộc phiêu lưu cùng Bộ đồ chơi Hot Wheels™ City T-Rex Chomp-Down™ và trở thành người hùng giải cứu thế giới! Với tính năng trượt tốc độ và vòng quay mạnh mẽ, bạn sẽ phóng xe Hot Wheels® để hạ gục khủng long khổng lồ. Khi bị đánh bại, đôi mắt giận dữ của quái vật chuyển từ màu vàng rực rỡ sang biểu tượng X bất tỉnh.</p><p>Bộ đồ chơi đi kèm với một chiếc xe Hot Wheels® và có thể kết nối với các bộ khác để tạo ra những cuộc phiêu lưu bất tận. Dành cho trẻ em từ 4 tuổi trở lên. Màu sắc và họa tiết có thể thay đổi, mang lại sự bất ngờ và thích thú cho mọi cuộc chơi.</p>', 'HOT WHEELS CITY', 'TRUNG QUỐC', 'HKX42', '4 tuổi trở lên', 'Mỹ', '../images/HW-TRex.png,../images/HW-TRex2.png,../images/HW-TRex3.png,../images/HW-TRex4.png'),
(444, 'PAW PATROL 6060759', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE LẮP RÁP,XE SƯU TẬP,ĐỒ CHƠI SÁNG TẠO,ĐỒ CHƠI LẮP GHÉP', 'Đồ chơi xe cảnh sát biến hình Paw Patrol The Movie - Chase PAW PATROL 6060759', 'PAW PATROL', 1299000.00, 1039000.00, 20, 20, '../images/paw patroy.png', '2024-08-25 11:59:16', '2024-08-25 12:01:21', '<p> Lấy cảm hứng từ thương hiệu nổi tiếng của Canada và bộ phim hoạt hình đình đám \"Đội Chó Cứu Hộ Paw Patrol\", sản phẩm này mang thế giới phiêu lưu từ màn ảnh nhỏ đến hiện thực qua bộ phim \"Paw Patrol The Movie\". </p> <p> Bộ đồ chơi độc đáo này bao gồm hai xe trong một. Chiếc xe cảnh sát tuần tra có khả năng biến hình đầy ấn tượng, với lớp vỏ giáp kiên cố che giấu một chiếc mô tô siêu tốc bên dưới. Chiếc mô tô này giúp chú chó cứu hộ dũng cảm Chase dễ dàng vượt qua những địa hình khó khăn nhất. Đèn và còi hụ chân thực, kết hợp với hệ thống bắn đạn siêu đẳng, giúp Chase luôn hoàn thành xuất sắc mọi nhiệm vụ cứu hộ. </p>', 'PAWPATROL PLAYSET', 'TRUNG QUỐC', '6060759', '3 tuổi trở lên', 'CANADA', '../images/paw patroy.png,../images/paw patroy2.png,../images/paw patroy3.png,../images/paw patroy4.png,../images/paw patroy5.png'),
(447, 'PABO34', 'BÁN CHẠY, ĐỒ CHƠI SÁNG TẠO, BÚT MÀU VÀ BẢNG VẼ', 'Đồ chơi trẻ em: Bảng vẽ đa năng Xanh Grown Up PAB034', 'GROWN UP', 469000.00, 375000.00, 20, 52, '../images/pab0.png', '2024-08-25 12:18:20', '2024-08-25 12:18:20', '<p> Bảng vẽ đa năng chân đứng 2 mặt PAB034 là một công cụ tuyệt vời để phát triển trí tuệ, khuyến khích sự sáng tạo và nâng cao kỹ năng vận động của trẻ thông qua các hoạt động vẽ, viết, và tô màu. </p> <p> <strong>Đồ Chơi Trẻ Em: Bảng Vẽ Đa Năng Xanh Grown Up PAB034 </strong> gây ấn tượng với những đặc điểm nổi bật sau đây: </p> <ul> <li> Thiết kế hai mặt tiện lợi: Bé có thể sử dụng đồng thời cả mặt bảng phấn và bút lông, giúp tăng thêm niềm vui sáng tạo. </li> <li> Chỉnh chiều cao linh hoạt: Bảng vẽ có thể điều chỉnh chiều cao phù hợp với bé, với hai mức: tối thiểu 52 cm và tối đa 57 cm. </li> <li> An toàn và chắc chắn: Khung bảng được thiết kế chắc chắn với các góc bo tròn, đảm bảo an toàn cho bé trong quá trình sử dụng. </li> <li> Bề mặt bảng rộng: Không gian rộng rãi cho phép bé thỏa sức sáng tạo và phác họa những gì mình tưởng tượng. </li> <li> 54 vật dụng đi kèm: Sản phẩm đi kèm với bút lông, phấn, bộ dụng cụ vẽ, cùng với sticker nam châm gồm chữ số, chữ cái, và phép tính, giúp bé học tập hiệu quả hơn. </li> <li> Phát triển kỹ năng tự tin: Bảng vẽ giúp bé luyện tập sự tự tin khi thể hiện suy nghĩ và trình bày trước mọi người. </li> </ul> <p>Sản phẩm này được khuyến khích sử dụng cho trẻ em trên 3 tuổi.</p>', 'DRAWING BOARD', 'TRUNG QUỐC', 'PAB034', '3 tuổi trở lên', 'Việt Nam', '../images/pab0.png, ../images/pab02.png, ../images/pab03.png, ../images/pab04.png'),
(448, 'HOT WHEELS GJM77', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE LẮP RÁP,XE SƯU TẬP,ĐỒ CHƠI SÁNG TẠO,ĐỒ CHƠI LẮP GHÉP', 'Bộ đường đua Hot Wheels vòng xoay thần tốc HOT WHEELS GJM77', 'Hot Whells', 1389000.00, 972000.00, 30, 0, '../images/HW-action.png', '2024-08-25 12:35:37', '2024-08-25 12:36:08', '<p> Bộ sản phẩm Hot Wheels Action bao gồm tất cả những thứ mà mọi đứa trẻ cần để khảo nghiệm khả năng lái xe của mình. Với vòng xoay thần tốc, 2 bệ phóng cực mạnh và 2 siêu xe Hot Wheels bên trong, các bạn nhỏ có thể thách thức khả năng của chính min hf hoặc bạn của mình. Phóng xe Hot Wheels xuyên qua vòng xoay thần tốc và đến được lá cờ để giành điểm. Phe nào đạt điểm cao nhất sẽ giành chiến thắng chung cuộc </p>', ' HOT WHEELS ACTION', 'TRUNG QUỐC', 'GJM77', '5 tuổi trở lên', 'Mỹ', '../images/HW-action.png,../images/HW-action2.png,../images/HW-action3.png,../images/HW-action4.png'),
(449, 'RASTAR R92900/WHITE', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE SƯU TẬP', 'Xe Điều Khiển 1:24 Bmw 3.0 Csl Trắng Rastar R92900', 'RASTAR', 479000.00, 479000.00, 0, 12, '../images/rastar.png', '2024-08-25 13:08:48', '2024-08-25 13:09:55', '<p> Đồ Chơi Xe Điều Khiển 1:24 BMW 3.0 CSL Trắng - Rastar R92900/WHI là một mô hình xe điều khiển chính hãng được cấp bản quyền từ BMW, tái hiện lại chiếc BMW 3.0 CSL huyền thoại với độ chính xác tuyệt đối. </p> <p> <strong >Đồ Chơi Xe Điều Khiển 1:24 Bmw 3.0 Csl Trắng Rastar R92900 </strong> gây ấn tượng với những đặc điểm nổi bật sau đây: </p> <ul> <li> Tỷ lệ 1:24: Mô phỏng kích thước xe thật với tỷ lệ 1:24, mỗi chi tiết đều được thu nhỏ một cách tỉ mỉ. </li> <li> Điều khiển linh hoạt: Xe có khả năng điều khiển tiến, lùi, rẽ trái, và rẽ phải, mang lại trải nghiệm lái xe thú vị. </li> <li> Thiết kế tinh xảo: Mọi chi tiết của xe đều được chăm chút tỉ mỉ, từ khung xe đến nội thất, đảm bảo sự tinh tế và chân thực. </li> <li> Chất liệu cao cấp: Xe được làm từ nhựa và kim loại cao cấp, tăng độ bền và đảm bảo sự chắc chắn trong quá trình sử dụng. </li> <li> Bánh xe cao su: Bánh xe được làm từ cao su chất lượng, giúp tăng độ bám với bề mặt, cho cảm giác lái đầm và êm hơn. </li> <li> Bảo hành 30 ngày: Sản phẩm được bảo hành 30 ngày tại Mykingdom nếu phát hiện lỗi từ nhà sản xuất. </li> </ul> <p> Bộ sản phẩm bao gồm một xe điều khiển và một điều khiển từ xa. Lưu ý, sản phẩm không kèm theo pin. </p>', '', 'TRUNG QUỐC', 'R92900', '6 tuổi trở lên', 'Trung Quốc', '../images/rastar.png,../images/rastar2.png'),
(450, 'BỘ 10 SIÊU XE HOT WHEELS 54886', 'BÁN CHẠY, ĐỒ CHƠI PHƯƠNG TIỆN, XE MÔ HÌNH, XE SƯU TẬP', 'Đồ Chơi Bộ 10 Siêu Xe Hot Wheels 54886', 'Hot Whells', 679000.00, 543000.00, 20, 12, '../images/HW-10.png', '2024-08-26 14:43:44', '2024-08-26 14:43:44', '<p>Đồ chơi bộ 10 siêu xe Hot Wheels 54886 là món đồ chơi yêu thích của các nhà sưu tập, những người đam mê xe hơi và người hâm mộ đua xe ở mọi lứa tuổi. Những chiếc xe Hot Wheels cực chất, được thiết kế vô cùng tinh xảo với tỷ lệ thu nhỏ 1/64 từ chiếc xe ngoài đời thật. Tuyệt vời hơn, bộ 10 siêu xe còn tích hợp thêm một siêu xe đặc biệt, chỉ được bán kèm trong bộ này. </p><ul> <li> Xe làm từ chất liệu nhựa và kim loại cao cấp, an toàn tuyệt đối cho sức khỏe. </li> <li> Chi tiết kim loại tinh xảo, lốp bánh xe cao su như thật. </li> <li> Màu sắc cuốn hút, mạnh mẽ, thu hút ánh nhìn và kích thích trí tưởng tượng của các bé.</li> <li> Mô hình xe được mô phỏng từ các dòng xe nổi tiếng trên khắp thế giới, giúp các bé mở mang kiến thức và học được nhiều điều mới mẻ.</li> <li> Từ nước sơn đến mẫu thiết kế trên xe đều rất tinh xảo, giúp bé có thể tận hưởng những giây phút giải trí tuyệt vời nhất.</li> <li> Dòng sản phẩm gồm có rất nhiều siêu xe khác nhau cho các bé thỏa sức sưu tầm </li> </ul>', 'HOT WHEELS DIECAST BASIC', 'Malaysia', '54886', ' 3 tuổi trở lên', 'Mỹ', '../images/HW-10.png, ../images/HW-10 1.png, ../images/HW-10 2.png'),
(451, 'THOMAS FRIEND HGX64', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE MÔ HÌNH,XE LẮP RÁP', 'Mô Hình Thomas Và Cây Cầu 3 Trong 1 THOMAS FRIEND HGX64', 'THOMAS FRIEND', 1499000.00, 1499000.00, 0, 12, '../images//Thomas Friend.png', '2024-08-26 14:48:10', '2024-08-26 14:49:23', '<p>Trẻ từ 3+ tuổi có thể tạo ra những cuộc phiêu lưu thú vị với Mô hình Thomas và cây cầu 3 trong 1. Bật công tắc lên để Thomas chạy dọc theo đường ray, và khi Thomas đi qua phễu, các thùng hàng sẽ tự động rơi xuống toa chở hàng. Với 17 đoạn đường ray có thể được sắp xếp thành ba bố cục khác nhau, bé thỏa thích lựa chọn tuyến đường mà Thomas sẽ đi để vận chuyển hàng hóa.</p><p>Bộ xe lửa Thomas & Friends 3 trong 1 là một món quà tuyệt vời, không chỉ giúp trẻ phát triển kỹ năng vận động mà còn khuyến khích trí tưởng tượng và khả năng kể chuyện của trẻ.</p><p>Ngoài ra, bé có thể chở hành khách trên xe Annie và Clarabel, sẵn sàng cho những chuyến đi vòng quanh Đảo Sodor. Bộ xe lửa này có thể kết nối với các đường ray khác của Thomas & Friends để tạo ra nhiều cuộc phiêu lưu phong phú hơn nữa. </p>', '', 'Trung Quốc', 'HGX64', '3 tuổi trở lên', 'Mỹ', '../images//Thomas Friend.png,../images//Thomas Friend 2.png,../images//Thomas Friend 3.png'),
(452, ' Xe Môi Trường Peek A Boo PAB049', 'BÁN CHẠY,ĐỒ CHƠI PHƯƠNG TIỆN,XE ĐIỀU KHIỂN,XE MÔ HÌNH,XE LẮP RÁP', 'Đồ Chơi DIY Lắp Ráp Xe Môi Trường Peek A Boo PAB049', 'PEEK A BOO', 649000.00, 649000.00, 0, 50, '../images/Pab049.png', '2024-08-26 14:56:50', '2024-08-26 14:57:14', '<p>Cùng Peek A Boo học về công dụng, cách vận hành và cấu tạo của xe môi trường, giúp các bé hóa thân thành người hùng bảo vệ môi trường sống xanh, sạch, đẹp: </p><ul><li>Khám phá bộ đồ chơi với xe môi trường, máy khoan 2 trong 1, thùng rác, và 7 chi tiết ốc vít đi kèm.</li><li>Máy khoan có thể tháo lắp linh hoạt với 3 phần, phần chứa pin có thể tháo rời để lắp vào bên dưới xe giúp kích hoạt xe hoạt động và di chuyển tiến hoặc lùi.</li><li> Máy khoan mô phỏng máy khoan thật, có thể xoay để tháo và lắp ốc vít, mang lại cho bé trải nghiệm thật thú vị. </li><li>PEEK A BOO là thương hiệu đồ chơi - đồ dùng trẻ em có xuất xứ tại Việt Nam với mong muốn mang lại tất cả những sản phẩm cần thiết nhất trên từng chặng đường phát triển của bé với chất lượng tốt, an toàn, giá cả phải chăng.</li></ul>', '', 'Trung quốc', 'PAB049', '3 tuổi trở lên', ' Việt Nam', '../images/Pab049.png,../images/Pab049 2.png,../images/Pab049 3.png,../images/Pab049 4.png,../images/Pab049 5.png,../images/Pab049 6.png,../images/Pab049 7.png'),
(453, 'Lamborghini Murcielago', 'BÁN CHẠY, ĐỒ CHƠI PHƯƠNG TIỆN, XE MÔ HÌNH, XE LẮP RÁP, ĐỒ CHƠI SÁNG TẠO, ĐỒ CHƠI LẮP GHÉP', 'Mô hình xe lắp ráp 1:24 Lamborghini Murcielago LP 640 MAISTO MT39900', 'MAISTO', 599000.00, 599000.00, 0, 5, '../images/LamMur.png', '2024-08-26 15:02:53', '2024-08-26 15:02:53', '<p>Mô hình xe lắp ráp 1:24 Lamborghini Murcielago LP 640 39292/MT39900 có thiết kế như thật, đường nét mô phỏng chi tiết, sắc sảo. Bé có thể chơi cùng bạn hoặc làm đầy bộ sưu tập mô hình siêu xe của mình.</p>\r\n<p>Đồ chơi xe mô hình sở hữu màu sắc sang trọng, kiểu dáng thanh lịch, thu hút các đối tượng từ trẻ nhỏ đến những người có niềm đam mê với sưu tầm xe lắp ráp. Nhắc đến đồ chơi mô hình xe lắp ráp 1:24 Lamborghini Murcielago LP 640 phải kể đến những đặc điểm nổi bật sau:</p>\r\n<ul><li>Tỉ lệ 1:24 (mỗi kích thước dài, rộng, cao nhỏ hơn 24 lần so với xe ngoài thực tế), có thể lắp ráp được</li><li>Tập cho bé tính kiên nhẫn và sự khéo léo</li><li>Xe có lớp vỏ ngoài sơn tĩnh điện tinh tế, đẹp mắt</li><li>Mô hình nhỏ gọn, vừa là đồ chơi, vừa là món đồ trang trí đẹp cho phòng khách hoặc ngay trên bàn làm việc của bạn</li></ul>\r\n<p>Maisto International Inc là thương hiệu đồ chơi của Cheong May Group Hồng Kông, chuyên sản xuất các mô hình đúc của xe ô tô, máy bay và xe máy, nổi tiếng từ những năm 1990. Đồ chơi Maisto được bày bán trong các cửa hàng và siêu thị đồ chơi trên toàn thế giới, nhận được sự yêu thích của hầu hết các bé thiếu nhi và nhận được hứng thú của rất nhiều người lớn đam mê mô hình xe.</p>', ' MAISTO 1:24 AL CARS', ' TRUNG QUỐC', '39292/MT39900', ' 8 tuổi trở lên', 'HONGKONG', '../images/LamMur.png, ../images/LamMur 1.png, ../images/LamMur 2.png, ../images/LamMur 3.png'),
(454, 'ROAD RIPPERS 20070', 'ĐỒ CHƠI PHƯƠNG TIỆN, XE LẮP RÁP, XE SƯU TẬP, ĐỒ CHƠI SÁNG TẠO, ĐỒ CHƠI LẮP GHÉP', 'Đồ chơi lắp ráp Road Rippers-Khủng long và xe chiến đấu ROAD RIPPERS 20070', 'ROAD RIPPERS', 99000.00, 99000.00, 0, 42, '../images/RoadRippers.png', '2024-08-26 15:22:59', '2024-08-26 15:22:59', '<p>Cuộc phiêu lưu giữa biệt đội siêu khủng long và những cỗ xe chiến đấu đang chờ bé đến khám phá. Hãy sưu tập trọn bộ 6 nhân vật, hoàn thành kỹ năng lắp ráp và hoán đổi vũ khí chiến đấu để sáng tạo nên câu chuyện kỳ thú nào!!</p><p>Nikko Toys là công ty đồ chơi toàn cầu có văn phòng tại Hongkong, Mỹ và châu Âu với cam kết mang lại những gì chất lượng nhất, luôn sáng tạo trong thiết kế và công nghệ.</p>', ' ROAD RIPPERS SNAP N PLAY', ' TRUNG QUỐC', ' 20070', ' 3 tuổi trở lên', 'HONGKONG', '../images/RoadRippers.png, ../images/RoadRippers 2.png, ../images/RoadRippers 3.png, ../images/RoadRippers 4.png, ../images/RoadRippers 5.png'),
(455, 'Bộ đồ chơi lắp ráp Vecto DIY', 'ĐỒ CHƠI PHƯƠNG TIỆN, XE MÔ HÌNH, XE LẮP RÁP, ĐỒ CHƠI SÁNG TẠO, ĐỒ CHƠI LẮP GHÉP', 'Bộ đồ chơi lắp ráp Vecto DIY-Xe đào, xe lu, nón và phụ kiện VECTO VT1038', 'VECTO', 749000.00, 449000.00, 40, 8, '../images/Vecto DIY.png', '2024-08-26 15:27:55', '2024-08-26 15:27:55', '<p>Bộ sản phẩm bao gồm: 1 xe lu, 1 xe đào, 1 phụ kiện và 1 nón. Xe hoàn toàn có thể tháo tất cả các bộ phận ra bằng tua vít đi kèm. Giúp bé phát triển tư duy phân tích, vận động tinh ngay từ nhỏ, tạo tiền đề cho việc phát triển tư duy sau này.</P>\r\n<p>VECTO là thương hiệu đồ chơi dành riêng cho các bé trai, với các dòng đồ chơi trải dài từ đồ chơi mô hình cho đến các đồ chơi điều khiển từ xa. Với mong muốn giúp các bé trai có một sự phát triển toàn diện từ trí não đến thể chất, Vecto đã phát triển đa dạng các loại đồ chơi để đem đến cho bé nhiều lựa chọn nhất có thể</p>', 'VECTODIY', 'Trung Quốc', 'VT1038', '3 tuổi trở lên', 'Việt Nam', '../images/Vecto DIY.png, ../images/Vecto DIY 2.png, ../images/Vecto DIY 3.png, ../images/Vecto DIY 4.png'),
(456, 'Lamborghini Superleggera', 'ĐỒ CHƠI PHƯƠNG TIỆN, XE ĐIỀU KHIỂN, XE SƯU TẬP', 'Xe điều khiển 1:24 Lamborghini Superleggera màu Vàng RASTAR R26300\r\n\r\n', 'RASTAR', 459000.00, 321000.00, 30, 41, '../images/R26300.png', '2024-08-26 15:33:53', '2024-08-26 15:33:53', '<p>1. Xe đồ chơi điều khiển Rastar được mua bản quyền sử dụng từ chính hãng xe Lamborghini danh tiếng thế giới2. Là phiên bản thu nhỏ tỉ lệ 1:24 từ siêu xe Lamborghini Superleggera với các đường nét và chi tiết sắc sảo nhất3. Được sản xuất với công nghệ tiên tiến dưới sự giám sát của đội ngũ kỹ thuật viên từ chính hãng xe Lamborghini cử đến4. Tay cầm điều khiển vừa tay, dễ thao tác5. Chức năng: tiến, lùi, trái, phải6. Đồ chơi điều khiển bảo đảm an toàn cho trẻ hoặc là món quà tuyệt vời với bao bì sang trọng</p>', 'RASTAR RC1:24', ' TRUNG QUỐC', 'R26300/YEL', ' 5 tuổi trở lên', ' TRUNG QUỐC', '../images/R26300.png, ../images/R26300 2.png'),
(457, 'Moto 4 bánh vượt địa hình', 'ĐỒ CHƠI PHƯƠNG TIỆN, XE ĐIỀU KHIỂN', 'Moto 4 bánh vượt địa hình điều khiển từ xa VECTO VT99107', 'VECTO', 299000.00, 209000.00, 30, 0, '../images/VT99107.png', '2024-08-26 15:36:30', '2024-08-26 15:36:30', '<p>Là dòng xe với những nét thiết kế đặc trưng theo phong cách xe đua vượt địa hình, với 2 bánh cao giúp xe có thể dễ dàng di chuyển ở nhiều địa hình khó. Sẽ có thể di chuyển lên xuống, quẹo trái và phải, cùng với các họa tiết được tô điểm một cách ngẫu nhiên dọc thân xe chắc chắn các bé sẽ thích mê món đồ chơi xe điều khiển này cho mà xem.</p>', 'VECTO REMOTE CONTROL CAR', ' Trung Quốc', 'VT99107', '3 tuổi trở lên', 'Việt Nam', '../images/VT99107.png, ../images/VT99107 2.png, ../images/VT99107 3.png'),
(458, 'bột nặn 4 màu mini PLAYDOH', 'ĐỒ CHƠI SÁNG TẠO, BỘT NẶN', 'Combo bột nặn 4 màu và bột nặn 4 màu mini PLAYDOH CBB5517-23241-33', 'PLAYDOH', 208000.00, 139000.00, 33, 102, '../images/CBB5517.png', '2024-08-26 15:43:31', '2024-08-26 15:43:31', '<p>Môt combo tuyệt vời cho bé, tha hồ sáng tạo mà không lo thiếu bột. Kích thước nhỏ gọn rất phù hợp cho bé đem đi ra ngoài cũng như mang theo đi học</p>\r\n<p>Môt combo tuyệt vời cho bé, tha hồ sáng tạo mà không lo thiếu bột. Kích thước nhỏ gọn rất phù hợp cho bé đem đi ra ngoài cũng như mang theo đi học</p>\r\n<ul><li>B5517 - Combo Bột Nặn 4 Màu: Bột nặn Playdoh 4 màu, cho bé thêm sự lựa chọn để thỏa sức sáng tạo. Với màu sắc đa dạng, đây sẽ là lựa chọn hoàn hảo cho bé bổ sssung thêm bộ sưu tập màu bột nặn của mình. Nào hãy cùng thỏa sức sáng tạo với Playdoh nhé</li><li>23241 - Bột Nặn  4 Màu Mini: Sản phẩm phù hợp cho bé từ 2 tuổi trở lên. Ở độ tuổi này, bé rất thích cầm nắm và vò nắn và giai đoạn này bé học rất nhanh về các giác quan. Chơi bột nặn giúp bé phát triển giác quan thông qua việc học màu sắc, tiếp xúc với chất bột mềm mịn sẽ kích thích bé cầm nắm, vò nắn. Bột nặn Playdoh 4 màu mini cho bé thêm sự lựa chọn để thỏa sức sáng tạo</li></ul>', 'PD CORE COMPOUND', ' Trung Quốc', 'CBB5517-23241-33', '3 tuổi trở lên', ' Mỹ', '../images/CBB5517.png, ../images/CBB5517 2.png, ../images/CBB5517 3.png'),
(459, 'Máy làm mì vui nhộn', 'ĐỒ CHƠI SÁNG TẠO, BỘT NẶN, ĐỒ CHƠI LẮP GHÉP', 'Máy làm mì vui nhộn PLAYDOH E7776', 'PLAYDOH', 759000.00, 493000.00, 35, 36, '../images/E7776.png', '2024-08-26 15:55:26', '2024-08-26 15:55:26', '<p>Từ chuỗi cửa hàng mì thơm ngon, mô phỏng chiếc máy làm mì cổ điển đến từ Playdoh. Những món mì Playdoh sẽ được các bé sáng tạo theo cách riêng của mình. Cho bột vào máy và xoay tay cầm , những mảng bột sẽ được cán mỏng và xuất lò tạo thành những sợi mì dai dai. Sử dụng 2 phần đính kèm trong máy để điều chỉnh kiểu dáng và độ dày của sợi mì. Có rất nhiều hình dạng khuôn như rau và trứng . Tất cả sẽ tuyệt vời nếu thêm 1 ít phô mai lên trên với máy cắt phô mai . Sản phẩm gồm 5 hũ bột Playdoh - 1 máy làm mì- 1 máy cắt phô mai- dĩa đựng và các vật dụng đi kèmBột nặn Play-Doh thuộc nhãn Hasbro thương hiệu Mỹ.Thành phần từ bột mì, an toàn với trẻ em.Mùi bột thơm nhẹ, làm từ thành phần thiên nhiên nên rất an toàn cho bé khi sử dụng.Bột không bị dính tay hoặc dính vào sàn gỗ, đồ nhựa, ít bị bám nên dễ làm sạch.</p>', 'PD KITCHEN COOKING', ' VIET NAM', ' E7776', '3 tuổi trở lên', ' Mỹ', '../images/E7776.png, ../images/E7776 2.png, ../images/E7776 3.png, ../images/E7776 4.png, ../images/E7776 5.png'),
(460, 'bộ khuôn làm bếp và bột nặn 4 màu', 'ĐỒ CHƠI SÁNG TẠO, BỘT NẶN', 'Combo bộ khuôn làm bếp cơ bản và bột nặn 4 màu mini PLAYDOH CBE7253-23241', 'PLAYDOH', 338000.00, 270000.00, 20, 74, '../images/CBE7253.png', '2024-08-26 15:59:33', '2024-08-26 15:59:33', '<p>Bộ khuôn Playdoh làm bếp cơ bản với nhiều phiên bản lựa gồm: Bộ nấu bếp và làm kem , bộ làm mì kèm theo bộ bột nặn 4 màu nhiều màu sắc bắt mắt, giúp bé phát triển trí tuệ và rèn luyện kĩ năng vận động tay</p>', ' PD KITCHEN COOKING', ' Trung Quốc', ' CBE7253-23241', '3 tuổi trở lên', 'Mỹ', '../images/CBE7253.png, ../images/CBE7253 2.png'),
(461, '30 bút gel pen', 'ĐỒ CHƠI SÁNG TẠO,BÚT MÀU VÀ BẢNG VẼ', 'Bộ sản phẩm gồm: 30 bút gel cộng với hơn 100 nhãn dán (Sticker) màu sắc khác.', '3C4G', 215000.00, 172000.00, 20, 103, '../images/57172.png', '2024-08-26 16:04:23', '2024-08-26 16:04:57', '<ul> <li>8 bút màu ánh kim</li> <li>6 bút gam màu pastel</li> <li>7 bút gam màu neon</li> <li>2 bút màu cầu vồng</li> <li>7 bút màu kim tuyến</li> </ul> <p>Màu sắc rực rỡ với loại mực không độc hại mang đến cho những bộ óc nghệ thuật nhiều không gian để sáng tạo những tác phẩm mới lạ, đầy thú vị và có thể làm nổi bật những thông tin, kiến thức bổ ích.</p> <p>Bé còn có thể tô màu trong hơn 100 nhãn dán và dán nhãn sticker này lên các vật dụng cá nhân như sổ tay ghi chép, hộp bút, bình nước, mũ bảo hiểm... Chính những nhãn dán sticker này sẽ tạo nên dấu ấn riêng biệt cho bé.</p> <p>Hộp đựng bút màu trong suốt, kiểu dáng gọn gàng, tiện lợi giúp cố định mọi bút chì màu ở vị trí hoàn hảo, giúp bé dễ dàng mang theo và tận hưởng niềm vui mọi lúc mọi nơi, dù đi học hay đi chơi, du lịch.</p> <p>Những cây bút màu đến từ thương hiệu 3C4G có tuổi thọ cao này chắc chắn sẽ làm hài lòng những người đam mê vẽ và viết nhật ký ở mọi lứa tuổi.</p>', ' 3C4G STATIONERY', ' Trung Quốc', ' 57172', ' 6 tuổi trở lên', ' Anh', '../images/57172.png,../images/57172 2.png,../images/57172 3.png');

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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

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
