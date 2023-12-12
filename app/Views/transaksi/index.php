<?= $this->extend('layout\template') ?>
<?= $this->section('content') ?>
<?php if (session()->has('user')) : ?>
    <?php $user = session()->get('user'); ?>
    <?php if ($user['isAdmin'] == '1') : ?> <!-- Opening curly brace added for the if statement -->
        <?= $this->include('component/navbar-admin-guest') ?>
    <?php else : ?>
        <?= $this->include('component/navbar-customer') ?>
    <?php endif; ?>
<?php else : ?>
    <?= $this->include('component/navbar-admin-guest') ?>
<?php endif; ?>
<div class="flex flex-col items-center bg-[#E5E9F0]">
    <div class="my-8"></div>
    <div class="mt-8"></div>
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="fixed top-0 mt-20 right-0 mr-8 z-30">
            <div id="alert-3" class="fade-out flex items-center p-4 text-green-800 rounded-lg bg-[#E5E9F0] dark:bg-[#434C5E] dark:text-green-400 gap-2" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    <?= session()->getFlashdata('message'); ?>
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[#E5E9F0] text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-[#434C5E] dark:text-green-400 dark:hover:bg-[#81A1C1]" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>
    <?php if (empty($keranjangAll)) : ?>
        <div class="flex gap-4">
            <a href="<?= base_url(); ?>pakaian" class="max-w-screen-xl flex gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 border-2 border-black">
                <div>Belanja Sekarang</div>
            </a>
        </div>
        <div class="spa flex flex-col items-center mt-8 text-[#434E5C] text-xl gap-4">
            <div>Tidak ada transaksi yang sedang berlangsung ataupun selesai</div>
            <div>Yuk belanja dengan menekan tombol Belanja Sekarang di atas</div>
        </div>
    <?php else : ?>
        <div class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0 w-full">
            <div class="rounded-lg md:w-2/3">
                <?php if (empty($keranjangAll)) : ?>
                    <div class="flex justify-center">
                        <a href="<?= base_url(); ?>pakaian" class="bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 border-2 border-black">
                            Belanja Sekarang
                        </a>
                    </div>
                    <div class="flex flex-col items-center text-[#434E5C] text-xl gap-2 mt-4">
                        <div>Tidak ada transaksi yang sedang berlangsung ataupun selesai</div>
                        <div>Yuk belanja dengan menekan tombol Belanja Sekarang di atas</div>
                    </div>
                <?php else : ?>
                <?php endif; ?>
                <?php
                $transactionCounter = 1; // Initialize the transaction counter outside the loop

                foreach ($keranjangAll as $keranjang) :
                ?>
                    <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                        <div class="sm:ml-4 sm:flex sm:justify-between gap-8 w-full">
                            <div class="mt-5 sm:mt-0 flex flex-col gap-4 justify-center w-2/3">
                                <div class="flex flex-col">
                                    <div><span class="text-lg font-bold text-gray-900">Transaksi <?= $transactionCounter; ?></span> pada <?= $keranjang['updated_at']; ?></div>
                                    <?php if ($keranjang['isDone'] == 0) : ?>
                                        <div class="my-2 flex items-center gap-2">
                                            <div>Status:</div>
                                            <span class="text-lg font-bold text-red-600">Menunggu dikonfirmasi</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    <?php else : ?>
                                        <div class="my-2">Status: Selesai</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mt-4 flex sm:space-y-6 sm:mt-0 sm:block flex-col gap-4 h-full w-1/3">
                                <div class="flex items-center text-sm font-semibold justify-between">
                                    <?php
                                    $totalHarga = $keranjang['totalHarga'];
                                    $formattedPrice = number_format($totalHarga, 0, ',', '.');
                                    ?>
                                    <div>Total pada transaksi <?= $transactionCounter; ?></div>
                                    <div>Rp<?= $formattedPrice; ?></div>
                                </div>
                                <div class="w-full flex">
                                    <a class="w-full text-sm text-center bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-2 py-2 transition-colors duration-200 border-2 border-black" href="<?= base_url(); ?>transaksi/<?= $keranjang['id']; ?>">Detail transaksi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $transactionCounter++;
                endforeach;
                ?>

            </div>
            <?php
            $transactionstotalHarga = 0;

            foreach ($keranjangAll as $keranjang) :
                $totalHarga = $keranjang['totalHarga'];
                $transactionstotalHarga += $totalHarga;
            endforeach;

            // Format the total price for display
            $formattedCartTotal = number_format($transactionstotalHarga, 0, ',', '.');
            ?>
            <!-- Sub total -->
            <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                <p class="text-lg font-bold mb-4">Transaksi Anda</p>
                <hr class="my-4">
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total transaksi</p>
                    <p class="mb-1 text-lg font-bold"><?= $totalTransactions = $transactionCounter - 1; ?></p>
                </div>
                <div class="my-4"></div>
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <?php
                    $formattedCartTotal = number_format($transactionstotalHarga, 0, ',', '.');
                    ?>
                    <p class="mb-1 text-lg font-bold">Rp<?= $formattedCartTotal; ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>