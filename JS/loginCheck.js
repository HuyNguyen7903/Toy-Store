// checkLoginStatus.js

document.addEventListener('DOMContentLoaded', () => {
    const loggedInUser = localStorage.getItem('loggedInUser');

    // Kiểm tra xem có người dùng nào đang đăng nhập không
    if (!loggedInUser) {
        // Nếu không có, chuyển hướng đến trang login.html
        if (!window.location.href.includes('login.html')) {
            window.location.href = 'login.html';
        }
    }

    // Gắn sự kiện submit cho form đăng nhập
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();
            loginCheck();
        });
    }
});

// Hàm kiểm tra thông tin đăng nhập cho trang login.html
function loginCheck() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const users = [
        { email: 'admin@example.com', password: 'admin123' },
        { email: 'tinh@gmail.com', password: 'tinh123' },
        { email: 'huy@gmail.com', password: 'huy123' },
    ];

    const user = users.find(user => user.email === email && user.password === password);

    if (user) {
        // Lưu thông tin người dùng vào localStorage
        localStorage.setItem('loggedInUser', user.email);
        // Chuyển hướng tới trang user.html
        window.location.href = 'user.html';
    } else {
        // Thông báo lỗi
        alert('Email hoặc mật khẩu không đúng!');
    }
}
