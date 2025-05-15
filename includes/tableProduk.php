<div
    class="mt-5 overflow-hidden bg-white border border-gray-200 rounded-xl">
    <div class="max-w-full overflow-x-auto">
        <table class="min-w-full">
            <!-- table header start -->
            <thead>
                <tr class="border-b border-gray-100">
                    <?php foreach ($headerTable as $header) : ?>
                        <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                                <p
                                    class="font-medium text-center text-gray-500 text-theme-xs">
                                    <?= $header ?>
                                </p>
                            </div>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <!-- table header end -->
            <!-- table body start -->
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                <?php foreach ($dataProduk as $index => $data) : ?>
                    <tr>
                        <!-- no (index) -->
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-xs">
                                    <?= $index + 1 ?>
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm">
                                    <?= $data['code'] ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm">
                                    <?= $data['name'] ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm">
                                    Rp <?= number_format($data['price'], 0, ',', '.') ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p
                                    class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                    <?= $data['stock'] ?>
                                </p>
                            </div>
                        </td>

                        <td class="flex items-center justify-center w-full h-full gap-5">
                            <!-- edit -->
                            <button data-modal-target="edit-product-<?= $data['id'] ?>" data-modal-toggle="edit-product-<?= $data['id'] ?>" class="flex flex-col items-center justify-center gap-1 text-xs font-medium cursor-pointer">
                                <svg class="w-6 h-6 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                </svg>
                                Edit
                            </button>

                            <!-- modal edit -->
                            <?php include 'includes/modal/editProduct.php' ?>

                            <!-- balance stok -->
                            <button data-modal-target="stock-modal-<?= $data['id'] ?>" data-modal-toggle="stock-modal-<?= $data['id'] ?>" class="flex flex-col items-center justify-center gap-1 text-xs font-medium cursor-pointer">
                                <svg class="w-6 h-6 text-emerald-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                </svg>
                                Stok
                            </button>

                            <!-- modal balace stok -->
                            <?php include 'includes/modal/stock.php'; ?>


                            <!-- delete -->
                            <button onclick="confirmDelete(<?= $data['id'] ?>, 'deleteProduct')" class="flex flex-col items-center justify-center gap-1 text-xs font-medium cursor-pointer">
                                <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>