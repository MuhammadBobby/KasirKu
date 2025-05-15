<?php
include "functions/connect.php";

$headerTable = [
    "No",
    "Customer",
    "Produk",
    "Jumlah",
    "Total Harga",
    "Uang Dibayarkan",
    "Uang Kembalian",
    "Metode Pembayaran",
    "Tanggal Transaksi",
    "Action"
];

$sql = "SELECT
    t.id,
    t.customer,
    GROUP_CONCAT(CONCAT(p.name, ' (x', ti.quantity, ')') SEPARATOR ', ') AS product,
    SUM(ti.quantity) AS quantity,
    t.total_price,
    t.cash_paid,
    t.change_returned,
    t.pay_method,
    t.transaction_date
FROM transactions t
JOIN transaction_items ti ON t.id = ti.transaction_id
JOIN products p ON ti.product_id = p.id
GROUP BY t.id
ORDER BY t.id DESC
";

$result = $conn->query($sql);
$dataTransaksi = $result->fetch_all(MYSQLI_ASSOC);

// ambil omset hari ini
$sql = "SELECT SUM(total_price) AS omset FROM transactions WHERE DATE(transaction_date) = CURDATE()";
$result = $conn->query($sql);
$omset = $result->fetch_assoc()['omset'];
?>

<!-- periksa apakah ada success -->
<?php if (isset($_GET['success'])) : ?>
    <div class="relative px-4 py-3 mt-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
        <span class="block sm:inline"><?= $_GET['success'] ?></span>
    </div>
<?php elseif (isset($_GET['failed'])) : ?>
    <div class="relative px-4 py-3 mt-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
        <span class="block sm:inline"><?= $_GET['failed'] ?></span>
    </div>
<?php endif; ?>

<div class="mt-7">
    <div class="flex flex-col items-start justify-start gap-2 md:items-center md:justify-between md:flex-row">
        <div>
            <h1 class="text-3xl font-bold uppercase text-slate-800">Data Transaksi</h1>
            <p class="text-sm font-light tracking-wide text-slate-500">Lihat semua transaksi yang telah dilakukan disini.</p>
        </div>

        <a href="pages/cetakTransaksi.php" class="text-white bg-blue-500 hover:bg-blue-500/90 focus:ring-4 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center cursor-pointer me-2 mb-2">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
            </svg>

            Cetak Transaksi
        </a>
    </div>


    <!-- table -->
    <?php include 'includes/tableTransaksi.php'; ?>

    <div class="flex items-center justify-end w-full mt-5 me-5">
        <p class="text-xl text-slate-500">Total Omset Hari ini : <span class="font-bold text-slate-800"> Rp <?= number_format($omset, 0, ',', '.') ?></span></p>
    </div>
</div>