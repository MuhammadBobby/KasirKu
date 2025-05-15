<!-- produk -->
<div class="relative col-span-4 md:col-span-2">
    <label for="search-produk" class="block mb-2 text-sm font-medium text-gray-900">Produk</label>

    <!-- Input untuk pencarian -->
    <input
        type="text"
        id="search-produk"
        class="block w-full p-2 text-left border border-gray-300 rounded-md"
        placeholder="Cari produk..."
        oninput="filterProduk(this.value)" required />

    <!-- Dropdown hasil pencarian -->
    <ul id="produk-list" class="absolute z-10 hidden w-full mt-1 overflow-y-auto bg-white border border-gray-300 rounded-md max-h-48">
        <?php foreach ($products as $product): ?>
            <li data-id="<?= $product['id'] ?>" data-price="<?= $product['price'] ?>" onclick="selectProduk(this)" class="p-2 cursor-pointer hover:bg-gray-100">
                <?= htmlspecialchars($product['name']) ?> - <?= htmlspecialchars($product['code']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Hidden input untuk menyimpan id produk -->
    <input type="hidden" name="product_id" id="produk-id" required />
    <input type="hidden" name="product_price" id="product-price" required />
</div>

<!-- qty -->
<div class="col-span-4 md:col-span-1">
    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900">Jumlah Produk</label>
    <input type="number" min="1" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Produk Yang Dibeli" required />
</div>

<!-- Total Harga (perhitungan js) -->
<div class="col-span-4 md:col-span-1">
    <label for="total-price" class="block mb-2 text-sm font-medium text-gray-900">Total Harga</label>
    <input type="text" id="total-price-display" name="total_price_display" placeholder="Total Harga" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" readonly>

    <input type="hidden" id="total-price" name="total_price" readonly>
</div>