<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Guru\GuruController;
use App\Controllers\Home;
use App\Controllers\Kabupaten\KabupatenController;
use App\Controllers\Kecamatan\KecamatanController;
use App\Controllers\Sekolah\SekolahController;
use App\Controllers\Siswa\SiswaController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);
$routes->post('login', [LoginController::class, 'login_proses']);
$routes->get('logout', [LoginController::class, 'logout_proses']);

$routes->get('dashboard', [Home::class, 'halaman_dashboard'], ['filter' => 'auth']);
$routes->group('kabupaten', ['filter' => 'auth'], function($routes){
    $routes->get('', [KabupatenController::class, 'index']);
    $routes->get('add', [KabupatenController::class, 'form_ae']);
    $routes->group('save', function($routes){
        $routes->post('', [KabupatenController::class, 'save']);
        $routes->post('(:num)', [KabupatenController::class, 'save']);
    });
    $routes->get('edit/(:num)', [KabupatenController::class, 'form_ae']);
    $routes->get('hapus/(:num)', [KabupatenController::class, 'hapus_data']);
});

$routes->group('kecamatan', ['filter' => 'auth'], function($routes){
    $routes->get('', [KecamatanController::class, 'index']);
    $routes->get('add', [KecamatanController::class, 'form_ae']);
    $routes->group('save', function($routes){
        $routes->post('', [KecamatanController::class, 'save']);
        $routes->post('(:num)', [KecamatanController::class, 'save']);
    });
    $routes->get('edit/(:num)', [KecamatanController::class, 'form_ae']);
    $routes->get('hapus/(:num)', [KecamatanController::class, 'hapus_data']);
});

$routes->group('sekolah', ['filter' => 'auth'], function($routes){
    $routes->get('', [SekolahController::class, 'index']);
    $routes->get('add', [SekolahController::class, 'form_ae']);
    $routes->group('save', function($routes){
        $routes->post('', [SekolahController::class, 'save']);
        $routes->post('(:num)', [SekolahController::class, 'save']);
    });
    $routes->get('edit/(:num)', [SekolahController::class, 'form_ae']);
    $routes->get('hapus/(:num)', [SekolahController::class, 'hapus_data']);
});

$routes->group('guru', ['filter' => 'auth'], function($routes){
    $routes->get('', [GuruController::class, 'index']);
    $routes->get('add', [GuruController::class, 'form_ae']);
    $routes->group('save', function($routes){
        $routes->post('', [GuruController::class, 'save']);
        $routes->post('(:num)', [GuruController::class, 'save']);
    });
    $routes->get('edit/(:num)', [GuruController::class, 'form_ae']);
    $routes->get('hapus/(:num)', [GuruController::class, 'hapus_data']);
});

$routes->group('siswa', ['filter' => 'auth'], function($routes){
    $routes->get('', [SiswaController::class, 'index']);
    $routes->get('add', [SiswaController::class, 'form_ae']);
    $routes->group('save', function($routes){
        $routes->post('', [SiswaController::class, 'save']);
    });
});

//----------------------- routes ajax --------------------------------//
$routes->group('api', function($routes){
    $routes->post('get-list-kecamatan', [KecamatanController::class, 'get_list_by_kabupaten']);
});
