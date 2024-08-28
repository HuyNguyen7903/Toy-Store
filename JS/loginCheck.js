document.addEventListener("DOMContentLoaded", () => {
  const popup = document.getElementById("popup-alert");

  function loginCheck() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Hardcoded users
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

    // Check if there's a registered user in localStorage
    const newUserEmail = localStorage.getItem("NewUserEmail");
    const newUserPassword = localStorage.getItem("NewUserPassword");

    if (newUserEmail && newUserPassword) {
      users.push({
        email: newUserEmail,
        password: newUserPassword,
        name: localStorage.getItem("NewUserName"),
        gender: localStorage.getItem("NewUserGender"),
        phone: localStorage.getItem("NewUserPhone"),
        role: parseInt(localStorage.getItem("NewUserRole"), 10),
      });
    }

    // Find the user with matching email and password
    const user = users.find(
      (user) => user.email === email && user.password === password
    );

    if (user) {
      // Save user information in localStorage for logged-in session
      localStorage.setItem("loggedInUser", user.email);

      localStorage.setItem("loggedInUserGender", user.gender);
      localStorage.setItem("userRole", user.role);

      // Redirect based on user role
      if (user.role === 1) {
        window.location.href = "../admin/index.php";
      } else {
        window.location.href = "../html/user.html";
      }
    } else {
      // Show error message
      popup.style.display = "block";
      document.getElementById("xacnhan").onclick = () => {
        popup.style.display = "none";
        window.location.reload("../html/login.html");
      };
    }
  }

  // Handle login form submission
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", (event) => {
      event.preventDefault();
      loginCheck();
    });
  }

  document
    .getElementById("register-acc")
    .addEventListener("click", function () {
      window.location.href = "../html/register.html";
    });
});
