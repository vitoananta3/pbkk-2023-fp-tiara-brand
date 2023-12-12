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
