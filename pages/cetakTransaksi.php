<?php
include "../functions/connect.php";

$headerTable = [
    "No",
    "Customer",
    "Produk",
    "Jumlah",
    "Total Harga",
    "Metode Pembayaran",
    "Tanggal Transaksi",
];

$sql = "SELECT
    t.id,
    t.customer,
    GROUP_CONCAT(CONCAT(p.name, ' (x', ti.quantity, ')') SEPARATOR ', ') AS product,
    SUM(ti.quantity) AS quantity,
    t.total_price,
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

// total omset bulan ini
$sql = "SELECT SUM(total_price) AS total_omset FROM transactions WHERE MONTH(transaction_date) = MONTH(CURRENT_DATE()) AND YEAR(transaction_date) = YEAR(CURRENT_DATE())";
$result = $conn->query($sql);
$omset = $result->fetch_assoc()['total_omset'];

// ambil keuntungan bulan ini
$sqlKeuntungan = "SELECT 
    SUM(ti.subtotal) AS total_jual,
    SUM(ti.quantity * p.cost_price) AS total_modal
FROM transactions t
JOIN transaction_items ti ON t.id = ti.transaction_id
JOIN products p ON ti.product_id = p.id
WHERE MONTH(t.transaction_date) = MONTH(CURDATE())
  AND YEAR(t.transaction_date) = YEAR(CURDATE())
";

$resultKeuntungan = $conn->query($sqlKeuntungan);
$dataKeuntungan = $resultKeuntungan->fetch_assoc();

$keuntungan = (int) ($dataKeuntungan['total_jual'] - $dataKeuntungan['total_modal']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi KasirKu</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="p-10 m-5 mx-auto text-gray-800 bg-white shadow-xl max-w-[98vw] rounded-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold uppercase text-slate-800">Data Transaksi</h1>
            </div>
        </div>


        <!-- table -->
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
                                            class="font-medium text-gray-500 text-theme-xs">
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
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col items-end justify-end w-full mt-5 me-5">
            <p class="text-xl text-slate-500">Total Omset Bulan ini : <span class="font-bold text-slate-800"> Rp <?= number_format($omset ?? 0, 0, ',', '.') ?></span></p>
            <p class="text-xl text-slate-500">Total Keuntungan Bulan ini : <span class="font-bold text-slate-800"> Rp <?= number_format($keuntungan ?? 0, 0, ',', '.') ?></span></p>
        </div>
    </div>

    <script>
        window.print();

        // Tunggu sampai print selesai, lalu redirect
        window.onafterprint = function() {
            window.location.href = '../index.php?page=transaksi&success=Berhasil Menyimpan seluruh Transaksi';
        };
    </script>

</body>

</html>