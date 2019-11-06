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

// Autentikasi
Route::group(['prefix' => 'auth'], function () {
    Route::get('/signin', 'AuthController@vSignin');
    Route::post('/signin', 'AuthController@validateSignin');
    Route::get('/logout', 'AuthController@logout');
});

// Signed in only
Route::group(['middleware' => ['check.signin']], function () {
    // Home
    Route::get('/home', 'DashboardController@home');
    Route::get('/', function () {
        return redirect('/home');
    });

    // Menu
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/home', 'MenuController@home');
        // Admin & waiter only
        Route::group(['middleware' => ['adminwaiter.access']], function () {
            Route::get('/new', 'MenuController@vNew');
            Route::post('/new', 'MenuController@validateNew');
            Route::get('/update/{id}', 'MenuController@vEdit');
            Route::put('/update/{id}', 'MenuController@validateEdit');
            Route::delete('/delete', 'MenuController@validateDelete');
            Route::get('/json/{id}', 'MenuController@getWithJson');
        });
    });
    
    // Pesanan
    Route::group(['prefix' => 'pesanan'], function () {
        Route::get('/home', 'PesananController@home');
        Route::get('/{id_pesanan}/detail', 'DetailPesananController@home')->name('detail.home');
        Route::get('/total/{id}', 'PesananController@getTotal');
        // All except admin
        Route::get('/download-report', 'PesananController@exportToExcel')->middleware('except.admin');
        // Waiter only
        Route::group(['middleware' => ['waiter.access']], function () {
            Route::get('/new', 'PesananController@vNew');
            Route::post('/new', 'PesananController@validateNew');
            Route::get('/update/{id}', 'PesananController@vEdit');
            Route::put('/update/{id}', 'PesananController@validateEdit');
            Route::delete('/delete', 'PesananController@validateDelete');
            Route::get('/json/{id}', 'PesananController@getWithJson');
            // Detail Pesanan
            Route::get('/{id_pesanan}/detail/new', 'DetailPesananController@vNew')->name('detail.vnew');
            Route::post('/{id_pesanan}/detail/new', 'DetailPesananController@validateNew')->name('detail.new');
            Route::post('/{id_pesanan}/detail/submit', 'DetailPesananController@store')->name('detail.store');
            Route::get('/{id_pesanan}/detail/update/{id}', 'DetailPesananController@vEdit')->name('detail.vedit');
            Route::put('/{id_pesanan}/detail/update/{id}', 'DetailPesananController@validateEdit')->name('detail.edit');
            Route::delete('/detail/delete', 'DetailPesananController@validateDelete');
            Route::get('/detail/json/{id}', 'DetailPesananController@getWithJson');
        });
    });

    // Meja
    Route::group(['prefix' => 'meja'], function () {
        Route::get('/home', 'MejaController@home');
        // Admin only
        Route::group(['middleware' => ['admin.access']], function () {
            Route::get('/new', 'MejaController@vNew');
            Route::post('/new', 'MejaController@validateNew');
            Route::get('/update/{id}', 'MejaController@vEdit');
            Route::put('/update/{id}', 'MejaController@validateEdit');
            Route::delete('/delete', 'MejaController@validateDelete');
            Route::get('/json/{id}', 'MejaController@getWithJson'); 
        });
    });

    // Transaksi
    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/home', 'TransaksiController@home');
        // All except admin
        Route::get('/download-report', 'TransaksiController@exportToExcel')->middleware('except.admin');
        // Kasir only
        Route::group(['middleware' => ['kasir.access']], function () {
            Route::get('/bayar',  'TransaksiController@vBayar');
            Route::post('/bayar', 'TransaksiController@validateBayar');
            Route::get('/{id}/print', 'TransaksiController@downloadInvo')->name('transaksi.invo');
        });
    });
});