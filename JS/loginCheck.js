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

