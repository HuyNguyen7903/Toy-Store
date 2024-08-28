<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin-order-mag.css" />
    <link rel="shortcut icon" href="../images/android-icon-48x48.png" />
    <script src="../js/toy.js"></script>
    <script src="../js/logout.js"></script>
    <!-- jQuery for AJAX requests -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#header").load("../html/header.html");
            $("#footer").load("../html/footer.html");
        });

        document.addEventListener("DOMContentLoaded", () => {
            function formatPrice(price) {
                return new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                }).format(price);
            }

            function renderOrders() {
                const orderListContainer = document.getElementById("list-order");
                let orders = JSON.parse(localStorage.getItem("orders")) || [];

                orderListContainer.innerHTML = "";

                if (orders.length > 0) {
                    orders.forEach((order) => {
                        const orderItem = document.createElement("div");
                        orderItem.className = "order-item";

                        // Tính tổng số tiền cho đơn hàng
                        let totalAmount = 0;
                        let productListHTML = order.products.map(product => {
                            totalAmount += product.price * product.quantity;
                            return `
                                <div class="order-product">
                                    <img src="${product.imgSrc}" alt="${product.name}" />
                                    <div class="product-info">
                                        <h3>${product.name}</h3>
                                        <p>${product.price.toLocaleString('vi-VN')} Đ</p>
                                        <p>Số lượng: ${product.quantity}</p>
                                    </div>
                                </div>
                            `;
                        }).join('');

                        orderItem.innerHTML = `
                            <h2>Đơn hàng #${order.id}</h2>
                            <p>Trạng thái: <span id="status">${order.status}</span></p>
                            <p><strong>Thông tin người nhận</strong></p>
                            <p><span id="user-name"></span> | <span id="user-phone"></span></p>
                            <p><span id="user-address"></span></p>
                            <p><strong>Phương thức thanh toán:</strong> <span id="payment-method"></span></p>
                            <div class="order-products">
                                ${productListHTML}
                            </div>
                            <div class="order-total">
                                <p class="tienhang">Tiền Hàng hóa: ${formatPrice(totalAmount)}</p>
                                <p class="giamgia">Giảm giá: ${formatPrice(order.discount || 0)}</p>
                                <p class="vanchuyen">Vận chuyển: ${formatPrice(order.shipping || 30000)}</p>
                                <p class="tongtien">Tổng cộng: ${formatPrice(
                                totalAmount - (order.discount || 0) + (order.shipping || 30000)
                                )}</p>
                            </div>
                            <select class="order-status-select" data-id="${order.id}">
                                <option value="Chờ xác nhận" ${order.status === "Chờ xác nhận" ? "selected" : ""}>Chờ xác nhận</option>
                                <option value="Đang Giao" ${order.status === "Đang Giao" ? "selected" : ""}>Đang Giao</option>
                                <option value="Đã Giao" ${order.status === "Đã Giao" ? "selected" : ""}>Đã Giao</option>
                            </select>
                            <button class="remove-order" data-id="${order.id}">Hủy đơn hàng</button>
                        `;

                        orderListContainer.appendChild(orderItem);

                        UserInfo(orderItem);
                        displayPaymentMethod(orderItem);
                    });

                    document.querySelectorAll('.order-status-select').forEach(select => {
                        select.addEventListener('change', function() {
                            const orderId = this.getAttribute('data-id');
                            updateOrderStatus(orderId, this.value);
                        });
                    });

                    document.querySelectorAll(".remove-order").forEach((button) => {
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
                const addressElement = orderItem.querySelector("#user-address");

                const userName = localStorage.getItem("loggedInUserName");
                const userPhone = localStorage.getItem("loggedInUserPhone");
                const userAddress = JSON.parse(localStorage.getItem('userAddress'));

                if (userName) userNameElement.textContent = userName;
                if (userPhone) userPhoneElement.textContent = userPhone;
                if (userAddress) {
                    const fullAddress = `${userAddress.street} ${userAddress.ward}, ${userAddress.district}, ${userAddress.city}`;
                    addressElement.textContent = fullAddress;
                }
            }

            function displayPaymentMethod(orderItem) {
                const paymentMethodElement = orderItem.querySelector("#payment-method");
                const paymentMethod = localStorage.getItem("Payment");
                paymentMethodElement.textContent = paymentMethod;
            }

            function updateOrderStatus(orderId, newStatus) {
                let orders = JSON.parse(localStorage.getItem("orders")) || [];
                orders = orders.map(order => {
                    if (order.id == orderId) {
                        order.status = newStatus;
                    }
                    return order;
                });
                localStorage.setItem("orders", JSON.stringify(orders));
                renderOrders();
            }

            function huyDonHang(orderId) {
                let orders = JSON.parse(localStorage.getItem("orders")) || [];
                orders = orders.filter(order => order.id !== parseInt(orderId));
                localStorage.setItem("orders", JSON.stringify(orders));
                renderOrders();
            }

            function showPopup(orderId) {
                const popup = document.getElementById("popup-confirm");
                popup.style.display = 'block';
                document.getElementById("popup-confirm-order-id").textContent = `Đơn hàng #${orderId}`;

                document.getElementById("xacnhan").onclick = () => {
                    huyDonHang(orderId);
                    hidePopup();
                    showSuccessPopup();
                };

                document.getElementById("huy").onclick = () => {
                    hidePopup();
                };
            }

            function hidePopup() {
                const popup = document.getElementById("popup-confirm");
                popup.style.display = 'none';
            }

            function showSuccessPopup() {
                const popupSuccess = document.getElementById("popup-success");
                popupSuccess.style.display = 'block';

                document.getElementById("trove").onclick = () => {
                    window.location.href = 'order-management.php';
                };
                document.getElementById("tatpopup").onclick = () => {
                    popupSuccess.style.display = 'none';
                };
            }

            renderOrders();
        });
    </script>
    <title>Quản Lý Đơn Hàng</title>
</head>

<body>
    <div id="header"></div>
    <div class="main-content">
        <h1 class="center-text">Danh Sách Đơn Hàng</h1>
        <div class="content-wrapper">
            <div class="sidebar">
                <h2>Chức Năng</h2>
                <a href="../admin/product-management.php">Thêm sản phẩm</a>
                <a href="../admin/index.php">Trang Quản Trị</a>
                <a style="cursor: pointer;" onclick="logout()">Đăng xuất</a>
            </div>
            <div class="info">
                <div id="list-order" class="info-container">
                    <!-- Orders will be rendered here by JavaScript -->
                </div>
            </div>
        </div>
    </div>
    <div id="footer"></div>

    <!-- Popup Confirm -->
    <div id="popup-confirm">
        <h3>Xác Nhận Hủy Đơn Hàng</h3>
        <p id="popup-confirm-order-id"></p>
        <div class="popup-buttons">
            <button id="xacnhan">Xác Nhận</button>
            <button id="huy">Hủy</button>
        </div>
    </div>

    <!-- Popup Success -->
    <div id="popup-success">
        <h3>Đơn hàng đã được hủy thành công!</h3>
        <div class="popup-buttons">
            <button id="trove">Trở về danh sách đơn hàng</button>
            <button id="tatpopup">Đóng</button>
        </div>
    </div>
</body>

</html>