document.addEventListener('DOMContentLoaded', () => {
    const loggedInUser = localStorage.getItem('loggedInUser');
    const popup = document.getElementById("popup");
    const closePopupBtn = document.getElementById("close-popup");
    const registerContent = document.getElementById("register-content");

    // Check if the user is logged in
    if (!loggedInUser) {
        if (!window.location.href.includes('login.html')) {
            window.location.href = 'login.html';
        }
    }
    // Handle login form submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();
            loginCheck();
        });
    }

    // Function to show the popup and load register.html
    function showPopup() { 
            popup.style.display = "block";
    }

    // Function to hide the popup
    function hidePopup() { 
        popup.style.display = "none"; 
    } 

    // Show popup when "Đăng ký tài khoản" link is clicked
    document.querySelector(".register-acc").addEventListener("click", showPopup);

    // Hide popup when the close button is clicked
    closePopupBtn.addEventListener("click", hidePopup);
});
