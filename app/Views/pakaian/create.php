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
    <div class="my-14"></div>
    <div class="flex items-center w-6/12 max-w-screen-xl mb-8">
        <div class="flex flex-col w-full">
            <?= form_open_multipart('pakaian/save') ?>
            <?= csrf_field() ?>
            <div class="text-sm flex flex-col justify-center gap-2">
                <div class="relative">
                    <input type="text" id="floating_outlined" class="border block px-4 pb-3 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-<?= session('validation_errors') && array_key_exists('title', session('validation_errors')) && session('validation_errors')['title'] ? 'red-600' : '[#434C5E]' ?> dark:focus:border-<?= session('validation_errors') && array_key_exists('title', session('validation_errors')) && session('validation_errors')['title'] ? 'red' : 'blue' ?>-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="..." autofocus name="title" value="<?= old('title'); ?>" />
                    <label for="title" class="absolute text-[#434C5E] dark:text-[#434C5E] duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= session('validation_errors') && array_key_exists('title', session('validation_errors')) && session('validation_errors')['title'] ? 'red' : 'blue' ?>-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Title</label>
                </div>
                <div class="text-red-600"><?php
                                            if (session('validation_errors') && array_key_exists('title', session('validation_errors')) && session('validation_errors')['title']) {
                                                echo session('validation_errors')['title'];
                                            }
                                            ?>
                </div>
                <div class="my-2"></div>
                <div class="relative">
                    <input type="text" id="floating_outlined" class="border block px-4 pb-3 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-<?= session('validation_errors') && array_key_exists('ukuran', session('validation_errors')) && session('validation_errors')['ukuran'] ? 'red-600' : '[#434C5E]' ?> dark:focus:border-<?= session('validation_errors') && array_key_exists('ukuran', session('validation_errors')) && session('validation_errors')['ukuran'] ? 'red' : 'blue' ?>-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="..." autofocus name="ukuran" value="<?= old('ukuran'); ?>" />
                    <label for="ukuran" class="absolute text-[#434C5E] dark:text-[#434C5E] duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= session('validation_errors') && array_key_exists('ukuran', session('validation_errors')) && session('validation_errors')['ukuran'] ? 'red' : 'blue' ?>-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Ukuran</label>
                </div>
                <div class="text-red-600"><?php
                                            if (session('validation_errors') && array_key_exists('ukuran', session('validation_errors')) && session('validation_errors')['ukuran']) {
                                                echo session('validation_errors')['ukuran'];
                                            }
                                            ?>
                </div>
                <div class="my-2"></div>
                <select id="kategori_id" name="kategori_id" class="bg-[#E5E9F0] border border-[#434C5E] text-[#434C5E] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-[#E5E9F0] dark:<?= session('validation_errors') && array_key_exists('kategori_id', session('validation_errors')) && session('validation_errors')['kategori_id'] ? 'red-600' : '[#434C5E]' ?> dark:text-[#434C5E] dark:focus:ring-blue-500 dark:focus:border-<?= session('validation_errors') && array_key_exists('kategori_id', session('validation_errors')) && session('validation_errors')['kategori_id'] ? 'red' : 'blue' ?>-500 dark:border-<?= session('validation_errors') && array_key_exists('kategori_id', session('validation_errors')) && session('validation_errors')['kategori_id'] ? 'red-600' : '[#434C5E]' ?> dark:placeholder-<?= session('validation_errors') && array_key_exists('kategori_id', session('validation_errors')) && session('validation_errors')['kategori_id'] ? 'red-600' : '[#434C5E]' ?>">
                    <option selected>Pilih salah satu kategori</option>
                    <?php foreach ($kategoriAll as $kategori) : ?>
                        <option value="<?= $kategori['id'] ?>"><?= $kategori['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="text-sm font-thin text-[#434E5C]">(Tambahkan kategori jika tidak ada yang tersedia)</span>
                <div class="text-red-600"><?php
                                            if (session('validation_errors') && array_key_exists('kategori_id', session('validation_errors')) && session('validation_errors')['kategori_id']) {
                                                echo session('validation_errors')['kategori_id'];
                                            }
                                            ?>
                </div>
                <div class="my-2"></div>
                <div class="relative">
                    <textarea type="text" id="floating_outlined" class="h-32 border block px-4 pb-3 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-<?= session('validation_errors') && array_key_exists('deskripsi', session('validation_errors')) && session('validation_errors')['deskripsi'] ? 'red-600' : '[#434C5E]' ?> dark:focus:border-<?= session('validation_errors') && array_key_exists('deskripsi', session('validation_errors')) && session('validation_errors')['deskripsi'] ? 'red' : 'blue' ?>-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" autofocus name="deskripsi"><?= old('deskripsi'); ?></textarea>
                    <label for="deskripsi" class="absolute text-[#434C5E] dark:text-[#434C5E] duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= session('validation_errors') && array_key_exists('deskripsi', session('validation_errors')) && session('validation_errors')['deskripsi'] ? 'red' : 'blue' ?>-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Deskripsi</label>
                </div>
                <div class="text-red-600"><?php
                                            if (session('validation_errors') && array_key_exists('deskripsi', session('validation_errors')) && session('validation_errors')['deskripsi']) {
                                                echo session('validation_errors')['deskripsi'];
                                            }
                                            ?>
                </div>
                <div class="my-2"></div>
                <div class="relative">
                    <input type="text" id="floating_outlined" class="border block px-4 pb-3 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-<?= session('validation_errors') && array_key_exists('harga', session('validation_errors')) && session('validation_errors')['harga'] ? 'red-600' : '[#434C5E]' ?> dark:focus:border-<?= session('validation_errors') && array_key_exists('harga', session('validation_errors')) && session('validation_errors')['harga'] ? 'red' : 'blue' ?>-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" autofocus name="harga" value="<?= old('harga'); ?>"></input>
                    <label for="harga" class="absolute text-[#434C5E] dark:text-[#434C5E] duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= session('validation_errors') && array_key_exists('harga', session('validation_errors')) && session('validation_errors')['harga'] ? 'red' : 'blue' ?>-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Harga (dalam Rp)</label>
                </div>
                <div class="text-red-600"><?php
                                            if (session('validation_errors') && array_key_exists('harga', session('validation_errors')) && session('validation_errors')['harga']) {
                                                echo session('validation_errors')['harga'];
                                            }
                                            ?></div>
                <div class="my-2"></div>
                <div class="relative">
                    <input type="text" id="floating_outlined" class="border block px-4 pb-3 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-<?= session('validation_errors') && array_key_exists('stok', session('validation_errors')) && session('validation_errors')['stok'] ? 'red-600' : '[#434C5E]' ?> dark:focus:border-<?= session('validation_errors') && array_key_exists('stok', session('validation_errors')) && session('validation_errors')['stok'] ? 'red-600' : 'blue-500' ?> focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" autofocus name="stok" value="<?= old('stok'); ?>"></input>
                    <label for="stok" class="absolute text-[#434C5E] dark:text-[#434C5E] duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= session('validation_errors') && array_key_exists('stok', session('validation_errors')) && session('validation_errors')['stok'] ? 'red-600' : 'blue-500' ?> peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Stok</label>
                </div>
                <div class="text-red-600"><?php
                                            if (session('validation_errors') && array_key_exists('stok', session('validation_errors')) && session('validation_errors')['stok']) {
                                                echo session('validation_errors')['stok'];
                                            }
                                            ?></div>
                <div class="my-2"></div>
                <label class="block text-[#434C5E] dark:[#434C5E]" for="gambar" id="gambar-label">Gambar</label>
                <img class="card-image-preview img-thumbnail img-preview" src="<?= base_url(); ?>assets/gambar-pakaian/tidak-ada-gambar.jpg" alt="preview-gambar-pakaian">
                <input onchange="previewImg()" id="gambar" name="gambar" class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-[#434C5E] focus:outline-none dark:bg-[#E5E9F0] dark:border-<?= session('validation_errors') && array_key_exists('gambar', session('validation_errors')) && session('validation_errors')['gambar'] ? 'red-600' : '[#434C5E]' ?> dark:placeholder-<?= session('validation_errors') && array_key_exists('gambar', session('validation_errors')) && session('validation_errors')['gambar'] ? 'red-600' : '[#434C5E]' ?>" id="gambar" type="file">
                <p class="mt-1 text-<?= session('validation_errors') && array_key_exists('gambar', session('validation_errors')) && session('validation_errors')['gambar'] ? 'red-600' : '[#434C5E]' ?> font-thin">(.jpg, .jpeg atau .png | maks ukuran 1MB)</p>
                <div class="text-red-600"><?php
                                            if (session('validation_errors') && array_key_exists('gambar', session('validation_errors')) && session('validation_errors')['gambar']) {
                                                echo session('validation_errors')['gambar'];
                                            }
                                            ?>
                </div>
                <div class="my-8"></div>
                <div class="text-sm">
                    <?= form_submit('submit', 'Tambahkan Pakaian Baru', ['class' => 'bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md w-full px-5 py-2.5 transition-colors duration-200 border-2 border-black']) ?>
                </div>
                <div class="my-8"></div>
                <?= form_close() ?>
                <a href="/pakaian" class="self-end text-sm border border-[#434C5E] hover:bg-[#81A1C1] text-[#434C5E] hover:text-[#434C5E] rounded-md px-5 py-2.5 transition-colors duration-200">
                    Kembali ke list pakaian
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>