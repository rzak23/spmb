<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Home;
use App\Controllers\Kabupaten\KabupatenController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);
$routes->post('login', [LoginController::class, 'login_proses']);
$routes->get('logout', [LoginController::class, 'logout_proses']);

$routes->get('dashboard', [Home::class, 'halaman_dashboard']);
$routes->group('kabupaten', function($routes){
    $routes->get('', [KabupatenController::class, 'index']);
    $routes->get('add', [KabupatenController::class, 'form_ae']);
    $routes->group('save', function($routes){
        $routes->post('', [KabupatenController::class, 'save']);
        $routes->post('(:num)', [KabupatenController::class, 'save']);
    });
    $routes->get('edit/(:num)', [KabupatenController::class, 'form_ae']);
    $routes->get('hapus/(:num)', [KabupatenController::class, 'hapus_data']);
});
