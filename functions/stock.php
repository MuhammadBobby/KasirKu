<?php
include "connect.php";

$stock = (int) $_POST['stock'];
$productId = (int) $_POST['product_id'];

$stmt3 = $conn->prepare("UPDATE products SET stock = stock + ? WHERE id = ?");
$stmt3->bind_param("ii", $stock, $productId);
$stmt3->execute();

header("Location: ../index.php?page=produk&success=Berhasil Melakukan Balance Stok Produk.");
exit();
