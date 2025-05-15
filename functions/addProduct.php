<?php
include "connect.php";

// Ambil dan amankan data dari POST
$name  = htmlspecialchars($_POST['name'] ?? '');
$code  = htmlspecialchars($_POST['code'] ?? '');
$costPrice = (int) ($_POST['cost_price'] ?? 0);
$price = (int) ($_POST['price'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);

// Validasi sederhana
if (!$name || !$code || $costPrice <= 0 || $price <= 0 || $stock < 0) {
    header("Location: ../index.php?page=produk&failed=Mohon isi semua field.");
    exit();
}

// Insert ke database
$stmt = $conn->prepare("INSERT INTO products (name, code, cost_price, price, stock) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiii", $name, $code, $costPrice, $price, $stock);

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
