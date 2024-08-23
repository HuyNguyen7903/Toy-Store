<?php
// Connect to the database
require '../admin/database/connectdb.php';

$tukhoa = trim(strip_tags($_GET['tukhoa']));
$page_size = 12;
$page_num = 1;
if (isset($_GET['page_num'])) {
    $page_num = (int)$_GET['page_num'];
    if ($page_num <= 0) $page_num = 1;
}

function layKetQuaTim($tukhoa, $page_num, $page_size)
{
    global $conn;
    $offset = ($page_num - 1) * $page_size;
    $sql = "SELECT * FROM toy_products WHERE name LIKE :tukhoa OR description LIKE :tukhoa LIMIT :offset, :page_size";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':tukhoa', '%' . $tukhoa . '%', PDO::PARAM_STR);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':page_size', $page_size, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function demSoTin($tukhoa)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM toy_products WHERE name LIKE :tukhoa OR description LIKE :tukhoa";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':tukhoa', '%' . $tukhoa . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function taoLinkPhanTrang($base_url, $total_rows, $page_num, $page_size)
{
    $total_pages = ceil($total_rows / $page_size);
    $pagination = '';
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $page_num) ? 'active' : '';
        $pagination .= '<a href="' . $base_url . '&page_num=' . $i . '" class="' . $active_class . '">' . $i . '</a> ';
    }
    return $pagination;
}
if ($tukhoa != "") $listTin = layKetQuaTim($tukhoa, $page_num, $page_size);
else $listTin = NULL;

$total_rows = demSoTin($tukhoa);
$base_url = "../html/timkiem.php?tukhoa=" . urlencode($tukhoa);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/search.css">
    <script src="../js/toy.js"></script>
    <title>Kết quả tìm kiếm</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>
</head>

<body>
    <div id="header"></div>
    <div class="container-product">
        <h2>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($tukhoa); ?>"</h2>
        <div class="product-list">
            <?php if ($listTin) {
                foreach ($listTin as $tin) {
                    $discount_percentage = $tin['discount_percentage'] > 0 ? '-' . htmlspecialchars($tin['discount_percentage']) . '%' : '';
            ?>
                    <div class="product">
                        <?php if ($discount_percentage) { ?>
                            <div class="discount"><?= $discount_percentage ?></div>
                        <?php } ?>
                        <a href="product_detail.php?product_id=<?= htmlspecialchars($tin['product_id']) ?>">
                            <img src="<?= htmlspecialchars($tin['image_url']) ?>" alt="<?= htmlspecialchars($tin['name']) ?>" />
                        </a>
                        <div class="product-info">
                            <h3><?= htmlspecialchars($tin['name']) ?></h3>
                            <p><?= htmlspecialchars($tin['description']) ?></p>
                            <p class="price">
                                <?php if ($tin['discounted_price'] < $tin['original_price']) { ?>
                                    <span class="old-price"><?= number_format($tin['original_price'], 0, ',', '.') ?> Đ</span>
                                <?php } ?>
                                <?= number_format($tin['discounted_price'], 0, ',', '.') ?> Đ
                            </p>
                            <div class="add-to-cart">
                                <a href="#">Thêm Vào Giỏ Hàng</a>
                                <span class="heart-icon">&#x2764;</span>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <p>Không tìm thấy kết quả nào phù hợp với từ khóa "<?php echo htmlspecialchars($tukhoa); ?>"</p>
            <?php } ?>
        </div>
        <div class="pagination">
            <?php echo taoLinkPhanTrang($base_url, $total_rows, $page_num, $page_size); ?>
        </div>
    </div>
    <div id="footer"></div>
    <div id="popup-container" class="popup-container">
        <div class="popup-content">
            <span id="close-popup" class="close-popup">&times;</span>
            <div id="add-to-cart">
                <img src="../images/checked.png" />
                <h3>Sản phẩm đã được thêm vào giỏ hàng</h3>
            </div>
            <div id="wishlist">
                <img src="../images/checked.png" />
                <h3 id="wishlist">Sản phẩm đã được thêm vào danh sách yêu thích</h3>
            </div>
            <div id="erorr-wishlist">
                <img src="../images/checked.png" />
                <h3 id="erorr-wishlist">Sản phẩm đã có trong danh sách yêu thích</h3>
            </div>
        </div>
    </div>
</body>

</html>