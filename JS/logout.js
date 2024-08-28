function logout() {
  localStorage.removeItem("loggedInUser");
  localStorage.removeItem("userRole");
  // Preserve user information
  window.location.href = "../html/login.html";
}

// Attach the logout function to the button click event.
document.addEventListener("DOMContentLoaded", function () {
  const logoutButton = document.querySelector('button[onclick="logout()"]');
  if (logoutButton) {
    logoutButton.addEventListener("click", logout);
  }
});
