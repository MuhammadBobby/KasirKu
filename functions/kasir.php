<?php
include "connect.php";

$customer      = htmlspecialchars(trim($_POST['customer'] ?? ''));
$payMethod     = htmlspecialchars(trim($_POST['pay_method'] ?? ''));
$productIds    = $_POST['product_id'] ?? [];
$quantities    = $_POST['quantity'] ?? [];
$subtotals     = $_POST['subtotal'] ?? [];
$totalPrice    = (int) ($_POST['total_price'] ?? 0);
$cash          = (int) ($_POST['cash_paid'] ?? 0);
$change        = (int) ($_POST['change_returned'] ?? 0);

// valdasi
if (!$customer || !$payMethod || !$productIds || !$quantities || !$subtotals || $totalPrice <= 0 || $cash <= 0 || $change < 0) {
    header("Location: ../index.php?page=kasir&failed=Mohon isi semua field.");
    exit();
}

// Simpan ke tabel transaksi
$stmt = $conn->prepare("INSERT INTO transactions (customer, total_price, cash_paid, change_returned, pay_method) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("siiis", $customer, $totalPrice, $cash, $change, $payMethod);
$stmt->execute();

$transactionId = $stmt->insert_id;

// Simpan tiap item ke tabel transaction_items
$stmt2 = $conn->prepare("INSERT INTO transaction_items (transaction_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)");
$stmt3 = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");

for ($i = 0; $i < count($productIds); $i++) {
    $productId = (int) $productIds[$i];
    $qty       = (int) $quantities[$i];
    $subtotal  = (int) str_replace(['Rp', '.', ' '], '', $subtotals[$i]);


    if ($productId > 0 && $qty > 0 && $subtotal > 0) {
        // Simpan ke transaction_items
        $stmt2->bind_param("iiii", $transactionId, $productId, $qty, $subtotal);
        $stmt2->execute();

        // Update stok produk
        $stmt3->bind_param("ii", $qty, $productId);
        $stmt3->execute();
    }
}

// Redirect ke halaman invoice
header("Location: ../pages/invoice.php?id=$transactionId");
exit();
