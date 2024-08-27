<?php
// Tiếp nhận email và mật khẩu từ form
$e = $_POST['e'];
$p = $_POST['p'];

// Validate dữ liệu tiếp nhận
$e = trim(strip_tags($e));
$p = trim(strip_tags($p));

// Truy xuất database
require '../admin/database/connectdb.php';

// Truy vấn lấy thông tin người dùng dựa trên email
$sql = "SELECT user_id, username, pass, full_name, phone, is_admin FROM users WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->execute(['email' => $e]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra nếu có người dùng và mật khẩu khớp
if ($user && $user['pass'] === $p) {
    session_start();
    
    // Lưu dữ liệu người dùng vào session
    $_SESSION['login_id'] = $user['user_id'];
    $_SESSION['login_user'] = $user['username'];
    $_SESSION['full_name'] = $user['full_name'];
    $_SESSION['phone'] = $user['phone'];
    $_SESSION['user_role'] = $user['is_admin'];
    
    // Kiểm tra quyền admin và chuyển hướng
    if ($user['is_admin'] == 1) {
        header("Location: ../admin/index.php");
    } else {
        header("Location: ../html/user.html");
    }
    exit();
} else {
    // Nếu không hợp lệ, chuyển hướng đến trang đăng nhập
    header("Location: /html/login.php");
    exit();
}
