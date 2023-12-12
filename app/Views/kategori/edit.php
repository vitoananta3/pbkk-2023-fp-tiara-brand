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
<div class="flex flex-col items-center h-screen bg-[#E5E9F0]">
    <div class="my-8"></div>
    <div class="flex items-center spa w-6/12 max-w-screen-xl h-screen">
        <div class="flex flex-col w-full">
            <?= form_open('kategori/update/' . $kategori['id']) ?>
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="text-sm flex flex-col justify-center gap-2">
                <div class="relative">
                    <input type="hidden" name="slug" value="<?= $kategori['slug']; ?>">
                    <input type="text" id="floating_outlined" class="border block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-[#434C5E] dark:focus:border-<?= $validation->hasError('nama') ? 'red' : 'blue' ?>-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="..." autofocus name="nama" value="<?= (old('nama')) ? old('nama') : $kategori['nama'] ?>" />
                    <label for="nama" class="absolute text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= $validation->hasError('nama') ? 'red' : 'blue' ?>-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Nama</label>
                </div>
                <div class="text-red-600"><?= $validation->listErrors(); ?></div>
            </div>
            <div class="my-8"></div>
            <div class="text-sm">
                <?= form_submit('submit', 'Atur Category', ['class' => 'bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md w-full px-5 py-2.5 transition-colors duration-200 border-2 border-black']) ?>
            </div>
            <div class="my-8"></div>
            <?= form_close() ?>
            <a href="/kategori" class="self-end text-sm border border-[#434C5E] hover:bg-[#81A1C1] text-[#434C5E] hover:text-[#434C5E] rounded-md px-5 py-2.5 transition-colors duration-200">
                Kembali ke detail kategori
            </a>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>