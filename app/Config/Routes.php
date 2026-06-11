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