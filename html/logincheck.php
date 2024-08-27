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
$sql = "SELECT user_id, username, pass FROM users WHERE email=:email";
$stmt = $conn->prepare($sql);
$stmt->execute(['email' => $e]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra nếu có người dùng và mật khẩu khớp
if ($user && $user['pass'] === $p) {
    session_start();
    $_SESSION['login_id'] = $user['user_id'];
    $_SESSION['login_user'] = $user['username']; 

    $response = [
        'status' => 'success',
        'user' => [
            'email' => $e,
            'name' => $user['full_name'] ?? $user['username'],
            'phone' => $user['phone'],
            'role' => $user['is_admin'], // 1 for admin, 0 for user
        ]
    ];
    echo json_encode($response);
    header("Location: toy.php");
    exit();
} else {
    header("Location: login.php?error=invalid_credentials");
    $response = ['status' => 'error', 'message' => 'Invalid credentials'];
    echo json_encode($response);
    exit();
}
