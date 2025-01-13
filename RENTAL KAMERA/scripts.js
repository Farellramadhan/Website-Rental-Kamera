function showPage(page) {
    document.querySelectorAll('.page').forEach(function(p) {
        p.classList.remove('active');
    });
    document.getElementById(page).classList.add('active');
}

let selectedCamera;
let cameraPrice;

function openModal(camera, price) {
    selectedCamera = camera;
    cameraPrice = price;
    document.getElementById('modalTitle').textContent = `Sewa ${camera}`;
    document.getElementById('rentalModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('rentalModal').style.display = 'none';
}

function calculateTotal() {
    const days = document.getElementById('rentalDays').value || 1;
    const totalPrice = days * cameraPrice;
    document.getElementById('totalPrice').textContent = `Rp ${totalPrice.toLocaleString()}`;
}

function submitOrder() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const rentalDays = document.getElementById('rentalDays').value || 1;
    const totalPrice = rentalDays * cameraPrice;

    const order = {
        camera: selectedCamera,
        rentalDays,
        totalPrice,
        name,
        email
    };

    const orderList = document.getElementById('ordersList');
    const orderItem = document.createElement('div');
    orderItem.className = 'order-card';
    orderItem.innerHTML = `
        <h3>${order.camera}</h3>
        <p>${order.rentalDays} hari - Rp ${order.totalPrice.toLocaleString()}</p>
        <p>Nama: ${order.name}</p>
        <p>Email: ${order.email}</p>
    `;
    orderList.appendChild(orderItem);

    closeModal();
}