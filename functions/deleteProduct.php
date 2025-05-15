<?php
include "connect.php";

$productId = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$productId) {
    header("Location: ../index.php?page=produk&failed=Mohon kirim ID produk.");
    exit();
}

// Hapus data produk
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param("i", $productId);

if ($stmt->execute()) {
    header("Location: ../index.php?page=produk&success=Berhasil menghapus produk.");
    exit();
} else {
    header("Location: ../index.php?page=produk&failed=Gagal menghapus produk.");
    exit();
}

$conn->close();
