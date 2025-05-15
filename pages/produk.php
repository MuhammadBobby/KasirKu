<?php
include "functions/connect.php";

// Ambil data produk
$result = $conn->query("SELECT * FROM products");
$dataProduk = $result->fetch_all(MYSQLI_ASSOC);

$headerTable = [
    "No",
    "code produk",
    "Nama Produk",
    "Harga Modal",
    "Harga",
    "Stok",
    "Action"
];
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
            <h1 class="text-3xl font-bold uppercase text-slate-800">Produk</h1>
            <p class="text-sm font-light tracking-wide text-slate-500">Lihat produk anda dan perbarui stok serta data jika diperlukan.</p>
        </div>

        <div class="flex">
            <!-- cetak -->
            <a href="pages/cetakProduct.php" class="text-white bg-blue-500 hover:bg-blue-500/90 focus:ring-4 focus:outline-none focus:ring-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center cursor-pointer me-2 mb-2">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                </svg>

                Cetak Produk
            </a>

            <!-- tambah produk -->
            <button type="button" data-modal-target="add-product-modal" data-modal-toggle="add-product-modal" class="text-white bg-emerald-800 hover:bg-emerald-800/90 hover:bg-emerald-800 hover:bg-emerald-800/90/90 focus:ring-4 focus:outline-none focus:ring-emerald-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center cursor-pointer me-2 mb-2">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                Tambah Produk
            </button>
        </div>
    </div>


    <!-- table -->
    <?php include 'includes/tableProduk.php'; ?>

    <!-- modal add product -->
    <?php include 'includes/modal/addProduct.php'; ?>
</div>