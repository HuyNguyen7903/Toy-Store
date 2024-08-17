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
        'description' => 'Đồ Chơi Siêu Xe Khủng Long T-Rex Hot Whells',
        'image_url' => '../images/HW-TRex.png'
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
            $sql_insert = "INSERT INTO toy_products (name, brand, original_price, discounted_price, discount_percentage, quantity, description, image_url) VALUES (:name, :brand, :original_price, :discounted_price, :discount_percentage, :quantity, :description, :image_url)";
            $stmt_insert = $conn->prepare($sql_insert);

            $stmt_insert->bindParam(':name', $product['name']);
            $stmt_insert->bindParam(':brand', $product['brand']);
            $stmt_insert->bindParam(':original_price', $product['original_price']);
            $stmt_insert->bindParam(':discounted_price', $product['discounted_price']);
            $stmt_insert->bindParam(':discount_percentage', $product['discount_percentage']);
            $stmt_insert->bindParam(':quantity', $product['quantity']);
            $stmt_insert->bindParam(':description', $product['description']);
            $stmt_insert->bindParam(':image_url', $product['image_url']);
            
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
