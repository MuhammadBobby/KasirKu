<?php
include "connect.php";

// Ambil dan amankan data dari POST
$productId = (int) ($_POST['product_id'] ?? 0);
$name      = htmlspecialchars($_POST['name'] ?? '');
$code      = htmlspecialchars($_POST['code'] ?? '');
$price     = (int) ($_POST['price'] ?? 0);


// Validasi sederhana
if (!$productId || !$name || !$code || $price <= 0) {
    header("Location: ../index.php?page=produk&failed=Mohon isi semua field.");
    exit();
}

// Update ke database
$stmt = $conn->prepare("UPDATE products SET name = ?, code = ?, price = ? WHERE id = ?");
$stmt->bind_param("ssii", $name, $code, $price, $productId);

if ($stmt->execute()) {
    header("Location: ../index.php?page=produk&success=Berhasil mengubah produk.");
    exit();
} else {
    header("Location: ../index.php?page=produk&failed=Gagal mengubah produk.");
    exit();
}

$stmt->close();
$conn->close();
