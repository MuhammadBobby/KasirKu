<?php
include "../functions/connect.php";

$transactionId = $_GET['id'];

if (!$transactionId) {
    header("Location: ../index.php?page=transaksi&failed=Mohon kirim ID transaksi.");
    exit();
}

$sql = "SELECT t.*, ti.quantity, ti.transaction_id, p.name AS product, p.price
        FROM transactions t
        JOIN transaction_items ti ON t.id = ti.transaction_id
        JOIN products p ON p.id = ti.product_id
        WHERE t.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $transactionId);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $data = $row; // Ambil satu data transaksi
    $items[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice KasirKu</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>

    <div class="max-w-5xl p-10 m-5 mx-auto text-gray-800 bg-white shadow-xl rounded-xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <img src="../assets/images/logo.png" alt="Logo Kasirku" class="h-10 mb-3">
                <h1 class="text-2xl font-bold uppercase">KasirKu</h1>
            </div>
            <div class="text-right">
                <h2 class="text-3xl font-bold uppercase text-slate-800">Invoice</h2>
                <p class="text-sm">Tanggal: <?= date('d/m/Y', strtotime($data['transaction_date'])) ?></p>
                <p class="text-sm">Invoice ID: #INV00<?= $data['transaction_id'] ?? '01' ?></p>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="mb-6">
            <h3 class="mb-1 text-lg font-semibold text-slate-700">Pelanggan</h3>
            <p class="text-sm"><?= $data['customer'] ?? 'Umum' ?></p>
        </div>

        <!-- Table Items -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700 border border-gray-300">
                <thead class="font-semibold text-gray-700 bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Produk</th>
                        <th class="px-4 py-2 text-center border">Qty</th>
                        <th class="px-4 py-2 text-right border">Harga</th>
                        <th class="px-4 py-2 text-right border">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $i => $item): ?>
                        <tr>
                            <td class="px-4 py-2 border"><?= $i + 1 ?></td>
                            <td class="px-4 py-2 border"><?= $item['product'] ?></td>
                            <td class="px-4 py-2 text-center border"><?= $item['quantity'] ?></td>
                            <td class="px-4 py-2 text-right border">Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td class="px-4 py-2 text-right border">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="flex justify-end mt-6">
            <div class="w-full sm:w-1/2">
                <div class="flex justify-between py-1 border-b">
                    <span>Total</span>
                    <span>Rp <?= number_format($data['total_price'], 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between py-1 border-b">
                    <span>Bayar</span>
                    <span>Rp <?= number_format($data['cash_paid'], 0, ',', '.') ?></span>
                </div>
                <div class="flex justify-between py-1 font-semibold text-slate-800">
                    <span>Kembalian</span>
                    <span>Rp <?= number_format($data['change_returned'], 0, ',', '.') ?></span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-sm text-center text-gray-500">
            <p>Terima kasih telah berbelanja!</p>
        </div>
    </div>


    <script>
        window.print();

        // Tunggu sampai print selesai, lalu redirect
        window.onafterprint = function() {
            window.location.href = '../index.php?page=transaksi&success=Berhasil Menyimpan Transaksi';
        };
    </script>

</body>

</html>