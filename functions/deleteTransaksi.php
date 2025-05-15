<?php
require 'connect.php';

$transactionId = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$transactionId) {
    header("Location: ../index.php?page=transaksi&failed=Mohon kirim ID transaksi.");
    exit();
}

// Ambil semua item dalam transaksi untuk update stok produk
$getItems = $conn->prepare("SELECT product_id, quantity FROM transaction_items WHERE transaction_id = ?");
$getItems->bind_param("i", $transactionId);
$getItems->execute();
$result = $getItems->get_result();

if ($result->num_rows == 0) {
    header("Location: ../index.php?page=transaksi&failed=Transaksi tidak ditemukan dengan ID tersebut. Mohon kirimkan ID yang benar.");
    exit();
}

while ($row = $result->fetch_assoc()) {
    // Kembalikan stok ke produk
    $updateStock = $conn->prepare("UPDATE products SET stock = stock + ? WHERE id = ?");
    $updateStock->bind_param("ii", $row['quantity'], $row['product_id']);
    $updateStock->execute();
    $updateStock->close();
}

$getItems->close();

// Hapus dari transaction_items
$deleteItems = $conn->prepare("DELETE FROM transaction_items WHERE transaction_id = ?");
$deleteItems->bind_param("i", $transactionId);
$deleteItems->execute();
$deleteItems->close();

// Hapus dari transactions
$deleteTransaction = $conn->prepare("DELETE FROM transactions WHERE id = ?");
$deleteTransaction->bind_param("i", $transactionId);
$deleteTransaction->execute();
$deleteTransaction->close();

// kembalikan ke halaman transaksi
header("Location: ../index.php?page=transaksi&success=Berhasil Menghapus Transaksi");
exit();
