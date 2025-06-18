<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// BUKU
$routes->group('buku', function($routes) {
    $routes->get('/', 'Buku::index'); // GET /dosen
    $routes->get('nama/(:segment)', 'Buku::showName/$1'); // GET /dosen/nama/{nama}
    $routes->get('(:segment)', 'Buku::show/$1'); // GET /dosen/{id}
    $routes->post('/', 'Buku::create'); // POST /dosen
    $routes->put('(:segment)', 'Buku::update/$1'); // PUT /dosen/{id}
    $routes->delete('(:segment)', 'Buku::delete/$1'); // DELETE /dosen/{id}
});

// PEMINJAMAN
$routes->group('peminjaman', function($routes) {
    $routes->get('/', 'Peminjaman::index'); // GET /dosen
    $routes->get('nama/(:segment)', 'Peminjaman::showName/$1'); // GET /dosen/nama/{nama}
    $routes->get('(:segment)', 'Peminjaman::show/$1'); // GET /dosen/{id}
    $routes->post('/', 'Peminjaman::create'); // POST /dosen
    $routes->put('(:segment)', 'Peminjaman::update/$1'); // PUT /dosen/{id}
    $routes->delete('(:segment)', 'Peminjaman::delete/$1'); // DELETE /dosen/{id}
});
