<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/admin_pro_mag.css" />
    <link rel="shortcut icon" href="../images/android-icon-48x48.png" />
    <script src="../JS/toy.js"></script>
    <!-- jQuery for AJAX requests -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#header").load("../html/header.html");
            $("#footer").load("../html/footer.html");
            loadProducts();
        });
    </script>
    <title>Quản Lý Sản Phẩm</title>
</head>

<body>
    <!-- header -->
    <div id="header"></div>
    <div class="main-content">
        <h1 class="center-text">Quản Lý Sản Phẩm</h1>
        <div class="content-wrapper">
            <div class="sidebar">
                <h2>Chức Năng</h2>
                <a href="./user-management.html">Danh Sách Sản Phẩm</a>
                <a href="./user-management.html">Chỉnh Sửa Sản Phẩm</a>
                <a href="../admin/product-management.php">Xóa Sản Phẩm</a>
                <a href="../admin/index.php">Trang Quản Trị</a>
                <a style=" cursor: pointer;" onclick="logout()">Đăng xuất</a>
            </div>
            <div class="info">
                <div class="info-container">
                    <div class="section">
                        <h3>Thêm Sản Phẩm Mới</h3>
                        <form id="add-product-form" method="post" action="add_product.php">
                            <label for="name">Tên Sản Phẩm:</label>
                            <input type="text" id="name" name="name" required>
                            <label for="brand">Thương Hiệu:</label>
                            <input type="text" id="brand" name="brand" required>
                            <label for="original_price">Giá Gốc:</label>
                            <input type="number" id="original_price" name="original_price" required>
                            <label for="discounted_price">Giá Giảm:</label>
                            <input type="number" id="discounted_price" name="discounted_price" required>
                            <label for="discount_percentage">Phần Trăm Giảm:</label>
                            <input type="number" id="discount_percentage" name="discount_percentage" required>
                            <label for="quantity">Số Lượng:</label>
                            <input type="number" id="quantity" name="quantity" required>
                            <label for="description">Mô Tả:</label>
                            <textarea id="description" name="description" required></textarea>
                            <label for="detailed_description">Mô Tả Chi Tiết:</label>
                            <textarea id="detailed_description" name="detailed_description"></textarea>
                            <label for="image_url">URL Hình Ảnh:</label>
                            <textarea id="image_url" name="image_url" rows="3" required></textarea>
                            <label for="sub_images">Hình Ảnh Phụ (cách nhau bằng dấu phẩy):</label>
                            <textarea id="sub_images" name="sub_images" rows="3"></textarea>
                            <label for="theme">Chủ Đề:</label>
                            <input type="text" id="theme" name="theme">
                            <label for="origin">Xuất Xứ:</label>
                            <input type="text" id="origin" name="origin">
                            <label for="code">Mã:</label>
                            <input type="text" id="code" name="code">
                            <label for="age">Độ Tuổi:</label>
                            <input type="text" id="age" name="age">
                            <label for="brand_origin">Nguồn Gốc Thương Hiệu:</label>
                            <input type="text" id="brand_origin" name="brand_origin">

                            <button type="submit">Thêm Sản Phẩm</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#add-product-form").on("submit", function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'add_product.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response);
                        loadProducts();
                    },
                    error: function() {
                        alert("Có lỗi xảy ra trong quá trình gửi dữ liệu.");
                    }
                });
            });
        });
    </script>
    <div id="footer"></div>

</body>

</html>