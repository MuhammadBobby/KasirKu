<?php
include "connect.php";

$productId = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$productId) {
    header("Location: ../index.php?page=produk&failed=Mohon kirim ID produk.");
    exit();
}

// cek apakah product id ada di pake di transaksi item
$stmt = $conn->prepare("SELECT COUNT(*) AS count_usage FROM transaction_items WHERE product_id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count_usage'] > 0) {
    // Produk sedang dipakai di transaksi, tidak boleh dihapus
    header("Location: ../index.php?page=produk&failed=Produk sedang dipakai di transaksi, tidak boleh dihapus.");
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
