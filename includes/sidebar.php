<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:z-30 w-52 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <!-- kasir -->
            <li>
                <a href="?page=kasir" class="flex items-center p-2 text-slate-700 rounded-lg group <?= $page == 'kasir' ? 'bg-blue-100' : 'hover:bg-blue-100' ?>">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 18h14M5 18v3h14v-3M5 18l1-9h12l1 9M16 6v3m-4-3v3m-2-6h8v3h-8V3Zm-1 9h.01v.01H9V12Zm3 0h.01v.01H12V12Zm3 0h.01v.01H15V12Zm-6 3h.01v.01H9V15Zm3 0h.01v.01H12V15Zm3 0h.01v.01H15V15Z" />
                    </svg>

                    <span class="ms-3">Kasir</span>
                </a>
            </li>

            <!-- Transaksi -->
            <li>
                <a href="?page=transaksi" class="flex items-center p-2 text-slate-700 rounded-lg group <?= $page == 'transaksi' ? 'bg-blue-100' : 'hover:bg-blue-100' ?>">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                    </svg>


                    <span class="ms-3">Transaksi</span>
                </a>
            </li>

            <!-- Produk -->
            <li>
                <a href="?page=produk" class="flex items-center p-2 text-slate-700 rounded-lg group <?= $page == 'produk' ? 'bg-blue-100' : 'hover:bg-blue-100' ?>">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M2.9917 4.9834V18.917M9.96265 4.9834V18.917M15.9378 4.9834V18.917m2.9875-13.9336V18.917" />
                        <path stroke="currentColor" stroke-linecap="round" d="M5.47925 4.4834V19.417m1.9917-14.9336V19.417M21.4129 4.4834V19.417M13.4461 4.4834V19.417" />
                    </svg>

                    <span class="ms-3">Produk</span>
                </a>
            </li>
        </ul>
    </div>
</aside>