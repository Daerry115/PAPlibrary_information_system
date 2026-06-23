<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('dashboard', 'DashboardController::index');
$routes->get('books', 'BookController::index');
$routes->get('list/books', 'BookController::index');
$routes->get('list/users', 'UserController::index');

$routes->get('/create/book', 'BookController::create');
$routes->post('/create/book', 'BookController::store');

$routes->get('/edit/book/(:num)', 'BookController::edit/$1');
$routes->post('/update/book/(:num)', 'BookController::update/$1');
$routes->get('/delete/book/(:num)', 'BookController::delete/$1');

$routes->get('book/trash', 'BookController::trash');
$routes->get('/restore/book/(:num)', 'BookController::restore/$1');
$routes->get('/purge/book/(:num)', 'BookController::purge/$1');

$routes->get('list/members', 'MemberController::index');
$routes->get('/create/member', 'MemberController::create');
$routes->post('/create/member', 'MemberController::store');
$routes->get('/edit/member/(:num)', 'MemberController::edit/$1');
$routes->post('/update/member', 'MemberController::update');
$routes->post('/delete/member/(:num)', 'MemberController::delete/$1');

// Laporan Routes
$routes->get('/laporan/buku', 'LaporanController::buku');
$routes->get('/laporan/cetak-buku', 'LaporanController::cetakBuku');

$routes->get('/laporan/label-buku', 'LaporanController::labelBuku');
$routes->get('/laporan/cetak-label-buku', 'LaporanController::cetakLabelBuku');
$routes->get('/laporan/cetak-label-buku/(:num)', 'LaporanController::cetakLabelSatu/$1');

$routes->get('/laporan/cetak-member', 'LaporanController::cetakMember');

// Peminjaman Routes
$routes->get('/peminjaman', 'PeminjamanController::index');
$routes->post('/peminjaman/get-anggota', 'PeminjamanController::getAnggota');

$routes->post('/peminjaman/store', 'PeminjamanController::store');
$routes->post('/peminjaman/kembalikan/(:num)', 'PeminjamanController::kembalikan/$1');
$routes->get('peminjaman/semua', 'PeminjamanController::semua');
$routes->get('peminjaman/laporan-denda', 'PeminjamanController::laporanDenda');