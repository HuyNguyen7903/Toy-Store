// Giả sử bạn gửi yêu cầu đăng nhập qua AJAX và nhận phản hồi từ máy chủ
fetch('/path/to/your/login.php', {
    method: 'POST',
    body: new URLSearchParams({
        'e': emailInputValue,
        'p': passwordInputValue
    })
})
.then(response => response.json())
.then(data => {
    if (data.status === 'success') {
        const user = data.user;
        localStorage.setItem("loggedInUser", user.email);
        localStorage.setItem("loggedInUserName", user.name);
        localStorage.setItem("loggedInUserPhone", user.phone);
        localStorage.setItem("userRole", user.role);
        // Tiến hành các bước tiếp theo sau khi đăng nhập thành công
    } else {
        // Xử lý khi đăng nhập thất bại
        alert(data.message);
    }
})
.catch(error => console.error('Error:', error));
