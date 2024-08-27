<?php
// Kết nối đến cơ sở dữ liệu MySQL bằng PDO
require '../admin/database/connectdb.php';

try {
    // Thiết lập chế độ lỗi PDO để ngoại lệ
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Xử lý form đăng ký khi người dùng nhấn nút submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $telephone = $_POST['telephone'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        // Kiểm tra xem mật khẩu và xác nhận mật khẩu có trùng khớp không
        if ($password !== $confirmPassword) {
            die("Mật khẩu và xác nhận mật khẩu không trùng khớp!");
        }

        // Ghép họ và tên đầy đủ
        $fullName = $firstName . " " . $lastName;

        // Chuẩn bị câu lệnh SQL để thêm người dùng mới
        $stmt = $conn->prepare("INSERT INTO users (username, email, pass, full_name, phone)
                                VALUES (:username, :email, :password, :full_name, :phone)");
        
        // Gán các giá trị vào câu lệnh SQL
        $stmt->bindParam(':username', $fullName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':full_name', $fullName);
        $stmt->bindParam(':phone', $telephone);

        // Thực thi câu lệnh
        $stmt->execute();

        echo "<script>alert('Đăng ký thành công!'); window.location.href = 'login.php';</script>";
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}

// Đóng kết nối bằng cách gán biến PDO thành null
$conn = null;
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/register.css" />
    <link rel="shortcut icon" href="../images/android-icon-48x48.png" />
    <script src="../js/toy.js"></script>
    <!-- <script src="../JS/register.js"></script> -->
    <script src="../JS/hidepass.js"></script>
    <title>Tạo tài khoản</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
      $(document).ready(function () {
        $("#header").load("header.html");
        $("#footer").load("footer.html");
      });
    </script> -->
  </head>
  <body>
    <!-- header -->
    <div id="header"></div>
    <!-- form dang ky -->
    <div class="form-container">
        <h1>Đăng Ký</h1>
        <!-- Thêm action và method vào form -->
        <form id="registerForm" action="register.php" method="POST">
            <div class="form-group">
                <label for="first-name">Họ <span class="required-fields">*</span></label>
                <input type="text" id="first-name" name="first-name" required />
            </div>
            <div class="form-group">
                <label for="last-name">Tên <span class="required-fields">*</span></label>
                <input type="text" id="last-name" name="last-name" required />
            </div>
            <div class="form-group">
                <label for="telephone">Số điện thoại <span class="required-fields">*</span></label>
                <input type="tel" id="telephone" name="telephone" required placeholder="+84 Số điện thoại"/>
                <p class="sdt">
                    Số điện thoại này dùng để nhận OTP khi đổi điểm tích luỹ, sử dụng code sinh nhật
                </p>
            </div>
            <div class="form-group">
                <label for="gender">Giới tính <span class="required-fields">*</span></label>
                <select id="gender" name="gender" required>
                    <option value="">Chọn</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email <span class="required-fields">*</span></label>
                <input type="email" id="email" name="email" required />
            </div>
            <div class="pass">
                <div class="form-group password-container">
                    <label for="password">Mật khẩu*</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"/>
                    <button type="button" onclick="togglePasswordVisibility('password')"><i class="fas fa-eye"></i></button>
                </div>
                <div class="form-group password-container">
                    <label for="confirm-password">Nhập lại mật khẩu*</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Nhập lại mật khẩu"/>
                    <button type="button" onclick="togglePasswordVisibility('confirm-password')"><i class="fas fa-eye"></i></button>
                </div>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="terms" name="terms" required />
                <label for="terms">Tôi đã đọc và đồng ý với <a href="#">Điều khoản sử dụng</a> và <a href="#">Chính sách Thành viên thân thiết My Points</a>.</label>
            </div>
            <button id="submitButton" type="submit">Đăng ký</button>
            <div class="checkbox-group">
                <input type="checkbox" id="newsletter" name="newsletter" />
                <p for="newsletter">Nhận Thông Báo Tin Tức</p>
            </div>
            <p>Đã có tài khoản? <a href="../html/login.html">Đăng nhập</a></p>
        </form>
    </div>

    <!-- popup -->
    <div id="popup-confirm" class="popup-confirm"> 
      <div class="popup-content-confirm">
          <div class="alert-confirm">
              <img src="../images/checked.png" alt="">
              <h3>Đăng ký thành công</h3>
              <div class="button-group">
                  <button id="xacnhan">Đăng nhập</button>
              </div>
          </div>
      </div>
    <!-- footer -->
    <div id="footer"></div>
  </body>
</html>
