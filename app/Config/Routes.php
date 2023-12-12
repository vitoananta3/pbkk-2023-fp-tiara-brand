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
