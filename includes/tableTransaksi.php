<div
    class="mt-5 overflow-hidden bg-white border border-gray-200 rounded-xl">
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <!-- table header start -->
            <thead>
                <tr class="border-b border-gray-100">
                    <?php foreach ($headerTable as $header) : ?>
                        <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                                <p
                                    class="font-medium text-gray-500 text-theme-xs <?= $header == 'No' ? '' : 'md:min-w-32' ?>">
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
                <?php foreach ($dataTransaksi as $index => $data) : ?>
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
                                    <?= $data['customer'] ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm">
                                    <?= $data['product'] ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="mx-auto text-center text-gray-500 text-theme-sm">
                                    <?= $data['quantity'] ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p
                                    class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700">
                                    Rp <?= number_format($data['total_price'], 0, ',', '.') ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm">
                                    Rp <?= number_format($data['cash_paid'], 0, ',', '.') ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm">
                                    Rp <?= number_format($data['change_returned'], 0, ',', '.') ?>
                                </p>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center justify-center">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm"><?= $data['pay_method'] ?? '-' ?></span>
                            </div>
                        </td>
                        <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm">
                                    <?= date('d M Y', strtotime($data['transaction_date'])) ?>
                                </p>
                            </div>
                        </td>

                        <td class="flex items-center justify-center w-full h-full gap-5 ms-3">
                            <!-- cetak invoice -->
                            <a href="pages/invoice.php?id=<?= $data['id'] ?>" class="flex flex-col items-center justify-center gap-1 text-xs font-medium cursor-pointer">
                                <svg class="w-6 h-6 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z" />
                                </svg>

                                Invoice
                            </a>


                            <!-- delete -->
                            <button onclick="confirmDelete(<?= $data['id'] ?>, 'deleteTransaksi')" class="flex flex-col items-center justify-center gap-1 text-xs font-medium cursor-pointer">
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