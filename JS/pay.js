document.addEventListener("DOMContentLoaded", () => {
    // Function to format the price with currency
    function formatPrice(price) {
      return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
      }).format(price);
    }
  
    // Function to display cart items in the pay.html page
    function displayCartItems() {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      const productContainer = document.querySelector(".product");
  
      if (cart.length === 0) {
        productContainer.innerHTML = "<p>Giỏ hàng của bạn đang trống.</p>";
        return;
      }
  
      let totalAmount = 0;
      cart.forEach((item) => {
        const itemTotal = item.quantity * item.price;
        totalAmount += itemTotal;
  
        const productDiv = document.createElement("div");
        productDiv.classList.add("product-item");
        productDiv.innerHTML = `
          <div class="img-product">
            <img src="${item.imgSrc}" alt="${item.name}" />
            <p class="product-name">${item.name}</p>
            </div>
          <div class="product-info">
            
            <p class="product-quantity">Số lượng: ${item.quantity}</p>
            <p class="product-price">Giá: ${formatPrice(item.price)}</p>
            <p class="product-total">Tổng: ${formatPrice(itemTotal)}</p>
          </div>
        `;
  
        productContainer.appendChild(productDiv);
      });
  
      // Display total amount
      document.querySelector(".tienhang").innerText = `Tiền Hàng hóa: ${formatPrice(totalAmount)}`;
  
      // Handle discount (assuming a discount can be applied)
      const discount = 0; // Change this value based on the discount logic
      const finalAmount = totalAmount - discount;
  
      document.querySelector(".giamgia").innerText = `Giảm giá: ${formatPrice(discount)}`;
      document.querySelector(".tongtien").innerText = `Tổng cộng: ${formatPrice(finalAmount)}`;
    }
  
    // Call the displayCartItems function when the page is loaded
    displayCartItems();
  });
  