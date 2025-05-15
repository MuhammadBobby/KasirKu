<?php
include "connect.php";

// Ambil dan amankan data dari POST
$name  = htmlspecialchars($_POST['name'] ?? '');
$code  = htmlspecialchars($_POST['code'] ?? '');
$price = (int) ($_POST['price'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);

// Validasi sederhana
if (!$name || !$code || $price <= 0 || $stock < 0) {
    header("Location: ../index.php?page=produk&failed=Mohon isi semua field.");
    exit();
}

// Insert ke database
$stmt = $conn->prepare("INSERT INTO products (name, code, price, stock) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $name, $code, $price, $stock);

if ($stmt->execute()) {
    // Redirect balik ke halaman produk atau tampilkan pesan
    header("Location: ../index.php?page=produk&success=Berhasil menambahkan produk.");
    exit();
} else {
    // Redirect balik ke halaman produk atau tampilkan pesan
    header("Location: ../index.php?page=produk&failed=Gagal menambahkan produk.");
    exit();
}

$stmt->close();
$conn->close();
