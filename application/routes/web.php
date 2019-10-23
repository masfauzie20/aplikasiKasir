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
Route::group(['middleware'=> ['guest']], function () use ($router) {
    Route::get('/', 'Auth\LoginController@index')->name('login');
    Route::post('/login/auth', 'Auth\LoginController@authenticate');
            
    /* Forget Password */
    Route::get('/forget', 'Auth\ForgotPasswordController@index')->name('forget');
    Route::post('/forgot-password/auth', 'Auth\ForgotPasswordController@create');
        
    });

    Route::group(['middleware'=> ['auth', 'revalidate']], function() {
        Route::get('/logout/auth', 'Auth\LoginController@logout')->name('logout');
        
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/home', 'HomeController@index')->name('home');

    /* Pegawai */
    Route::group(['prefix'=> 'petugas'], function() {
        Route::get('/', 'PetugasController@index')->name('petugas');
        Route::get('/create', 'PetugasController@create');
        Route::post('/store', 'PetugasController@store');
        Route::get('/edit/{id}', 'PetugasController@edit');
        Route::put('/update/{id}', 'PetugasController@update');
        Route::delete('/delete/{id}', 'PetugasController@destroy');
    });

    /*Barang */
    Route::group(['prefix'=> 'barang'], function() {
        Route::get('/', 'BarangController@index')->name('barang');
        Route::get('/create', 'BarangController@create');
        Route::post('/store', 'BarangController@store');
        Route::get('/edit/{id}', 'BarangController@edit');
        Route::post('/update', 'BarangController@update');
        Route::delete('/delete/{id}', 'BarangController@destroy')->name('barang-delete');
    });

    /*Transaksi */
    Route::group(['prefix'=> 'transactions'], function() {
        Route::get('/', 'TransactionsController@index')->name('transactions');
        Route::get('/create', 'TransactionsController@create')->name('transactions.create');
        Route::get('/detail', 'TransactionsController@detail')->name('transactions.detail');
        Route::post('/store', 'TransactionsController@store');
        Route::get('/edit/{id}', 'TransactionsController@edit');
        Route::post('/update', 'TransactionsController@update');
        Route::get('/delete/{id}', 'TransactionsController@destroy')->name('transactions.delete');
    });

    /*Cart */
    Route::group(['prefix'=> 'cart'], function() {
        Route::post('/create', 'CartController@create')->name('cart.create');
        Route::get('/delete/{id}', 'CartController@destroy')->name('cart.delete');
    });

});
