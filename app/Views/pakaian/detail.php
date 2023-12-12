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
<div class="flex flex-col items-center max-h-screen bg-[#E5E9F0]">
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
    <div class="flex gap-4">
        <?php if (session()->has('user')) : ?>
            <?php $user = session()->get('user'); ?>
            <?php if ($user['isAdmin'] == '1') : ?> <!-- Opening curly brace added for the if statement -->
                <a href="<?= base_url(); ?>pakaian/edit/<?= $pakaian['slug']; ?>" class="max-w-screen-xl flex gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 border-2 border-black">
                    <div>Edit Pakaian</div>
                </a>
                <form action="<?= base_url(); ?>/pakaian/<?= $pakaian['id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="max-w-screen-xl flex gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 opacity-70 border-2 border-black" id="pop-button">Hapus Pakaian</button>

                    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full bg-black bg-opacity-50">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin ingin mengahapus pakaian ini?</h3>
                                    <button data-modal-hide="popup-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2" type="submit" id="close-button">
                                    Ya, saya yakin
                                    </button>
                                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" id="close-button">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else : ?>
            <?php endif; ?>
        <?php else : ?>
        <?php endif; ?>
        <a href="/pakaian" class="self-end text-sm border border-[#434C5E] hover:bg-[#81A1C1] text-[#434C5E] hover:text-[#434C5E] rounded-md px-5 py-2.5 transition-colors duration-200">
            Kembali ke list pakaian
        </a>
    </div>
    <div class="my-4"></div>
    <div class="flex spa-2 w-full max-w-screen-xl">
        <div class="flex w-1/2 border border-r-black pr-4">
            <img class="card-image object-contain" src="<?= base_url(); ?>assets/gambar-pakaian/<?= $pakaian['gambar']; ?>" alt="gambar-pakaian">
        </div>
        <div class="flex flex-col w-1/2 justify-between h-full pl-4">
            <div class="flex flex-col gap-2">
                <div class="grid grid-cols-4 gap-0 font-bold text-xl">
                    <!-- <div class="">Title:</div> -->
                    <div class="col-span-3"><?php $title = $pakaian['title'];
                                            echo $title; ?></div>
                </div>
                <div class="grid grid-cols-4 gap-0">
                    <!-- <div class="">Harga:</div> -->
                    <div class="col-span-3 font-semibold">Rp<?php $harga = $pakaian['harga'];
                                                            echo $harga; ?></div>
                </div>
                <div class="my-2"></div>
                <div class="grid grid-cols-4 gap-0">
                    <div class="">Ukuran:</div>
                    <div class="col-span-3">
                        <span class="border border-black p-1 rounded-md">
                            <?php $ukuran = $pakaian['ukuran'];
                            echo $ukuran; ?>
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-0">
                    <div class="">Kategori:</div>
                    <div class="col-span-3"><?= $kategori['nama'] ?></div>
                </div>
                <div class="grid grid-cols-4 gap-0">
                    <div class="">Deskripsi:</div>
                    <div class="col-span-3"><?php $deskripsi = $pakaian['deskripsi'];
                                            echo $deskripsi; ?></div>
                </div>
                <div class="grid grid-cols-4 gap-0">
                    <div class="">Stok:</div>
                    <div class="col-span-3"><?php $stok = $pakaian['stok'];
                                            echo $stok; ?></div>
                </div>
            </div>
            <div class="flex flex-col justify-center flex-grow self-center gap-10 items-center">
                <?php if (session()->has('user')) : ?>
                    <?php $user = session()->get('user'); ?>
                    <form action="<?= base_url(); ?>saveitem/<?= $pakaian['id']; ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="pengguna_id" value="<?= esc($user['id']); ?>">
                        <input type="hidden" name="pakaian_id" value="<?php $pakaian_id = $pakaian['id'];
                                                                    echo $pakaian_id; ?>">
                        <input type="hidden" name="kuantitas" value="1">
                        <button type="submit" class="flex items-center gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>Tambahkan ke Keranjang</div>
                        </button>
                    </form>
                <?php else : ?>
                    <form action="<?= base_url(); ?>login" method="post">
                        <button type="submit" class="flex items-center gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>Tambahkan ke Keranjang</div>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>