// Hàm kiểm tra thông tin đăng nhập cho trang login.html
function loginCheck() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  const users = [
    { email: "admin@example.com", password: "admin123" },
    { email: "tinh@gmail.com", password: "tinh123" },
    { email: "huy@gmail.com", password: "huy123" },
  ];

  const user = users.find(
    (user) => user.email === email && user.password === password
  );

  if (user) {
    // Lưu thông tin người dùng vào localStorage
    localStorage.setItem("loggedInUser", user.email);
    // Chuyển hướng tới trang user.html
    window.location.href = "user.html";
  } else {
    // Thông báo lỗi
    alert("Email hoặc mật khẩu không đúng!");
  }
}

/* dang xuat logout.js*/

function logout() {
  localStorage.clear();
  window.location.href = "login.html";
}

// Attach the logout function to the button click event.
document.addEventListener("DOMContentLoaded", function () {
  const logoutButton = document.querySelector('button[onclick="logout()"]');
  if (logoutButton) {
    logoutButton.addEventListener("click", logout);
  }
});

/*Kiem tra dang ky tai khoản register*/
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
        password: password.value,
      };
      localStorage.setItem("userDetails", JSON.stringify(userDetails));
      alert("Đăng ký thành công!");
      window.location.href = "./login.html";
    }
  });

  function validateForm() {
    if (password.value == "" || confirmPassword.value == "") {
      alert("Mật khẩu không được để trống!");
      return false;
    }
    if (
      password.value == "" ||
      confirmPassword.value == "" ||
      password.value !== confirmPassword.value
    ) {
      alert("Mật khẩu không khớp!");
      return false;
    }
    if (!validatePhoneNumber(telephone.value)) {
      alert(
        "Số điện thoại không hợp lệ! Số điện thoại phải đủ 10 chữ số và không chứa ký tự chữ."
      );
      return false;
    }
    return true;
  }
  function validatePhoneNumber(phone) {
    const phoneRegex = /^[0-9]{10}$/;
    return phoneRegex.test(phone);
  }
});

/* an hien mat khau o dang nhap va dang ky */
function togglePasswordVisibility(id) {
  const passwordField = document.getElementById(id);
  const icon = passwordField.nextElementSibling.querySelector("i");

  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}
/*them san pham vao gio hang*/
document.addEventListener("DOMContentLoaded", () => {
  const addToCartButtons = document.querySelectorAll(".add-to-cart a");
  const cartCountElement = document.getElementById("cart-count");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      const productElement = e.target.closest(".product");
      const product = {
        id: productElement.querySelector("img").alt, // using alt text as a unique id
        name: productElement.querySelector("p").innerText,
        price: parseFloat(
          productElement
            .querySelector(".price")
            .innerText.replace(" Đ", "")
            .replace(".", "")
            .replace(",", ".")
        ),
        imgSrc: productElement.querySelector("img").src,
      };
      addToCart(product);
    });
  });

  function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const existingProductIndex = cart.findIndex(
      (item) => item.id === product.id
    );

    if (existingProductIndex !== -1) {
      cart[existingProductIndex].quantity += 1;
    } else {
      product.quantity = 1;
      cart.push(product);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Sản phẩm đã được thêm vào giỏ hàng!");
    updateCartCount();
  }

  function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = cart.reduce(
      (total, product) => total + product.quantity,
      0
    );
    cartCountElement.innerText = totalItems;
  }

  updateCartCount();
});

/* thay doi chu dang nhap thanh ten user */
window.onload = function () {
  const loggedInUser = localStorage.getItem("loggedInUser");
  if (loggedInUser) {
    const loginLink = document.querySelector(
      '.navigation-top a[href="./user.html"]'
    );
    if (loginLink) {
      const username = loggedInUser.split("@")[0]; // Lấy phần trước dấu @
      loginLink.textContent = `Xin chào, ${username}`;
      loginLink.href = "./user.html";
    }
  }
};
