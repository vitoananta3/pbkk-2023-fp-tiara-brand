<nav class="bg-[#434C5E] fixed w-full z-20 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4 ">
        <a href="<?= base_url() ?>" class="flex items-center space-x-3 rtl:space-x-reverse ">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-[#E5E9F0]" id="nav-logo">Tiara Brand</span>
        </a>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse bg-or">
            <button type="button" class="flex text-sm items-center" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <div class="w-8 h-8 rounded-full bg-gray-800 md:me-0 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#E5E9F0" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <?php if (session()->has('user')) : ?>
                    <?php $user = session()->get('user'); ?>
                    <!-- Check if user is logged in -->
                    <span class="pl-3 block text-sm text-[#E5E9F0]">
                        <?= esc($user['namaDepan']) . ' ' . $user['namaBelakang'] ?>
                    </span>
                <?php else : ?>
                    <span class="pl-3 block text-sm text-[#E5E9F0]">Tamu</span>
                <?php endif; ?>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-[#434C5E] divide-y divide-gray-100 rounded-lg shadow dark:divide-gray-600" id="user-dropdown">
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <?php if (session()->has('user')) : ?>
                        <li>
                            <a href="<?= base_url() ?>logout" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 text-[#E5E9F0] dark:hover:text-white">Log out</a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="<?= base_url() ?>login" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 text-[#E5E9F0] dark:hover:text-white">Log In</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>register" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 text-[#E5E9F0] dark:hover:text-white">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-[#434C5E] dark:border-gray-700">
                <li>
                    <a href="<?= base_url() ?>" class="block py-2 px-3 text-[#E5E9F0] rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#81A1C1] md:p-0 dark:text-white md:dark:hover:text-[#81A1C1] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent <?php echo $page === 'home' ? 'active-nav-item' : ''; ?>">Home</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>kategori" class="block py-2 px-3 text-[#E5E9F0] rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#81A1C1] md:p-0 dark:text-white md:dark:hover:text-[#81A1C1] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent <?php echo $page === 'kategori' ? 'active-nav-item' : ''; ?>">Kategori</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>pakaian" class="block py-2 px-3 text-[#E5E9F0] rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#81A1C1] md:p-0 dark:text-white md:dark:hover:text-[#81A1C1] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent <?php echo $page === 'pakaian' ? 'active-nav-item' : ''; ?>">Pakaian</a>
                </li>
            </ul>
        </div>
    </div>
</nav>