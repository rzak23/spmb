<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);
$routes->post('login', [LoginController::class, 'login_proses']);
$routes->get('logout', [LoginController::class, 'logout_proses']);

$routes->get('dashboard', [Home::class, 'halaman_dashboard']);
