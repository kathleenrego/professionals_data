<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::delete('/destroy', 'VinculoController@destroyMutiple')
    ->name('destroy');

Route::middleware('auth')->group(function () {

    Route::resource('vinculos', 'VinculoController');
    Route::get('atualizacoes','AtualizacaoController@index')->name('atualizacoes');
    Route::post('atualizar', 'AtualizacaoController@extractdata');

    Route::group(['prefix' => 'api'], function () {
        Route::get('vinculos', 'VinculoController@select')
            ->name('vinculos.select');
        Route::get('cbos', 'VinculoController@selectCbos')
            ->name('cbos.select');
        Route::get('tipos', 'VinculoController@selectTipos')
            ->name('tipos.select');
        Route::get('vinculacoes', 'VinculoController@selectVinculacoes')
            ->name('vinculacoes.select');
        Route::get('profissionais', 'VinculoController@selectProfissionais')->name('api.profissionais');
    });

});