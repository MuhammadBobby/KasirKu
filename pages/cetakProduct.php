<?php
include "../functions/connect.php";

// Ambil data produk
$result = $conn->query("SELECT * FROM products");
$dataProduk = $result->fetch_all(MYSQLI_ASSOC);

$headerTable = [
    "No",
    "code produk",
    "Nama Produk",
    "Harga",
    "Stok",
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk KasirKu</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="p-10 m-5 mx-auto text-gray-800 bg-white shadow-xl max-w-[98vw] rounded-xl">
        <div class="flex justify-between">
            <div>
                <h1 class="text-3xl font-bold uppercase text-slate-800">Produk</h1>
            </div>
        </div>

        <!-- table -->
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.print();

        // Tunggu sampai print selesai, lalu redirect
        window.onafterprint = function() {
            window.location.href = '../index.php?page=produk&success=Berhasil Menyimpan seluruh Data Produk';
        };
    </script>

</body>

</html>