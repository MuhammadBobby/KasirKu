<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasirKu</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="flex h-screen overflow-hidden">
        <!-- navbar -->
        <?php include 'includes/navbar.php'; ?>

        <!-- sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- main -->
        <div class="w-full h-full overflow-y-auto bg-slate-50">
            <main class="p-4 mt-16 sm:ml-52">
                <div class="px-6 py-4 bg-white shadow rounded-xl">
                    <span class="text-slate-500">Pages/ <span class="font-bold capitalize text-slate-800"><?= $page ?></span></span>
                    <?php include $content; ?>
                </div>
            </main>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="assets/js/searchProduk.js"></script>
    <!-- <script src="assets/js/price.js"></script> -->
    <script src="assets/js/confirm.js"></script>
</body>

</html>