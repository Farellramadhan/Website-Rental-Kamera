<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_kamera";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Koneksi gagal: ' . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari request
    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $camera = $data['camera'];
    $days = $data['days'];
    $startDate = $data['startDate'];
    $endDate = $data['endDate'];
    $totalPrice = $data['totalPrice'];
    $status = $data['status'];

    // Query untuk menyimpan data pesanan
    $sql = "INSERT INTO orders (name, email, phone, camera, days, startDate, endDate, totalPrice, status) VALUES ('$name', '$email', '$phone', '$camera', '$days', '$startDate', '$endDate', '$totalPrice', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        error_log('Error: ' . $sql . ' - ' . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Mengambil data pesanan
    $result = $conn->query("SELECT * FROM orders");
    $orders = [];

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    echo json_encode($orders);
}

// Tutup koneksi
$conn->close();
?>