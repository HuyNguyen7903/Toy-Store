<?php
session_start(); // Khởi động session

require '../admin/database/connectdb.php'; // Kết nối cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra xem email có tồn tại trong database hay không
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Lỗi truy vấn: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['password'])) {
            // Đăng nhập thành công
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];
    
            header("Location: toy.php");
            exit();
        } else {
            echo "Mật khẩu không đúng!";
        }
    } else {
        echo "Email không tồn tại!";
    }

    $stmt->close(); // Đóng câu lệnh sau khi thực hiện xong
}

$conn->close(); // Đóng kết nối sau khi hoàn tất
?>
