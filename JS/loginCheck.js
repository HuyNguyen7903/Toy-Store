document.addEventListener('DOMContentLoaded', () => {
    const loggedInUser = localStorage.getItem('loggedInUser');
    const popup = document.getElementById("popup");
    const closePopupBtn = document.getElementById("close-popup");
    const registerContent = document.getElementById("register-content");

    // Check if the user is logged in
    if (!loggedInUser) {
        if (!window.location.href.includes('login.html')) {
            window.location.href = 'login.html';
        }
    }

    function loginCheck() {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
      
        const users = [
          { email: "admin@example.com", password: "admin123", role: 1 },
          {
            email: "tinh@gmail.com",
            password: "tinh123",
            name: "Tinh",
            gender: "Nam",
            role: 0,
          },
          {
            email: "huy@gmail.com",
            password: "huy123",
            name: "Huy",
            gender: "Nam",
            role: 1,
          },
        ];
      
        const user = users.find(
          (user) => user.email === email && user.password === password
        );
      
        if (user) {
          // Lưu thông tin người dùng vào localStorage
          localStorage.setItem("loggedInUser", user.email);
          localStorage.setItem("loggedInUserName", user.name);
          localStorage.setItem("loggedInUserPhone", user.phone);
          localStorage.setItem("loggedInUserGender", user.gender);
          localStorage.setItem("userRole", user.role);
      
      
          if (user.role ==1) {
            window.location.href = "../admin/index.php";
          } else {
            window.location.href = "../html/user.html";
          }
        } else {
          // Thông báo lỗi
          alert("Email hoặc mật khẩu không đúng!");
        }
      }
    // Handle login form submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();
            loginCheck();
        });
    }

    // Function to show the popup and load register.html
    function showPopup() { 
            popup.style.display = "block";
    }

    // Function to hide the popup
    function hidePopup() { 
        popup.style.display = "none"; 
    } 

    // Show popup when "Đăng ký tài khoản" link is clicked
    document.querySelector(".register-acc").addEventListener("click", showPopup);

    // Hide popup when the close button is clicked
    closePopupBtn.addEventListener("click", hidePopup);
});
