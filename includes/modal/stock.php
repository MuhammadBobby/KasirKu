<!-- Main modal -->
<div id="stock-modal-<?= $data['id'] ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200 rounded-t md:p-5">
                <h3 class="text-lg font-semibold text-gray-900">
                    Stock Produk
                </h3>
                <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" data-modal-toggle="stock-modal-<?= $data['id'] ?>">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="functions/stock.php" method="POST">
                <input type="hidden" name="product_id" id="product-id" value="<?= $data['id'] ?>">

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2">
                        <span class="text-xs font-medium leading-3 tracking-tight text-red-500">*Masukkan Penambahan Stok (+ atau positif) atau Pengurangan Stok (- atau minus).</span> <br>
                        <span class="text-xs font-medium leading-3 tracking-tight text-red-500">ex: -10 (Pengurangan 10 Stok) atau 10 (Penambahan 10 Stok)</span>
                    </div>
                    <div class="col-span-2">
                        <label for="stock" class="block mt-2 mb-2 text-sm font-medium text-gray-900">Balance Stok</label>
                        <input type="number" name="stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Masukkan Stok" required="">
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Balance Stok
                </button>
            </form>
        </div>
    </div>
</div>