<?php
// Kết nối với cơ sở dữ liệu
require '../admin/database/connectdb.php';

// Truy vấn dữ liệu sản phẩm
$sql = "SELECT * FROM toy_products";
$result = $conn->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="product">';
        if ($row['discount_percentage'] > 0) {
            echo '<div class="discount">-' . htmlspecialchars($row['discount_percentage']) . '%</div>';
        }
        // Tạo liên kết đến trang chi tiết sản phẩm
        echo '<a href="product_detail.php?id=' . htmlspecialchars($row['id']) . '">';
        echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '" />';
        echo '</a>';
        echo '<div class="product-info">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
        echo '<p class="price">';
        if ($row['discounted_price'] < $row['original_price']) {
            echo '<span class="old-price">' . number_format($row['original_price'], 0, ',', '.') . ' Đ</span> ';
        }
        echo number_format($row['discounted_price'], 0, ',', '.') . ' Đ';
        echo '</p>';
        echo '<div class="add-to-cart">';
        echo '<a href="#">Thêm Vào Giỏ Hàng</a>';
        echo '<span class="heart-icon">&#x2764;</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Không có sản phẩm nào.';
}

// Đóng kết nối
$conn = null;
