<?php
// Connect to the database
include 'connectdb.php';

$tukhoa = trim(strip_tags($_GET['tukhoa']));
$page_size = 5;
$page_num = 1;
if (isset($_GET['page_num'])) $page_num = $_GET['page_num'] + 0;
if ($page_num <= 0) $page_num = 1;

function layKetQuaTim($tukhoa, $page_num, $page_size) {
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

function demSoTin($tukhoa) {
    global $conn;
    $sql = "SELECT COUNT(*) FROM toy_products WHERE name LIKE :tukhoa OR description LIKE :tukhoa";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':tukhoa', '%' . $tukhoa . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function taoLinkPhanTrang($base_url, $total_rows, $page_num, $page_size) {
    $total_pages = ceil($total_rows / $page_size);
    $pagination = '';
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination .= '<a href="' . $base_url . '&page_num=' . $i . '">' . $i . '</a> ';
    }
    return $pagination;
}

if ($tukhoa != "") $listTin = layKetQuaTim($tukhoa, $page_num, $page_size);
else $listTin = NULL;
$count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/toy.js"></script>
    <title>Kết quả tìm kiếm</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
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
                    $count++;
            ?>
                <div class="product">
                    <div class="product-img">
                        <a href="product.php?id=<?= $tin['id'] ?>">
                            <img src="<?= htmlspecialchars($tin['image_url']) ?>" alt="<?= htmlspecialchars($tin['name']) ?>">
                        </a>
                    </div>
                    <div class="product-info">
                        <h3><a href="product.php?id=<?= $tin['id'] ?>"><?= htmlspecialchars($tin['name']) ?></a></h3>
                        <p><?= htmlspecialchars($tin['description']) ?></p>
                        <div class="price">
                            <span class="old-price"><?= number_format($tin['original_price'], 0, ',', '.') ?> Đ</span>
                            <span><?= number_format($tin['discounted_price'], 0, ',', '.') ?> Đ</span>
                        </div>
                        <div class="add-to-cart">
                            <a href="add_to_cart.php?id=<?= $tin['id'] ?>" class="add-to-cart-btn">Thêm Vào Giỏ Hàng</a>
                            <span class="heart-icon">&#10084;</span>
                        </div>
                    </div>
                </div>
            <?php } 
            } else { ?>
                <p>Không tìm thấy kết quả nào phù hợp với từ khóa "<?php echo htmlspecialchars($tukhoa); ?>"</p>
            <?php } ?>
        </div>
    </div>
    <div id="footer"></div>
</body>
</html>
<?php
$total_rows = demSoTin($tukhoa);
$base_url = "index.php?page=search&tukhoa=" . urlencode($tukhoa);
echo taoLinkPhanTrang($base_url, $total_rows, $page_num, $page_size);
?>
