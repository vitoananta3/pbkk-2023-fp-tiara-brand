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
    <?php if (empty($keranjang)) : ?>
        <div class="flex gap-4">
            <a href="<?= base_url(); ?>pakaian" class="max-w-screen-xl flex gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 border-2 border-black">
                <div>Belanja Sekarang</div>
            </a>
        </div>
        <div class="spa flex flex-col items-center mt-8 text-[#434E5C] text-xl gap-4">
            <div>Tidak ada pakaian dalam keranjang Anda</div>
            <div>Yuk belanja dengan menekan tombol Belanja Sekarang di atas</div>
        </div>
    <?php else : ?>
        <div class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0 w-full">
            <div class="rounded-lg md:w-2/3">
                <?php if (empty($pakaianAll)) : ?>
                    <div class="flex justify-center">
                        <a href="<?= base_url(); ?>pakaian" class="bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 border-2 border-black">
                            Belanja Sekarang
                        </a>
                    </div>
                    <div class="flex flex-col items-center text-[#434E5C] text-xl gap-2 mt-4">
                        <div>There are no items in your cart</div>
                        <div>Yuk belanja dengan menekan tombol Belanja Sekarang di atas</div>
                    </div>
                <?php endif; ?>
                <?php
                $cartTotal = 0; // Initialize the variable to hold the cart's total price
                ?>
                <?php foreach ($itemKeranjangAll as $itemKeranjang) : ?>
                    <?php if (isset($itemKeranjang['pakaian_info'])) : ?>
                        <?php if ($itemKeranjang['pakaian_info']['id'] === $itemKeranjang['pakaian_id']) : ?>
                            <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                                <div class="flex items-center justify-center w-1/5">
                                    <a href="<?= base_url(); ?>pakaian/<?= $itemKeranjang['pakaian_info']['id']; ?>">
                                        <img src="<?= base_url(); ?>assets/gambar-pakaian/<?= $itemKeranjang['pakaian_info']['gambar']; ?>" alt="product-image" class="w-full" />
                                    </a>
                                </div>
                                <div class="sm:ml-4 sm:flex sm:justify-between gap-8 w-4/5">
                                    <div class="mt-5 sm:mt-0 flex flex-col gap-4 justify-between w-2/3">
                                        <div class="flex flex-col gap-4">
                                            <h2 class="text-lg font-bold text-gray-900"><?= $itemKeranjang['pakaian_info']['title']; ?></h2>
                                            <h2 class=" text-base font-semibold text-gray-900">Rp<?= $itemKeranjang['pakaian_info']['harga']; ?> (@1)</h2>
                                            <p class="text-sm text-gray-700"><span class="border border-black px-3 py-1 rounded-md"><?= $itemKeranjang['pakaian_info']['ukuran']; ?></span></p>
                                            <p class="text-sm text-gray-700"><?= $itemKeranjang['pakaian_info']['deskripsi']; ?></p>
                                        </div>
                                        <div class="w-2/4 text-sm text-center bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-2 py-2 transition-colors duration-200 border-2 border-black">
                                            <a href="<?= base_url(); ?>pakaian/<?= $itemKeranjang['pakaian_info']['id']; ?>">Detail pakaian</a>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex sm:space-y-6 sm:mt-0 sm:block flex-col gap-4 h-full w-1/3">
                                        <div class="flex border border-[#434C5E] rounded-lg">
                                            <?= form_open('updateitem/decrement/' . $itemKeranjang['id']); ?>
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="PUT">
                                            <?= form_submit('submit', '-', ['class' => 'bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-l-md w-full px-5 py-auto transition-colors duration-200 border-2 border-black h-full']) ?>
                                            <?= form_close() ?>
                                            <div class=" flex h-8 border text-center outline-none w-full justify-center items-center"><?= $itemKeranjang['kuantitas']; ?></div>
                                            <?= form_open('updateitem/increment/' . $itemKeranjang['id']); ?>
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="PUT">
                                            <?= form_submit('submit', '+', ['class' => 'bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-r-md w-full px-5 py-auto transition-colors duration-200 border-2 border-black h-full']) ?>
                                            <?= form_close() ?>
                                        </div>
                                        <div class="flex items-cente text-sm font-semibold justify-between">
                                            <?php
                                            $totalHarga = $itemKeranjang['pakaian_info']['harga'] * $itemKeranjang['kuantitas'];
                                            $formattedHarga = number_format($totalHarga, 0, ',', '.');
                                            ?>
                                            <div>Subtotal</div>
                                            <div>Rp<?= $formattedHarga; ?></div>
                                        </div>
                                        <div class="flex gap-4 justify-end flex-grow">
                                            <form action="<?= base_url(); ?>updateitem/<?= $itemKeranjang['id']; ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="PUT">

                                                <button type="sumbit" class="max-w-screen-xl flex gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 opacity-70 border-2 border-black" id="pop-button">
                                                    <div class="flex justify-center items-center gap-4">
                                                        <div>Hapus</div>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $subtotal = $itemKeranjang['pakaian_info']['harga'] * $itemKeranjang['kuantitas']; // Calculate subtotal for each book
                            $cartTotal += $subtotal; // Add subtotal to the total price
                            ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Sub total -->
            <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                <p class="text-lg font-bold mb-4">Keranjang Anda</p>
                <hr class="mb-4">
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <?php
                    $formattedCartTotal = number_format($cartTotal, 0, ',', '.');
                    ?>
                    <p class="mb-1 text-lg font-bold">Rp<?= $formattedCartTotal; ?></p>
                </div>
                <?= form_open('checkout/') ?>
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="transactionDate" value="<?= date('Y-m-d H:i:s'); ?>">
                <input type="hidden" name="totalPrice" value="<?= $cartTotal; ?>">
                <?= form_submit('submit', 'Check Out', ['class' => 'bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 border-2 border-black w-full mt-8']) ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>