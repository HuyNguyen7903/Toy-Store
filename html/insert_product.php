<?php
// Kết nối với cơ sở dữ liệu
include 'connectdb.php';

// Dữ liệu sản phẩm cần thêm
$products = [
    [
        'name' => 'HOT WHEELS HKX42',
        'brand' => 'Hot Wheels',
        'original_price' => 1359000,
        'discounted_price' => 1087000,
        'discount_percentage' => 20,
        'quantity' => 1,
        'description' => 'Đồ Chơi Siêu Xe Khủng Long T-Rex Hot Wheels',
        'detailed_description' => '<p>Tham gia cuộc phiêu lưu cùng Bộ đồ chơi Hot Wheels™ City T-Rex Chomp-Down™ và trở thành người hùng giải cứu thế giới! Với tính năng trượt tốc độ và vòng quay mạnh mẽ, bạn sẽ phóng xe Hot Wheels® để hạ gục khủng long khổng lồ. Khi bị đánh bại, đôi mắt giận dữ của quái vật sẽ chuyển từ màu vàng rực rỡ sang biểu tượng X bất tỉnh</p>.<p>Bộ đồ chơi đi kèm với một chiếc xe Hot Wheels® và có thể kết nối với các bộ khác để tạo ra những cuộc phiêu lưu bất tận. Dành cho trẻ em từ 4 tuổi trở lên. Màu sắc và họa tiết có thể thay đổi, mang lại sự bất ngờ và thích thú cho mọi cuộc chơi.</p>',
        'image_url' => '../images/HW-TRex.png',
        'theme' => 'HOT WHEELS CITY',
        'origin' => 'TRUNG QUỐC',
        'code' => 'HKX42',
        'age' => '4 tuổi trở lên',
        'brand_origin' => 'Mỹ',
        'sub_images' => json_encode([
            '../images/HW-TRex.png',
            '../images/HW-TRex2.png',
            '../images/HW-TRex3.png',
            '../images/HW-TRex4.png'
        ])
    ],

    [
        'name' => 'PAW PATROL 6060759',
        'brand' => 'PAW Patrol',
        'original_price' => 1299000,
        'discounted_price' => 1039000,
        'discount_percentage' => 20,
        'quantity' => 1,
        'description' => 'Đồ chơi xe cảnh sát biến hình Paw Patrol The Movie - Chase PAW PATROL 6060759',
        'image_url' => '../images/paw patroy.png'
    ],
    [
        'name' => 'RASTAR R92900/WHITE',
        'brand' => 'Rastar',
        'original_price' => 479000,
        'discounted_price' => 479000,
        'discount_percentage' => 0,
        'quantity' => 1,
        'description' => 'Đồ Chơi Xe Điều Khiển 1:24 - BMW 3.0 CSL - Màu Trắng',
        'image_url' => '../images/rastar.png'
    ],
    [
        'name' => 'Bảng vẽ đa năng PAB034 Xanh',
        'brand' => 'Pabo',
        'original_price' => 469000,
        'discounted_price' => 375000,
        'discount_percentage' => 20,
        'quantity' => 1,
        'description' => 'Đồ chơi trẻ em: Bảng vẽ đa năng PAB034 Xanh',
        'image_url' => '../images/pab0.png'
    ],
    [
        'name' => 'HOT WHEELS GJM77',
        'brand' => 'Hot Wheels',
        'original_price' => 1389000,
        'discounted_price' => 972000,
        'discount_percentage' => 30,
        'quantity' => 0,
        'description' => 'Bộ đường đua Hot Wheels vòng xoay thần tốc',
        'image_url' => '../images/HW-action.png'
    ]
    // Thêm các sản phẩm khác ở đây nếu cần
];

$sql_check = "SELECT COUNT(*) FROM toy_products WHERE name = :name";

try {
    $stmt_check = $conn->prepare($sql_check);

    foreach ($products as $product) {
        $stmt_check->bindParam(':name', $product['name']);
        $stmt_check->execute();
        
        if ($stmt_check->fetchColumn() == 0) {
            // Nếu sản phẩm chưa tồn tại, thực hiện chèn
            $sql_insert = "INSERT INTO toy_products 
            (name, brand, original_price, discounted_price, discount_percentage, quantity, description, detailed_description, image_url, theme, origin, code, age, brand_origin, sub_images) 
            VALUES 
            (:name, :brand, :original_price, :discounted_price, :discount_percentage, :quantity, :description, :detailed_description, :image_url, :theme, :origin, :code, :age, :brand_origin, :sub_images)";
            $stmt_insert = $conn->prepare($sql_insert);

            $stmt_insert->bindParam(':name', $product['name']);
            $stmt_insert->bindParam(':brand', $product['brand']);
            $stmt_insert->bindParam(':original_price', $product['original_price']);
            $stmt_insert->bindParam(':discounted_price', $product['discounted_price']);
            $stmt_insert->bindParam(':discount_percentage', $product['discount_percentage']);
            $stmt_insert->bindParam(':quantity', $product['quantity']);
            $stmt_insert->bindParam(':description', $product['description']);
            $stmt_insert->bindParam(':detailed_description', $product['detailed_description']);
            $stmt_insert->bindParam(':image_url', $product['image_url']);
            $stmt_insert->bindParam(':theme', $product['theme']);
            $stmt_insert->bindParam(':origin', $product['origin']);
            $stmt_insert->bindParam(':code', $product['code']);
            $stmt_insert->bindParam(':age', $product['age']);
            $stmt_insert->bindParam(':brand_origin', $product['brand_origin']);
            $stmt_insert->bindParam(':sub_images', $product['sub_images']);
            
            $stmt_insert->execute();
        }
    }

    echo "Các sản phẩm đã được thêm vào cơ sở dữ liệu thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

// Đóng kết nối
$conn = null;
?>
