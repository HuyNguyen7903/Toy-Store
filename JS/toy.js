// Hàm kiểm tra thông tin đăng nhập cho trang login.html
function loginCheck() {
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  const users = [
    { email: "admin@example.com", password: "admin123", role: "admin" },
    {
      email: "tinh@gmail.com",
      password: "tinh123",
      name: "Tinh",
      gender: "Nam",
      role: "user",
    },
    {
      email: "huy@gmail.com",
      password: "huy123",
      name: "Huy",
      gender: "Nam",
      role: "admin",
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

    if (user.role === "admin") {
      window.location.href = "../admin/index.php";
    } else {
      window.location.href = "../html/user.html";
    }
  } else {
    // Thông báo lỗi
    alert("Email hoặc mật khẩu không đúng!");
  }
}
/* hien thi thong tin khach hang*/
function displayLoggedInUserInfo() {
  document.addEventListener("DOMContentLoaded", function () {
    const loggedInUserEmail = localStorage.getItem("loggedInUser");
    const loggedInUserName = localStorage.getItem("loggedInUserName");
    const loggedInUserPhone = localStorage.getItem("loggedInUserPhone");
    const loggedInUserGender = localStorage.getItem("loggedInUserGender");

    if (loggedInUserEmail) {
      /*check thong tin email*/
      const emailElement = document.querySelector(".email-user");
      if (emailElement) {
        emailElement.textContent = `Email: ${loggedInUserEmail}`;
      } else {
        console.error("Email element not found.");
      }

      /*check thong tin ten*/
      const nameElement = document.querySelector(".user-name");
      if (nameElement) {
        nameElement.textContent = `Họ và tên: ${loggedInUserName}`;
      } else {
        console.error("Name element not found.");
      }

      /*check thong tin dien thoai*/
      const phoneElement = document.querySelector(".user-phone");
      if (phoneElement) {
        phoneElement.textContent = `Điện thoại: ${loggedInUserPhone}`;
      } else {
        console.error("Phone element not found.");
      }

      /*check thong tin gioi tinh*/
      const genderElement = document.querySelector(".gender");
      if (genderElement) {
        genderElement.textContent = `Giới tính: ${loggedInUserGender}`;
      } else {
        console.error("Gender element not found.");
      }
    } else {
      // alert("Vui lòng đăng nhập tài khoản");
      // window.location.href = "login.html";
    }
  });
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
  // Function to update cart count based on items in localStorage
  function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = cart.reduce(
      (total, product) => total + product.quantity,
      0
    );
    const cartCountElement = document.getElementById("cart-count");

    if (totalItems > 0) {
      cartCountElement.classList.add("visible");
      cartCountElement.querySelector("label").innerText = totalItems;
      // Lưu số lượng sản phẩm vào localStorage
      localStorage.setItem("cartCount", totalItems);
    } else {
      cartCountElement.classList.remove("visible");
      // Nếu giỏ hàng trống, lưu giá trị 0 vào localStorage
      localStorage.setItem("cartCount", 0);
    }
  }

  function updateWishlistCount() {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const wishlistCountElement = document.getElementById("wishlist-count");

    if (wishlist.length > 0) {
      wishlistCountElement.classList.add("visible");
      wishlistCountElement.querySelector("label").innerText = wishlist.length;
      // Save the wishlist length to localStorage
      localStorage.setItem("wishlistCount", wishlist.length);
    } else {
      wishlistCountElement.classList.remove("visible");
      // Save the count as 0 to localStorage when wishlist is empty
      localStorage.setItem("wishlistCount", 0);
    }
  }

  // Function to add a product to the cart
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
    showPopupMessage("cart");
    updateCartCount();
  }

  // Function to add a product to the wishlist
  function addToWishlist(product) {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const existingProductIndex = wishlist.findIndex(
      (item) => item.id === product.id
    );

    if (existingProductIndex === -1) {
      wishlist.push(product);
      localStorage.setItem("wishlist", JSON.stringify(wishlist));
      showPopupMessage("wishlist");
      updateWishlistCount();
    } else {
      showPopupMessage("wishlist-error");
    }
  }

  // Attach event listeners to "Add to cart" buttons
  const addToCartButtons = document.querySelectorAll(".add-to-cart a");
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
            .replace(/\./g, "") // remove dots
            .replace(",", ".")
        ),
        imgSrc: productElement.querySelector("img").src,
      };
      addToCart(product);
    });
  });

  // Attach event listeners to "Add to wishlist" buttons
  const wishlistButtons = document.querySelectorAll(".heart-icon");
  wishlistButtons.forEach((button) => {
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
            .replace(/\./g, "") // remove dots
            .replace(",", ".")
        ),
        imgSrc: productElement.querySelector("img").src,
      };
      addToWishlist(product);
    });
  });

  // Call updateCartCount and updateWishlistCount when the page is loaded
  updateCartCount();
  updateWishlistCount();
});

/* POPUP */
// Function to show the popup with specific content
function showPopupMessage(type) {
  const popupContainer = document.getElementById("popup-container");
  const addToCartMessage = document.querySelector("#add-to-cart");
  const addToWishlistMessage = document.querySelector("#wishlist");
  const errorAddToWishlistMessage = document.querySelector("#erorr-wishlist");

  // Hide all messages
  addToCartMessage.style.display = "none";
  addToWishlistMessage.style.display = "none";
  errorAddToWishlistMessage.style.display = "none";

  // Show the relevant message based on the type
  if (type === "cart") {
    addToCartMessage.style.display = "block";
  } else if (type === "wishlist") {
    addToWishlistMessage.style.display = "block";
  } else if (type === "wishlist-error") {
    errorAddToWishlistMessage.style.display = "block";
  }

  // Display the popup
  popupContainer.style.display = "block";

  // Hide the popup after 3 seconds
  setTimeout(() => {
    popupContainer.style.display = "none";
  }, 5000);
}

document.getElementById("close-popup").addEventListener("click", () => {
  document.getElementById("popup-container").style.display = "none";
});
/* thay doi chu dang nhap thanh ten user */
window.onload = function () {
  const loggedInUser = localStorage.getItem("loggedInUser");
  if (loggedInUser) {
    const loginLink = document.querySelector(
      '.navigation-top a[href="./user.html"]'
    );
    if (loginLink) {
      const loggedInUserName = localStorage.getItem("loggedInUserName");
      loginLink.textContent = `Xin chào, ${loggedInUserName}`;
      loginLink.href = "./user.html";
    }
  }
};
