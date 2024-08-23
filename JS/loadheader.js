window.onload = function () {
    // Load cart and wishlist items
    loadCart();
    renderWishlist();

    // Update cart and wishlist counts in the header
    updateCartCount();
    updateWishlistCount();

    // Retrieve counts from localStorage and update header
    const cartCount = localStorage.getItem("cartCount") || 0;
    const wishlistCount = localStorage.getItem("wishlistCount") || 0;

    const cartCountElement = document.getElementById("cart-count");
    const wishlistCountElement = document.getElementById("wishlist-count");

    // Update cart count display
    if (cartCount > 0) {
        cartCountElement.classList.add("visible");
        cartCountElement.querySelector("label").innerText = cartCount;
    } else {
        cartCountElement.classList.remove("visible");
    }

    // Update wishlist count display
    if (wishlistCount > 0) {
        wishlistCountElement.classList.add("visible");
        wishlistCountElement.querySelector("label").innerText = wishlistCount;
    } else {
        wishlistCountElement.classList.remove("visible");
    }
};
