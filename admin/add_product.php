<?php

require '../admin/database/connectdb.php';

// Kiểm tra xem form có được submit không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $original_price = $_POST['original_price'];
    $discounted_price = $_POST['discounted_price'];
    $discount_percentage = $_POST['discount_percentage'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $detailed_description = $_POST['detailed_description'];
    $image_url = $_POST['image_url'];
    $theme = $_POST['theme'];
    $origin = $_POST['origin'];
    $code = $_POST['code'];
    $age = $_POST['age'];
    $brand_origin = $_POST['brand_origin'];
    $sub_images = json_encode(explode(',', $_POST['sub_images']));

    // Câu lệnh SQL kiểm tra sản phẩm theo mã sản phẩm
    $sql_check = "SELECT COUNT(*) FROM toy_products WHERE code = :code";

    try {
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':code', $code);
        $stmt_check->execute();

        if ($stmt_check->fetchColumn() == 0) {
            // Nếu sản phẩm chưa tồn tại, thực hiện chèn
            $sql_insert = "INSERT INTO toy_products 
            (name, brand, original_price, discounted_price, discount_percentage, quantity, description, detailed_description, image_url, theme, origin, code, age, brand_origin, sub_images) 
            VALUES 
            (:name, :brand, :original_price, :discounted_price, :discount_percentage, :quantity, :description, :detailed_description, :image_url, :theme, :origin, :code, :age, :brand_origin, :sub_images)";
            $stmt_insert = $conn->prepare($sql_insert);

            $stmt_insert->bindParam(':name', $name);
            $stmt_insert->bindParam(':brand', $brand);
            $stmt_insert->bindParam(':original_price', $original_price);
            $stmt_insert->bindParam(':discounted_price', $discounted_price);
            $stmt_insert->bindParam(':discount_percentage', $discount_percentage);
            $stmt_insert->bindParam(':quantity', $quantity);
            $stmt_insert->bindParam(':description', $description);
            $stmt_insert->bindParam(':detailed_description', $detailed_description);
            $stmt_insert->bindParam(':image_url', $image_url);
            $stmt_insert->bindParam(':theme', $theme);
            $stmt_insert->bindParam(':origin', $origin);
            $stmt_insert->bindParam(':code', $code);
            $stmt_insert->bindParam(':age', $age);
            $stmt_insert->bindParam(':brand_origin', $brand_origin);
            $stmt_insert->bindParam(':sub_images', $sub_images);

            $stmt_insert->execute();
            echo "Sản phẩm đã được thêm vào cơ sở dữ liệu thành công!";
        } else {
            echo "Sản phẩm này đã tồn tại trong cơ sở dữ liệu.";
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }

    // Đóng kết nối
    $conn = null;
}
