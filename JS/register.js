document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        if (validateForm()) {
            const userDetails = {
                firstName: form["first-name"].value,
                lastName: form["last-name"].value,
                telephone: form["telephone"].value,
                gender: form["gender"].value,
                email: form["email"].value,
                password: password.value
            };
            localStorage.setItem('userDetails', JSON.stringify(userDetails));
            alert("Đăng ký thành công!");
            window.location.href = "./login.html";
        }
    });

    function validateForm() {
        if (password.value==""|| confirmPassword.value=="" ) {
            alert("Mật khẩu không được để trống!");
            return false;
        }
        if (password.value==""|| confirmPassword.value=="" ||password.value !== confirmPassword.value) {
            alert("Mật khẩu không khớp!");
            return false;
        }
        if (!validatePhoneNumber(telephone.value)) {
            alert("Số điện thoại không hợp lệ! Số điện thoại phải đủ 10 chữ số và không chứa ký tự chữ.");
            return false;
        }
        return true;
    }
    function validatePhoneNumber(phone) {
        const phoneRegex = /^[0-9]{10}$/;
        return phoneRegex.test(phone);
    }
});


