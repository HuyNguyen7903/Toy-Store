document.addEventListener("DOMContentLoaded", () => {
  const accountLink = document.getElementById("account");
  const userRole = localStorage.getItem("userRole");
    
  accountLink.addEventListener("click", function (event) {
    if (userRole==1) {
      accountLink.href ="../admin/index.php";
      }else {
        accountLink.href ="../html/user.html"; 
      }
      window.location.href = accountLink.href;
    });
});