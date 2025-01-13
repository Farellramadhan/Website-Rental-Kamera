<?php
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
$message = $_POST['message'];

// Query untuk menyimpan data pesan
$sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Pesan berhasil dikirim!"); location.href="index.html";</script>';
} else {
    echo '<script>alert("Terjadi kesalahan saat mengirim pesan. Silakan coba lagi."); location.href="index.html";</script>';
}

// Tutup koneksi
$conn->close();
?>