window.onload = function() {
    const loggedInUser = localStorage.getItem('loggedInUser');
    if (loggedInUser) {
      const loginLink = document.querySelector('.navigation-top a[href="./user.html"]');
      if (loginLink) {
        const username = loggedInUser.split('@')[0]; // Lấy phần trước dấu @
        loginLink.textContent = `Xin chào, ${username}`;
        loginLink.href = "./user.html";
      }
    }
  };