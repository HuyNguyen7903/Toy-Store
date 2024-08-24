document.addEventListener("DOMContentLoaded", () => {
  // Function to render orders
  function renderOrders() {
    const orderListContainer = document.getElementById("list-order");
    let orders = JSON.parse(localStorage.getItem("orders")) || [];

    orderListContainer.innerHTML = ""; // Clear the container

    if (orders.length > 0) {
        orders.forEach((order) => {
            const orderItem = document.createElement("div");
            orderItem.className = "order-item";

            let productListHTML = order.products.map(product => `
                <div class="order-product">
                    <img src="${product.imgSrc}" alt="${product.name}" />
                    <div class="product-info">
                        <h3>${product.name}</h3>
                        <p>${product.price.toLocaleString('vi-VN')} Đ</p>
                    </div>
                </div>
            `).join('');

            orderItem.innerHTML = `
                <h2>Đơn hàng #${order.id}</h2>
                <p>Trạng thái: <span id="status">${order.status}</span></p>
                <p><strong>Thông tin người nhận</strong></p>
                <p><span id="user-name"></span> | <span id="user-phone"></p>
                <p class="user-address"><span id="user-address"></span></p>
                <div class="order-products">
                    ${productListHTML}
                </div>
                <button class="remove-order" data-id="${order.id}">Hủy đơn hàng</button>
            `;

            orderListContainer.appendChild(orderItem);

            // Gọi các hàm để hiển thị tên, số điện thoại và địa chỉ của người dùng
            UserInfo(orderItem);
        });

          // Attach event listeners to the "Hủy đơn hàng" buttons
          const removeButtons = document.querySelectorAll(".remove-order");
          removeButtons.forEach((button) => {
              button.addEventListener("click", (e) => {
                  const orderId = e.target.getAttribute("data-id");
                  showPopup(orderId);
              });
          });
      } else {
          orderListContainer.innerHTML = "<p>Không có đơn hàng nào!</p>";
      }
  }
  function UserInfo(orderItem) {
    const userNameElement = orderItem.querySelector("#user-name");
    const userPhoneElement = orderItem.querySelector("#user-phone");
    const addressElement = document.querySelector('.user-address');

    const userName = localStorage.getItem("loggedInUserName");
    const userPhone = localStorage.getItem("loggedInUserPhone");
    const userAddress = JSON.parse(localStorage.getItem('userAddress'));
    
    if (userName) userNameElement.textContent = userName;
    if (userPhone) userPhoneElement.textContent = userPhone;
    if (userAddress) {
        const fullAddress = `${userAddress.street}, ${userAddress.ward}, ${userAddress.district}, ${userAddress.city}`;
        addressElement.innerHTML = `<span class="text-deco"></span> ${fullAddress}`;
    }
}

  // Function to cancel an order
  function huyDonHang(orderId) {
      let orders = JSON.parse(localStorage.getItem("orders")) || [];
      orders = orders.filter((order) => order.id !== parseInt(orderId));
      localStorage.setItem("orders", JSON.stringify(orders));
      renderOrders(); // Re-render the order list
  }

  // Function to show the confirmation popup
  function showPopup(orderId) {
      const popup = document.getElementById("popup-confirm");
      popup.style.display = 'block';

      // Confirm button event
      document.getElementById("xacnhan").onclick = () => {
          huyDonHang(orderId);
          showSuccessPopup();
      };

      // Cancel button event
      document.getElementById("huy").onclick = () => {
          hidePopup();
      };
  }

  // Function to hide the confirmation popup
  function hidePopup() {
      const popup = document.getElementById("popup-confirm");
      popup.style.display = 'none';
  }

  // Function to show the success popup
  function showSuccessPopup() {
      const popupSuccess = document.getElementById("popup-success");
      popupSuccess.style.display = 'block';

      // Redirect to appropriate pages
      document.getElementById("trove").onclick = () => {
          window.location.href = 'toy.php';
      };
      document.getElementById("tatpopup").onclick = () => {
        hidePopup();
        popupSuccess.style.display = 'none';
    };
  }

  // Render orders when the page loads
  renderOrders();
});
