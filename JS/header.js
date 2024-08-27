window.onload = function () {
  const loginLink = document.getElementById("linkdangnhap");

  // Debugging: Log localStorage values
  console.log("loggedInUser:", localStorage.getItem("loggedInUser"));
  console.log("userRole:", localStorage.getItem("userRole"));
  console.log("loggedInUserName:", localStorage.getItem("loggedInUserName"));

  const loggedInUser = localStorage.getItem("loggedInUser");
  const userRole = localStorage.getItem("userRole");
  const loggedInUserName = localStorage.getItem("loggedInUserName");

  if (loggedInUser) {
      loginLink.innerText = `Xin chào, ${loggedInUserName}`;
      loginLink.addEventListener("click", function (event) {
          event.preventDefault();
          if (userRole == 1) {
              window.location.href = "../admin/index.php";
          } else {
              window.location.href = "../html/user.html";
          }
      });
  } else {
      loginLink.addEventListener("click", function () {
          window.location.href = "../html/login.html";
      });
  }
};
