
/*them san pham vao gio hang*/
document.addEventListener("DOMContentLoaded", () => {
  // Function to update cart count based on items in localStorage
  function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = cart.reduce(
      (total, product) => total + product.quantity,
      0
    );
    const cartCountElement = document.getElementById("cart-count");

    if (totalItems > 0) {
      cartCountElement.classList.add("visible");
      cartCountElement.querySelector("label").innerText = totalItems;
      // Lưu số lượng sản phẩm vào localStorage
      localStorage.setItem("cartCount", totalItems);
    } else {
      cartCountElement.classList.remove("visible");
      // Nếu giỏ hàng trống, lưu giá trị 0 vào localStorage
      localStorage.setItem("cartCount", 0);
    }
  }

  function updateWishlistCount() {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const wishlistCountElement = document.getElementById("wishlist-count");

    if (wishlist.length > 0) {
      wishlistCountElement.classList.add("visible");
      wishlistCountElement.querySelector("label").innerText = wishlist.length;
      // Save the wishlist length to localStorage
      localStorage.setItem("wishlistCount", wishlist.length);
    } else {
      wishlistCountElement.classList.remove("visible");
      // Save the count as 0 to localStorage when wishlist is empty
      localStorage.setItem("wishlistCount", 0);
    }
  }

  // Function to add a product to the cart
  function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const existingProductIndex = cart.findIndex(
      (item) => item.id === product.id
    );

    if (existingProductIndex !== -1) {
      cart[existingProductIndex].quantity += 1;
    } else {
      product.quantity = 1;
      cart.push(product);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    showPopupMessage("cart");
    updateCartCount();
  }

  // Function to add a product to the wishlist
  function addToWishlist(product) {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const existingProductIndex = wishlist.findIndex(
      (item) => item.id === product.id
    );

    if (existingProductIndex === -1) {
      wishlist.push(product);
      localStorage.setItem("wishlist", JSON.stringify(wishlist));
      showPopupMessage("wishlist");
      updateWishlistCount();
    } else {
      showPopupMessage("wishlist-error");
    }
  }

  // Attach event listeners to "Add to cart" buttons
  const addToCartButtons = document.querySelectorAll(".add-to-cart a");
  addToCartButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      const productElement = e.target.closest(".product");
      const product = {
        id: productElement.querySelector("img").alt, // using alt text as a unique id
        name: productElement.querySelector("p").innerText,
        price: parseFloat(
          productElement
            .querySelector(".price")
            .innerText.replace(" Đ", "")
            .replace(/\./g, "") // remove dots
            .replace(",", ".")
        ),
        imgSrc: productElement.querySelector("img").src,
      };
      addToCart(product);
    });
  });

  // Attach event listeners to "Add to wishlist" buttons
  const wishlistButtons = document.querySelectorAll(".heart-icon");
  wishlistButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      const productElement = e.target.closest(".product");
      const product = {
        id: productElement.querySelector("img").alt, // using alt text as a unique id
        name: productElement.querySelector("p").innerText,
        price: parseFloat(
          productElement
            .querySelector(".price")
            .innerText.replace(" Đ", "")
            .replace(/\./g, "") // remove dots
            .replace(",", ".")
        ),
        imgSrc: productElement.querySelector("img").src,
      };
      addToWishlist(product);
    });
  });

  // Call updateCartCount and updateWishlistCount when the page is loaded
  updateCartCount();
  updateWishlistCount();
});

/* POPUP */
// Function to show the popup with specific content
function showPopupMessage(type) {
  const popupContainer = document.getElementById("popup-container");
  const addToCartMessage = document.querySelector("#add-to-cart");
  const addToWishlistMessage = document.querySelector("#wishlist");
  const errorAddToWishlistMessage = document.querySelector("#erorr-wishlist");

  // Hide all messages
  addToCartMessage.style.display = "none";
  addToWishlistMessage.style.display = "none";
  errorAddToWishlistMessage.style.display = "none";

  // Show the relevant message based on the type
  if (type === "cart") {
    addToCartMessage.style.display = "block";
  } else if (type === "wishlist") {
    addToWishlistMessage.style.display = "block";
  } else if (type === "wishlist-error") {
    errorAddToWishlistMessage.style.display = "block";
  }

  // Display the popup
  popupContainer.style.display = "block";

  // Hide the popup after 3 seconds
  setTimeout(() => {
    popupContainer.style.display = "none";
  }, 3000);
}

document.getElementById("close-popup").addEventListener("click", () => {
  document.getElementById("popup-container").style.display = "none";
});

