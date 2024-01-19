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


$router->group(['prefix' => 'pemprov'], function () use ($router) {
    $router->get('test','V1\PengajuanController@index');

});
// Route::prefix('/pemprov')->group(function(){
//     Route::middleware([PemprovToken::class])->group(function(){
//         Route::post('/store', [PengajuanController::class, 'store']);
//         Route::post('/list-cabang', [CabangController::class, 'listCabang']);
//         Route::post('/list-kotakab', [KotaController::class, 'listKota']);
//         Route::post('/list-kecamatan', [KecamatanController::class, 'listKecamatan']);
//         Route::post('/list-desa', [DesaController::class, 'listDesa']);
//     });
// });
