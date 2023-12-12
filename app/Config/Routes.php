<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Halaman::index');

$routes->get('/login', 'Pengguna::viewLogin');
$routes->post('/auth/login', 'Pengguna::login');
$routes->post('/login', 'Pengguna::logInFirst');
$routes->get('/register', 'Pengguna::viewRegister');
$routes->post('/auth/register', 'Pengguna::register');
$routes->get('/logout', 'Pengguna::logout');

$routes->get('/kategori', 'Kategori::index');
$routes->get('/kategori/create', 'Kategori::create');
$routes->post('/kategori/save', 'Kategori::save');
$routes->get('/kategori/edit/(:segment)', 'Kategori::edit/$1');
$routes->put('/kategori/update/(:num)', 'Kategori::update/$1');
$routes->delete('/kategori/(:num)', 'Kategori::delete/$1');
$routes->get('/kategori/(:segment)', 'Kategori::detail/$1');

$routes->get('/pakaian', 'Pakaian::index');
$routes->get('/pakaian/create', 'Pakaian::create');
$routes->post('/pakaian/save', 'Pakaian::save');
$routes->get('/pakaian/edit/(:segment)', 'Pakaian::edit/$1');
$routes->put('/pakaian/update/(:num)', 'Pakaian::update/$1');
$routes->delete('/pakaian/(:num)', 'Pakaian::delete/$1');
$routes->get('/pakaian/(:any)', 'Pakaian::detail/$1');

$routes->get('/keranjang', 'Keranjang::index');
$routes->get('/transaksi', 'Keranjang::transactionsIndex');
$routes->put('/checkout', 'Keranjang::checkout');
$routes->get('/transaksi/(:segment)', 'Keranjang::detail/$1');

$routes->post('/saveitem/(:num)', 'ItemKeranjang::saveItem/$1');
$routes->put('/updateitem/(:num)', 'ItemKeranjang::updateStokBeforeDeleteItem/$1');
$routes->put('/updateitem/decrement/(:num)', 'ItemKeranjang::updateItemDecrement/$1');
$routes->put('/updateitem/increment/(:num)', 'ItemKeranjang::updateItemIncrement/$1');
$routes->delete('/deleteitem/(:num)', 'ItemKeranjang::deleteItem/$1');
