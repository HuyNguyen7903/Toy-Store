let currentImageIndex = 0;
const thumbnails = document.querySelectorAll(".thumbnails img");
const mainImage = document.getElementById("main-image");

function updateMainImage() {
  mainImage.src = thumbnails[currentImageIndex].src;
  thumbnails.forEach((thumbnail) => thumbnail.classList.remove("active"));
  thumbnails[currentImageIndex].classList.add("active");
}

function changeImage(element) {
  currentImageIndex = Array.from(thumbnails).indexOf(element);
  updateMainImage();
}
document.querySelector(".prev-btn").addEventListener("click", () => {
  currentImageIndex =
    currentImageIndex > 0 ? currentImageIndex - 1 : thumbnails.length - 1;
  updateMainImage();
});
document.querySelector(".next-btn").addEventListener("click", () => {
  currentImageIndex =
    currentImageIndex < thumbnails.length - 1 ? currentImageIndex + 1 : 0;
  updateMainImage();
});
document.addEventListener("DOMContentLoaded", () => {
  updateMainImage();
});
document.addEventListener("DOMContentLoaded", () => {
  // Cập nhật số lượng sản phẩm trong giỏ hàng
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
    } else {
      cartCountElement.classList.remove("visible");
    }
  }

  // Cập nhật số lượng sản phẩm trong danh sách yêu thích
  function updateWishlistCount() {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const wishlistCountElement = document.getElementById("wishlist-count");
    if (wishlist.length > 0) {
      wishlistCountElement.classList.add("visible");
      wishlistCountElement.querySelector("label").innerText = wishlist.length;
    } else {
      wishlistCountElement.classList.remove("visible");
    }
  }

  // Thêm sản phẩm vào giỏ hàng
  function addToCart(product) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const existingProductIndex = cart.findIndex(
      (item) => item.id === product.id
    );

    if (existingProductIndex !== -1) {
      cart[existingProductIndex].quantity += product.quantity;
    } else {
      cart.push(product);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Sản phẩm đã được thêm vào giỏ hàng!");
    updateCartCount();
  }

  // Thêm sản phẩm vào danh sách yêu thích
  function addToWishlist(product) {
    let wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];
    const existingProductIndex = wishlist.findIndex(
      (item) => item.id === product.id
    );

    if (existingProductIndex === -1) {
      wishlist.push(product);
      localStorage.setItem("wishlist", JSON.stringify(wishlist));
      alert("Sản phẩm đã được thêm vào danh sách yêu thích!");
      updateWishlistCount();
    } else {
      alert("Sản phẩm đã có trong danh sách yêu thích!");
    }
  }

  // Gắn sự kiện cho nút "Thêm vào giỏ hàng"
  const addToCartButton = document.querySelector(".add-to-cart");
  addToCartButton.addEventListener("click", (e) => {
    e.preventDefault();
    const productElement = e.target.closest(".product-info-section");
    const product = {
      id: productElement.querySelector("h2").innerText, // Sử dụng tên sản phẩm làm ID duy nhất
      name: productElement.querySelector("h2").innerText,
      price: parseFloat(
        productElement
          .querySelector(".discounted-price")
          .innerText.replace(" Đ", "")
          .replace(/\./g, "") // loại bỏ dấu chấm
          .replace(",", ".")
      ),
      quantity: parseInt(document.getElementById("quantity").value), // Lấy số lượng đã chọn
      imgSrc: document.getElementById("main-image").src,
    };
    addToCart(product);
  });

  // Gắn sự kiện cho nút "Thêm vào yêu thích"
  const wishlistButton = document.querySelector(".heart-icon");
  wishlistButton.addEventListener("click", (e) => {
    e.preventDefault();
    const productElement = e.target.closest(".product-info-section");
    const product = {
      id: productElement.querySelector("h2").innerText, // Sử dụng tên sản phẩm làm ID duy nhất
      name: productElement.querySelector("h2").innerText,
      price: parseFloat(
        productElement
          .querySelector(".discounted-price")
          .innerText.replace(" Đ", "")
          .replace(/\./g, "") // loại bỏ dấu chấm
          .replace(",", ".")
      ),
      imgSrc: document.getElementById("main-image").src,
    };
    addToWishlist(product);
  });

  // Gọi hàm updateCartCount và updateWishlistCount khi trang được tải
  updateCartCount();
  updateWishlistCount();
});

document.addEventListener("DOMContentLoaded", () => {
  const decreaseBtn = document.querySelector(".decrease-btn");
  const increaseBtn = document.querySelector(".increase-btn");
  const quantityInput = document.getElementById("quantity");

  decreaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  });

  increaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
  });
});
