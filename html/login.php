<?php
session_start();
if (isset($_POST['btn'])) { // tiếp nhận user, pass từ form
    $u = $_POST['username'];
    $p = $_POST['password'];
    //validate dữ liệu tiếp nhận 
    $u = trim(strip_tags($u));
    $p = trim(strip_tags($p)); //truy xuất db 
    require_once("connectdb.php");
    $sql = "SELECT idUser, username, idgroup FROM users WHERE username='{$u}'";
    $kq = $conn->query($sql);
    if ($kq->rowCount() == 0) {
        $_SESSION['thongbao'] = "Username không tồn tại";
        header("location: login.php");
        exit();
    }
    $sql = "SELECT idUser, username, idgroup FROM users WHERE username='{$u}' AND pass='{$p}'";
    $kq = $conn->query($sql);
    if ($kq->rowCount() == 0) { // sai pass 
        $_SESSION['thongbao'] = "Mật khẩu không đúng";
        header("location: login.php"); //login thất bại, login lại 
        exit();
    } //thành công
    $row_user = $kq->fetch();
    $_SESSION['login_id'] = $row_user['idUser']; //tạo biển ghi nhận user đã login 
    $_SESSION['login_user'] = $row_user['username']; //tạo biển ghi nhận user đã login
    $_SESSION['login_group'] = $row_user['idgroup']; //user trong nhóm nào
    header("location: toy.php"); //chuyển đến trang chủ admin 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../images/android-icon-48x48.png" />
    <title>Trang đăng nhập</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#header").load("header.html");
        $("#footer").load("footer.html");
        $("#register-content").load("register.html");
      });
    </script>
</head>
<body>
   <!-- header -->
   <div id="header"></div>

   <!-- form đăng nhập -->
   <div class="login-container">
      <form id="loginForm" action="" method="POST">
        <h1>Đăng Nhập</h1>
        <div class="username-container">
          <label for="username">Tên đăng nhập <span class="required-fields">*</span></label>
          <input type="text" id="username" name="username" required>
        </div>
        
        <label for="password">Mật khẩu <span class="required-fields">*</span></label>
        <div class="password-container">
          <input type="password" id="password" name="password" required>
          <button type="button" onclick="togglePasswordVisibility('password')">
            <i class="fas fa-eye" id="toggleIcon"></i>
          </button>
        </div>
        <button type="submit" name="login">Đăng Nhập</button>
        <a href="/forgot-password" class="forgot-password">Quên mật khẩu?</a>
        <p>Chưa có tài khoản? <a class="register-acc">Đăng ký tài khoản</a></p>
      </form>
    </div>
    
    <div id="popup" class="popup">
      <div class="popup-content">
        <span id="close-popup" class="close-popup">&times;</span>
        <div id="register-content"></div>
      </div>
    </div>
   
   <!-- footer -->
    <div id="footer"></div>
</body>
</html>
