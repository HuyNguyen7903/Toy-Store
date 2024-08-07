const cartItems = [
    {
        id: 1,
        name: "Ba Lô Easy Go Emoji World Hồng CLEVERHIPPO BM0106",
        price: 467000,
        quantity: 1,
        image: "https://example.com/image1.jpg"  // replace with actual image URL
    },
    {
        id: 2,
        name: "Đồ Chơi Lắp Ráp Thùng Gạch Lớn Classic Sáng Tạo LEGO CLASSIC 10698",
        price: 1920000,
        quantity: 1,
        image: "https://example.com/image2.jpg"  // replace with actual image URL
    }
];

function renderCart() {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalPriceElement = document.getElementById('total-price');

    cartItemsContainer.innerHTML = '';
    let totalPrice = 0;

    cartItems.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.classList.add('cart-item');

        itemElement.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="item-details">
                <h2>${item.name}</h2>
                <p>${item.price.toLocaleString()} Đ</p>
            </div>
            <div class="item-quantity">
                <button onclick="updateQuantity(${item.id}, -1)">-</button>
                <span>${item.quantity}</span>
                <button onclick="updateQuantity(${item.id}, 1)">+</button>
            </div>
        `;

        cartItemsContainer.appendChild(itemElement);
        totalPrice += item.price * item.quantity;
    });

    totalPriceElement.textContent = totalPrice.toLocaleString();
}

function updateQuantity(itemId, change) {
    const item = cartItems.find(item => item.id === itemId);
    if (item) {
        item.quantity += change;
        if (item.quantity < 1) {
            item.quantity = 1;
        }
        renderCart();
    }
}

renderCart();
