document.addEventListener("DOMContentLoaded", () => {
    // Function to render wishlist items
    function renderWishlist() {
      const wishlistItemsContainer = document.getElementById("white-list-items");
      let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
  
      wishlistItemsContainer.innerHTML = ""; // Clear the container
  
      if (wishlist.length > 0) {
        wishlist.forEach((product) => {
          const productItem = document.createElement("div");
          productItem.className = "wishlist-product";
  
          productItem.innerHTML = `
            <img src="${product.imgSrc}" alt="${product.name}" />
            <div class="product-info">
              <h3>${product.name}</h3>
              <p>${product.price.toLocaleString('vi-VN')} Đ</p>
            </div>
            <button class="add-cart">Thêm vào giỏ hàng</button>
            <button class="remove-wishlist-item" data-id="${product.id}">Hủy đơn</button>
          `;
  
          wishlistItemsContainer.appendChild(productItem);
        });
  
        // Attach event listeners to remove buttons
        const removeButtons = document.querySelectorAll(".remove-wishlist-item");
        removeButtons.forEach((button) => {
          button.addEventListener("click", (e) => {
            const productId = e.target.getAttribute("data-id");
            removeWishlistItem(productId);
          });
        });
      } else {
        wishlistItemsContainer.innerHTML = "<p>Danh sách yêu thích trống!</p>";
      }
    }
    // Function to handle adding product to cart from the wishlist
    function handleAddToCartFromWishlist(event) {
        const productElement = event.target.closest(".wishlist-product");
        const product = {
        id: productElement.querySelector("img").alt, // using alt text as a unique id
        name: productElement.querySelector("h3").innerText,
        price: parseFloat(
            productElement
            .querySelector("p")
            .innerText.replace(" Đ", "")
            .replace(/\./g, "") // remove dots
            .replace(",", ".")
        ),
        imgSrc: productElement.querySelector("img").src,
        };
        addToCart(product); // Call the existing addToCart function from toy.js
  }
  
  // Attach event listeners to the "Add to Cart" buttons in the wishlist
    const addCartButtons = document.querySelectorAll(".add-cart");
    addCartButtons.forEach((button) => {
    button.addEventListener("click", handleAddToCartFromWishlist);
  });
  
  
    // Function to remove item from wishlist
    function removeWishlistItem(productId) {
      let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
      wishlist = wishlist.filter((item) => item.id !== productId);
      localStorage.setItem("wishlist", JSON.stringify(wishlist));
      renderWishlist(); // Re-render the wishlist
    }
  
    // Render wishlist when the page loads
    renderWishlist();
  });
  