// Sample user data to be saved in localStorage
const userData = {
    name: "Thai Tinh",
    email: "tinhthaili5122003@gmail.com",
    phone: "+84 0857201553",
    billingAddress: "48b Nguyen thi thoi, Ho Chi Minh Quebec 123456799, Canada",
    shippingAddress: "48b Nguyen thi thoi, Ho Chi Minh Quebec 123456799, Canada",
    pointBalance: 0,
    nextReward: 200
};

// Save the user data to localStorage (only run this part once to set the data)
// localStorage.setItem('user', JSON.stringify(userData));

// Fetch user data from localStorage
const user = JSON.parse(localStorage.getItem('user'));

// Display user data on the page
document.getElementById('user-name').textContent = user.name;
document.getElementById('user-email').textContent = user.email;
document.getElementById('user-phone').textContent = user.phone;
document.getElementById('billing-address').textContent = user.billingAddress;
document.getElementById('shipping-address').textContent = user.shippingAddress;
document.getElementById('point-balance').textContent = `${user.pointBalance}pts`;
document.getElementById('next-reward').textContent = user.nextReward;

// Update progress bar width
const progressBarInner = document.getElementById('progress-bar-inner');
progressBarInner.style.width = `${(user.pointBalance / user.nextReward) * 100}%`;
