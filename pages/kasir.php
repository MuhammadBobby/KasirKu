<?php
include "functions/connect.php";

// Ambil data produk
$result = $conn->query("SELECT * FROM products");
$products = $result->fetch_all(MYSQLI_ASSOC);

// pay method
$payMethods = [
    "Cash",
    "Debit",
    "Credit",
    "Transfer Bank",
    "E-Wallet",
    "QRIS"
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
    <h1 class="text-3xl font-bold uppercase text-slate-800">Kasir</h1>
    <p class="text-sm font-light tracking-wide text-slate-500">Silahkan lakukan penginputan kasir disini.</p>

    <form action="functions/kasir.php" method="POST" class="mt-5 border rounded-lg border-slate-200">
        <div class="grid grid-cols-4 gap-4 p-4">
            <!-- customer -->
            <div class="col-span-4 md:col-span-2">
                <label for="customer" class="block mb-2 text-sm font-medium text-gray-900">Nama Pelanggan</label>
                <input type="text" name="customer" id="customer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan Nama Pelanggan" required />
            </div>

            <!-- pay method -->
            <div class="relative col-span-4 md:col-span-2">
                <label for="pay-method" class="block mb-2 text-sm font-medium text-gray-900">Metode Pembayaran</label>
                <select id="pay-method" name="pay_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option selected>Pilih Metode Pembayaran</option>

                    <?php foreach ($payMethods as $method): ?>
                        <option value="<?= $method ?>"><?= $method ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tambahkan wrapper untuk daftar produk -->
            <div class="col-span-4">
                <label class="block mb-2 text-sm font-medium text-gray-900">Daftar Produk</label>
                <div id="produk-wrapper">
                    <!-- Baris produk akan disisipkan di sini -->
                </div>
                <button type="button" id="tambah-produk" class="px-3 py-1 mt-2 text-white bg-green-600 rounded">+ Tambah Produk</button>
            </div>

            <!-- Uang Yang Dibayar -->
            <div class="relative col-span-4 md:col-span-2">
                <label for="cash-paid-display" class="block mb-2 text-sm font-medium text-gray-900">Uang Yang Dibayar</label>
                <input type="text" id="cash-paid-display" name="cash_paid_display" placeholder="Uang customer" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>

                <input type="hidden" id="cash-paid" name="cash_paid" readonly>
            </div>

            <!-- Total Harga -->
            <div class="col-span-4 md:col-span-1">
                <label class="block mb-2 text-sm font-medium text-gray-900">Total Harga</label>
                <input type="text" id="total-price-display" name="total_price_display" value="Rp 0" placeholder="Total Harga" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" readonly>
                <input type="hidden" id="total-price" name="total_price" readonly>
            </div>

            <!-- Uang kembalian -->
            <div class="relative col-span-4 md:col-span-1">
                <label for="change-returned-display" class="block mb-2 text-sm font-medium text-gray-900">Uang Kembalian</label>
                <input type="text" id="change-returned-display" name="change_returned_display" value="Rp 0" placeholder="Uang Kembalian" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" readonly>

                <input type="hidden" id="change-returned" name="change_returned" readonly>
            </div>


            <!-- keterangan Tambahan -->
            <div class="col-span-4 mt-5">
                <h1 class="text-lg font-bold text-slate-800">Ringkasan</h1>

                <div class="px-3 pb-4">
                    <table class="text-sm text-slate-400">
                        <tr>
                            <td class="pr-4 align-top font-extralight">Uang Yang Dibayarkan</td>
                            <td class="font-medium text-slate-800" id="cash-paid-ket">Rp 0</td>
                        </tr>
                        <tr>
                            <td class="pr-4 align-top font-extralight">Total Harga</td>
                            <td class="font-medium text-slate-800" id="total-price-ket">Rp 0</td>
                        </tr>

                        <tr>
                            <td class="pt-4 align-top font-extralight" colspan="2">
                                <hr>
                            </td>
                        </tr>

                        <tr>
                            <td class="pr-4 align-top font-extralight">Uang Kembalian</td>
                            <td class="font-medium text-slate-800" id="change-returned-ket">Rp 0</td>
                        </tr>
                    </table>
                </div>
            </div>

            <button class="col-span-4 sm:col-span-2 md:col-span-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer">Simpan Transaksi</button>
        </div>
    </form>
</div>

<template id="produk-template">
    <div class="relative p-2 mb-2 bg-white border rounded produk-row">
        <div class="grid grid-cols-4 gap-2">
            <input type="text" class="p-2 border rounded search-produk" placeholder="Cari produk..." oninput="filterProduk(this)">
            <input type="hidden" name="product_id[]" class="product-id">
            <input type="number" name="quantity[]" min="1" class="p-2 border rounded quantity" value="1">
            <input type="text" class="p-2 bg-gray-100 border rounded price-display" readonly>
            <input type="text" name="subtotal[]" class="p-2 bg-gray-100 border rounded subtotal" readonly>
        </div>
        <ul class="absolute z-10 hidden w-full mt-1 overflow-y-auto bg-white border rounded produk-list max-h-48">
            <?php foreach ($products as $product): ?>
                <li data-id="<?= $product['id'] ?>" data-price="<?= $product['price'] ?>" class="p-2 cursor-pointer hover:bg-gray-100">
                    <?= htmlspecialchars($product['name']) ?> - <?= htmlspecialchars($product['code']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="hapus-produk text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-2">Hapus</button>
    </div>
</template>