/* thay doi chu dang nhap thanh ten user */
window.onload = function () {
    const loggedInUser = localStorage.getItem("loggedInUser");
    const userRole = localStorage.getItem("userRole");
    const loggedInUserName = localStorage.getItem("loggedInUserName");
    if (loggedInUser) {
      const loginLink = document.getElementById("linkdangnhap");
  
      if (loginLink) {
        loginLink.textContent = `Xin chào, ${loggedInUserName}`;
  
        // Đổi URL dựa trên role của người dùng khi click vào link
        loginLink.addEventListener("click", function (event) {
          event.preventDefault(); // Ngăn không cho liên kết hoạt động ngay
          loginLink.href = userRole == 1 ? "../admin/index.php" : "./user.html";
          window.location.href = loginLink.href; // Chuyển hướng khi click
        });
      }
      updateCartCount();
      updateWishlistCount();
    } else { $('#linkdangnhap').click(function () {
      window.location.href="../html/login.html";
    });
    }
  };