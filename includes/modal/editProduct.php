<!-- Main modal -->
<div id="edit-product-<?= $data['id'] ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t md:p-5">
                <h3 class="text-lg font-semibold text-gray-900">
                    Update Produk
                </h3>
                <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" data-modal-toggle="edit-product-<?= $data['id'] ?>">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="functions/editProduct.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $data['id'] ?? '' ?>">

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Produk</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $data['name'] ?? '' ?>" placeholder="Masukkan Nama Produk" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="code" class="block mb-2 text-sm font-medium text-gray-900">Kode Produk</label>
                        <input type="text" name="code" id="code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="<?= $data['code'] ?? '' ?>" placeholder="Masukkan Kode Produk" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="modal_edit_display" class="block mb-2 text-sm font-medium text-gray-900">Modal</label>
                        <input type="text" name="modal_edit_display" id="cost-price-edit-display-<?= $data['id'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="Rp <?= number_format($data['cost_price'], 0, ',', '.') ?? '0' ?>" placeholder="Masukkan Harga" required="">

                        <input type="hidden" name="cost_price" id="cost-price-edit-<?= $data['id'] ?>" value="<?= $data['cost_price'] ?? '' ?>">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price_edit_display" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                        <input type="text" name="price_edit_display" id="price-edit-display-<?= $data['id'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" value="Rp <?= number_format($data['price'], 0, ',', '.') ?? '0' ?>" placeholder="Masukkan Harga" required="">

                        <input type="hidden" name="price" id="price-edit-<?= $data['id'] ?>" value="<?= $data['price'] ?? '' ?>">
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Update product
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    // price
    document.querySelectorAll("[id^='price-edit-display-']").forEach((inputDisplay) => {
        const id = inputDisplay.id.replace("price-edit-display-", "");
        const inputHidden = document.getElementById(`price-edit-${id}`);

        inputDisplay.addEventListener("input", () => {
            const raw = inputDisplay.value.replace(/\D/g, "");
            const intVal = parseInt(raw) || 0;

            inputDisplay.value = "Rp " + intVal.toLocaleString("id-ID");
            inputHidden.value = intVal;
        });
    });

    // cost price
    document.querySelectorAll("[id^='cost-price-edit-display-']").forEach((inputDisplay) => {
        const id = inputDisplay.id.replace("cost-price-edit-display-", "");
        const inputHidden = document.getElementById(`cost-price-edit-${id}`);

        inputDisplay.addEventListener("input", () => {
            const raw = inputDisplay.value.replace(/\D/g, "");
            const intVal = parseInt(raw) || 0;

            inputDisplay.value = "Rp " + intVal.toLocaleString("id-ID");
            inputHidden.value = intVal;
        });
    });
</script>