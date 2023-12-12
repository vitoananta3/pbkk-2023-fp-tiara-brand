<?= $this->extend('layout\template') ?>
<?= $this->section('content') ?>
<div class="flex flex-col h-screen bg-[#434C5E] justify-center items-center">
    <?php if (session()->getFlashdata('message')) : ?>
        <div class="fixed top-0 mt-10 right-0 mr-8 z-30">
            <div id="alert-3" class="fade-out flex items-center p-4 text-green-800 rounded-lg bg-[#E5E9F0] dark:bg-[#E5E9F0] dark:text-green-800 gap-2" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    <?= session()->getFlashdata('message'); ?>
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-[#E5E9F0] text-green-500 rounded-lg focus:ring-2 focus:ring-green-800 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-[#E5E9F0] dark:text-green-800 dark:hover:bg-[#81A1C1]" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>
    <div class="bg-[#E5E9F0] w-5/12 flex rounded-md outline p-12">
        <div class="flex flex-col items-center w-full text-[#434C5E]">
            <p class="text-lg font-semibold">Login Tiara Brand</p>
            <div class="my-2"></div>
            <div class="flex flex-col w-full text-[#434C5E] h-full gap-8">
                <div class="flex flex-col">
                    <div class="text-red-600"><?php
                                                if (session('error')) {
                                                    echo session('error');
                                                }
                                                ?>
                    </div>
                    <!-- Add email and password form -->
                    <?= form_open('auth/login') ?>
                    <div class="my-4"></div>
                    <div class="relative">
                        <input type="text" id="floating_outlined" class="border block px-4 pb-3 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-<?= session('validation_errors') && array_key_exists('email', session('validation_errors')) && session('validation_errors')['email'] ? 'red-600' : '[#434C5E]' ?> dark:focus:border-<?= session('validation_errors') && array_key_exists('email', session('validation_errors')) && session('validation_errors')['email'] ? 'red' : 'blue' ?>-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="..." autofocus name="email" value="<?= old('email'); ?>" />
                        <label for="email" class="absolute text-[#434C5E] dark:text-[#434C5E] duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= session('validation_errors') && array_key_exists('email', session('validation_errors')) && session('validation_errors')['email'] ? 'red' : 'blue' ?>-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email</label>
                    </div>
                    <div class="text-red-600"><?php
                                                if (session('validation_errors') && array_key_exists('email', session('validation_errors')) && session('validation_errors')['email']) {
                                                    echo session('validation_errors')['email'];
                                                }
                                                ?>
                    </div>
                    <div class="my-4"></div>
                    <div class="relative">
                        <input type="password" id="floating_outlined" class="border block px-4 pb-3 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-[#434C5E] dark:border-<?= session('validation_errors') && array_key_exists('password', session('validation_errors')) && session('validation_errors')['password'] ? 'red-600' : '[#434C5E]' ?> dark:focus:border-<?= session('validation_errors') && array_key_exists('password', session('validation_errors')) && session('validation_errors')['password'] ? 'red' : 'blue' ?>-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="..." autofocus name="password" value="<?= old('password'); ?>" />
                        <label for="password" class="absolute text-[#434C5E] dark:text-[#434C5E] duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-[#E5E9F0] dark:bg-[#E5E9F0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-<?= session('validation_errors') && array_key_exists('password', session('validation_errors')) && session('validation_errors')['password'] ? 'red' : 'blue' ?>-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Password</label>
                    </div>
                    <div class="text-red-600"><?php
                                                if (session('validation_errors') && array_key_exists('password', session('validation_errors')) && session('validation_errors')['password']) {
                                                    echo session('validation_errors')['password'];
                                                }
                                                ?>
                    </div>
                    <div class="my-8"></div>
                    <div class="text-sm">
                        <?= form_submit('submit', 'Login', ['class' => 'bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md w-full px-5 py-2.5 transition-colors duration-200 border-2 border-black']) ?>
                    </div>
                    <?= form_close() ?>
                    <div class="my-2"></div>
                    <div class="text-sm text-center">Doesn't have an account?</div>
                    <div class="my-2"></div>
                    <a href="/register" class="text-sm bg-[#434C5E] hover:bg-[#81A1C1] text-[#E5E9F0] hover:text-[#434C5E] rounded-md w-full px-5 py-2.5 transition-colors duration-200 opacity-70 border-2 border-black flex justify-center">
                        Register
                    </a>
                    <!-- End of email and password form -->
                </div>
                <div class="self-end">
                    <a href="/pakaian" class="text-sm border-2 border-[#434C5E] hover:bg-[#81A1C1] text-[#434C5E] hover:text-[#434C5E] rounded-md px-5 py-2.5 transition-colors duration-200 opacity-70 ">
                        Kembali ke list pakaian
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>