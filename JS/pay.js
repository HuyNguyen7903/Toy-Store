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
      const ship=30000;
      const discount = 0; // Change this value based on the discount logic
      const finalAmount = totalAmount - discount + ship;
  
      document.querySelector(".giamgia").innerText = `Giảm giá: ${formatPrice(discount)}`;
      document.querySelector(".vanchuyen").innerText=`Vận chuyển: ${formatPrice(ship)}`;
      document.querySelector(".tongtien").innerText = `Tổng cộng: ${formatPrice(finalAmount)}`;
    }
    document.getElementById("confirm-button").addEventListener("click", () => {
      let cart = JSON.parse(localStorage.getItem("cart")) || [];
    });
    // Call the displayCartItems function when the page is loaded
    displayCartItems();
  });
  
$(document).ready(function () {
    // Payment method selection handling
    $('input[name="payment-method"]').change(function() {
        // Hide all QR codes and credit card inputs
        $('.qr-code').addClass('hidden');
        $('.credit-card-inputs').addClass('hidden');
        
        // Show the corresponding QR code or credit card inputs based on the selected payment method
        if (this.value === 'VNPAY' || this.value === 'Banking') {
            $(this).siblings('.qr-code').removeClass('hidden');
        } else if (this.value === 'credit-card') {
            $(this).siblings('.credit-card-inputs').removeClass('hidden');
        }
    });

    // Expiration date input handling
    $('input[name="ngayhethan"]').on('input', function (e) {
        let value = $(this).val();
    
        // Automatically add '/' after the month
        if (value.length === 2 && e.originalEvent.inputType !== 'deleteContentBackward') {
            $(this).val(value + '/');
            value = $(this).val(); // Update the value after adding the slash
        }
    
        // Validate month and year
        if (value.length === 5) {
            const [MM, YY] = value.split('/').map(num => parseInt(num, 10));
            
            if (MM < 1 || MM > 12 || YY < 23) {
                alert("Tháng và năm hết hạn không hợp lệ");
                $(this).val('');
            }
        }
    });

    
});
document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById("popup-confirm");
    const popupsuccess=document.getElementById("popup-success")
    function showPopup(contentUrl) {
        popup.style.display = 'block'; 
    }

    function hidePopup() {
        popup.style.display = 'none';
    }
    document.getElementById("confirm-button").addEventListener("click", showPopup);

    // Hide popup when the close button is clicked
    $('#huydathang').click(function () {
        $('#popup-confirm').hide();
    });
    $('#xacnhandathang').click(function () {
        popupsuccess.style.display='block';

        let order = {
          id: Date.now(), // Unique ID based on timestamp
          status: "Chờ xác nhận", // Pending confirmation status
          products: JSON.parse(localStorage.getItem("cart")) || [] // Get products from cart
      };

      // Save the order to localStorage
      let orders = JSON.parse(localStorage.getItem("orders")) || [];
      orders.push(order);
      localStorage.setItem("orders", JSON.stringify(orders));

      // Clear the cart after placing the order
      localStorage.removeItem("cart");
    });
    $('#trove').click(function() {
      window.location.href = 'toy.php';});
    $('#xemdonhang').click(function() {
      window.location.href = 'order-status.html';});
});