<?php
// Kết nối với cơ sở dữ liệu
require '../admin/database/connectdb.php';

// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn chi tiết sản phẩm dựa trên ID
$sql = "SELECT * FROM toy_products WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// Kiểm tra kết quả truy vấn
if ($stmt->rowCount() > 0) {
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Giả sử `sub_images` lưu trữ nhiều URL hình ảnh dưới dạng JSON
    $sub_images = json_decode($product['sub_images'], true);
} else {
    echo 'Sản phẩm không tồn tại.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../images/android-icon-48x48.png" />
    <link rel="stylesheet" href="../css/product.css" />
    <script src="../JS/toy.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>

    <title><?php echo htmlspecialchars($product['name']); ?></title>
</head>

<body>
    <div id="header"></div>
    <div class="product-container">
        <div class="product-image-section">
            <img
                id="main-image"
                src="<?php echo htmlspecialchars($product['image_url']); ?>"
                alt="<?php echo htmlspecialchars($product['name']); ?>" />
            <div class="thumbnail-section">
                <button class="prev-btn">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <div class="thumbnails">
                    <?php
                    foreach ($sub_images as $image) {
                        echo '<img src="' . htmlspecialchars($image) . '" onclick="changeImage(this)" />';
                    }
                    ?>
                </div>
                <button class="next-btn">
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="product-info-section">
            <div class="product-name">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <span class="heart-icon">&#x2764;</span>
            </div>
            <p class="brand-text">Thương hiệu: <a href="#"><?php echo htmlspecialchars($product['brand']); ?></a></p>
            <div class="price-section">
                <span class="original-price"><?php echo number_format($product['original_price'], 0, ',', '.'); ?> Đ</span>
                <span class="discounted-price"><?php echo number_format($product['discounted_price'], 0, ',', '.'); ?> Đ</span>
                <?php if ($product['discount_percentage'] > 0): ?>
                    <span class="discount">-<?php echo htmlspecialchars($product['discount_percentage']); ?>%</span>
                <?php endif; ?>
            </div>
            <button class="exclusive-offer">
                <h3>Giá độc quyền khi mua trên website</h3>
            </button>
            <ul class="shipping-info">
                <li><i class="fa-solid fa-check"></i>Hàng Chính Hãng</li>
                <li><i class="fa-solid fa-check"></i>Miễn Phí Giao Hàng Toàn Quốc Đơn Từ 500k</li>
                <li><i class="fa-solid fa-check"></i>Giao Hàng Hỏa Tốc 4 Tiếng</li>
            </ul>

            <div class="quantity-section">
                <label for="quantity"></label>
                <div class="quantity-input">
                    <button class="decrease-btn">-</button>
                    <input type="number" id="quantity" value="1" min="1" />
                    <button class="increase-btn">+</button>
                </div>
                <button class="add-to-cart">Thêm Vào Giỏ Hàng</button>
            </div>

            <div class="product-details">
                <h2>Thông tin sản phẩm</h2>
                <ul>
                    <li>Chủ đề: <?php echo htmlspecialchars($product['theme']); ?></li>
                    <li>Xuất xứ: <?php echo htmlspecialchars($product['origin']); ?></li>
                    <li>Mã: <?php echo htmlspecialchars($product['code']); ?></li>
                    <li>Tuổi: <?php echo htmlspecialchars($product['age']); ?></li>
                    <li>Thương hiệu: <?php echo htmlspecialchars($product['brand']); ?></li>
                    <li>Thương hiệu Xuất Xứ: <?php echo htmlspecialchars($product['brand_origin']); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-description-section">
        <h2>Mô tả sản phẩm</h2>
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <div><?php echo $product['detailed_description']; ?></div>
    </div>
    <div id="footer"></div>
    <script src="../JS/product.js"></script>
</body>

</html>

<?php
// Đóng kết nối
$conn = null;
?>