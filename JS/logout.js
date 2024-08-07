// logout.js

function logout() {
    // Perform any logout operations here, such as clearing cookies or local storage.
    // For example:
    // localStorage.removeItem('userToken');

    localStorage.clear();
    window.location.href = 'login.html';
}

// Attach the logout function to the button click event.
document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.querySelector('button[onclick="logout()"]');
    if (logoutButton) {
        logoutButton.addEventListener('click', logout);
    }
});
