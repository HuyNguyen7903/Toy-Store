<?php 
// Get the base name of the current page
$currentPage = basename($_SERVER['REQUEST_URI'], ".php");
// Replace hyphens with spaces
$currentPage = str_replace("-", " ", $currentPage);
$currentPage = preg_replace('/\?page=\d+/', '', $currentPage);
$currentPage = preg_replace('/\?id=\d+/', '', $currentPage);
$currentPage = preg_replace('/\?name=.*/', '', $currentPage);
// Capitalize the first letter of each word
$currentPage = ucwords($currentPage);
switch($currentPage){
    case "Products":
        $currentPage = "Sản phẩm";
        break;
    case "Categories":
        $currentPage = "Danh mục";
        break;
    case "Orders":
        $currentPage = "Đơn hàng";
        break;
    case "Customers":
        $currentPage = "Khách hàng";
        break;
    case "Add Products":
        $currentPage = "Thêm sản phẩm";
        break;
    case "Add Categories":
        $currentPage = "Thêm danh mục";
        break;
    case "Add Customers":
        $currentPage = "Thêm khách hàng";
        break;
    case "Edit Products":
        $currentPage = "Sửa sản phẩm";
        break;
    case "Edit Categories":
        $currentPage = "Sửa sản phẩm";
        break;
    case "Edit Customers":
        $currentPage = "Sửa khách hàng";
        break;
}
?> 
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $currentPage ?></li>
    </ol>
</nav>