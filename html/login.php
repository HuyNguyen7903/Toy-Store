<?php
$error_message = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'wrong_password') {
        $error_message = 'Mật khẩu không đúng.';
    } elseif ($_GET['error'] == 'user_not_found') {
        $error_message = 'Email không tồn tại.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../images/android-icon-48x48.png" />
    <link rel="shortcut icon" href="../" />
    <title>Trang đăng nhâp</title>
    <script src="../JS/toy.js"></script>
    <script src="../JS/login.js"></script>
    <script src="../JS/hidepass.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#header").load("header.html");
        $("#footer").load("footer.html");
      });
    </script>
<body>
   <!-- header -->
   <div id="header"></div>
  <!-- form dang nhap -->
  <div class="login-container">
  <form id="loginForm" action="logincheck.php" method="POST">
    <h1>Đăng Nhập</h1>

    <?php if ($error_message): ?>
        <div class="error-message">
            <p><?php echo $error_message; ?></p>
        </div>
    <?php endif; ?>

    <label for="email">Email <span class="required-fields">*</span></label>
    <input type="email" id="e" name="e" required>

    <label for="password">Mật khẩu <span class="required-fields">*</span></label>
    <div class="password-container">
        <input type="password" id="p" name="p" required>
        <button type="button" onclick="togglePasswordVisibility('p')">
            <i class="fas fa-eye" id="toggleIcon"></i>
        </button>
    </div>
    <button id="dangnhap" type="submit">Đăng Nhập</button>
    <a href="/forgot-password" class="forgot-password">Quên mật khẩu?</a>
    <p>Chưa có tài khoản? <a href="../html/register.php" id="register-acc">Đăng ký tài khoản</a></p>
</form>
    </div>
     <!-- popup -->
     <div id="popup-alert" class="popup-alert"> 
      <div class="popup-content-alert">
          <div class="alert">
              <img src="../images/warning.png" alt="">
              <h3>Email và mật khẩu không đúng</h3>
              <div class="button-group">
                  <button id="xacnhan">Nhập lại</button>
              </div>
          </div>
      </div>
   <!-- footer -->
    <!-- <div id="footer"></div> -->
</body>
</html>
