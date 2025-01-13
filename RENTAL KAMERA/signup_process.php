<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental_kamera";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if account already exists
$sql = "SELECT * FROM users WHERE email = ? OR name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Akun dengan email atau nama yang sama sudah ada.']);
    $stmt->close();
    $conn->close();
    exit();
}

// Insert new account
$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, password_hash($password, PASSWORD_DEFAULT));

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.']);
}

$stmt->close();
$conn->close();
?>