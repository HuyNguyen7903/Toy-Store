document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.getElementById('cart-items');
    const totalElement = document.getElementById('total');

    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartItemsContainer.innerHTML = '';

        cart.forEach(product => {
            const productElement = document.createElement('div');
            productElement.className = 'product';
            productElement.innerHTML = `
                <img src="${product.imgSrc}" alt="${product.id}" />
                <div class="product-info">
                    <h3>${product.name}</h3>
                    <p class="price">${product.price.toLocaleString()} Đ</p>
                    <div class="quantity">
                        <button class="decrease-quantity" data-id="${product.id}">-</button>
                        <span>${product.quantity}</span>
                        <button class="increase-quantity" data-id="${product.id}">+</button>
                    </div>
                    <button class="remove-product" data-id="${product.id}">Xóa</button>
                </div>
            `;
            cartItemsContainer.appendChild(productElement);
        });

        updateTotal();
    }

    function updateTotal() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        let totalItems = 0;
        let totalPrice = 0;

        cart.forEach(product => {
            totalItems += product.quantity;
            totalPrice += product.quantity * product.price;
        });

        totalElement.innerText = `${totalItems} sản phẩm`;
        document.querySelector('.tienhang').innerText = `Tiền Hàng hóa: ${totalPrice.toLocaleString()} Đ`;
        document.querySelector('.tongtien').innerText = `Tổng cộng: ${totalPrice.toLocaleString()} Đ`;
    }

    cartItemsContainer.addEventListener('click', (e) => {
        const productId = e.target.getAttribute('data-id');
        if (e.target.classList.contains('remove-product')) {
            removeFromCart(productId);
        } else if (e.target.classList.contains('increase-quantity')) {
            changeQuantity(productId, 1);
        } else if (e.target.classList.contains('decrease-quantity')) {
            changeQuantity(productId, -1);
        }
    });

    function removeFromCart(productId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart = cart.filter(product => product.id !== productId);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
    }

    function changeQuantity(productId, delta) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart = cart.map(product => {
            if (product.id === productId) {
                product.quantity += delta;
                if (product.quantity < 1) product.quantity = 1;
            }
            return product;
        });
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
    }

    loadCart();
});
