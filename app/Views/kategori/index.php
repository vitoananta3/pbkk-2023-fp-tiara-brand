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
    <div class="mt-8"></div>
    <?php if (session()->has('user')) : ?>
        <?php $user = session()->get('user'); ?>
        <?php if ($user['isAdmin'] == '1') : ?> <!-- Opening curly brace added for the if statement -->
            <div class="flex gap-4">
                <a href="/kategori/create" class="max-w-screen-xl flex gap-2 text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md px-3 py-2.5 transition-colors duration-200 border-2 border-black">
                    <div>Tambah Kategori</div>
                </a>
            </div>
        <?php else : ?>
        <?php endif; ?>
    <?php else : ?>
    <?php endif; ?>
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
    <?php if (empty($kategori)) : ?>
        <div class="spa flex flex-col items-center mt-8 text-[#434E5C] text-xl gap-2">
            <div>Tidak ada kategori tersedia</div>
            <?php if (session()->has('user')) : ?>
                <?php $user = session()->get('user'); ?>
                <?php if ($user['isAdmin'] == '1') : ?> <!-- Opening curly brace added for the if statement -->
                    <div>Tambahkan kategori dengan tombol Tambah Kategori di atas</div>
                <?php else : ?>
                <?php endif; ?>
            <?php else : ?>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="flex flex-wrap gap-6 max-w-screen-xl mx-auto py-8">
            <?php foreach ($kategori as $kategori) : ?>
                <?php if (session()->has('user')) : ?>
                    <?php $user = session()->get('user'); ?>
                    <?php if ($user['isAdmin'] == '1') : ?> <!-- Opening curly brace added for the if statement -->
                        <a href="<?php base_url() ?>/kategori/<?php $slug = $kategori['slug'];
                                                                echo $slug; ?>" class="bg-[#E5E9F0] rounded-md text-[#434C5E] hover:bg-[#81A1C1] hover:text-[#434C5E] p-2 outline">
                            <?= $nama = $kategori['nama']; ?>
                        </a>
                    <?php else : ?>
                        <div class="bg-[#E5E9F0] rounded-md text-[#434C5E] hover:bg-[#81A1C1] hover:text-[#434C5E] p-2 outline">
                            <?= $nama = $kategori['nama']; ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="bg-[#E5E9F0] rounded-md text-[#434C5E] hover:bg-[#81A1C1] hover:text-[#434C5E] p-2 outline">
                        <?= $nama = $kategori['nama']; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>