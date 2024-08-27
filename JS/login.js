document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Gửi yêu cầu AJAX đến logincheck.php
    fetch('../html/logincheck.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            e: email,
            p: password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const user = data.user;

            // Lưu thông tin người dùng vào localStorage
            localStorage.setItem("loggedInUser", user.email);
            localStorage.setItem("loggedInUserName", user.name);
            localStorage.setItem("loggedInUserPhone", user.phone || '');
            localStorage.setItem("userRole", user.role);

            // Chuyển hướng dựa trên vai trò của người dùng
            if (user.role === 1) {
                window.location.href = "../admin/index.php";
            } else {
                window.location.href = "../html/user.html";
            }
        } else {
            alert(data.message); // Hiển thị thông báo lỗi
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});
