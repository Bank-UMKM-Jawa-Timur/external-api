<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\V1\PengajuanController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'pemprof','middleware' => 'PemprovToken'], function () use ($router) {
    $router->post('store', 'V1\PengajuanController@store');
    $router->post('list-cabang', 'V1\CabangController@listCabang');
    $router->post('list-kotakab', 'V1\KotaController@listKota');
    $router->post('list-kecamatan', 'V1\KecamatanController@listKecamatan');
    $router->post('list-desa', 'V1\DesaController@listDesa');
});

