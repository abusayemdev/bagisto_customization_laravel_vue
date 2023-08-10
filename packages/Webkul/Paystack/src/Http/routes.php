<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('paystack/standard')->group(function () {

        Route::get('/redirect', 'Webkul\Paystack\Http\Controllers\StandardController@redirect')->name('paystack.standard.redirect');
        Route::get('/callback', 'Webkul\Paystack\Http\Controllers\StandardController@verify')->name('paystack.standard.verify');

        Route::get('/success', 'Webkul\Paystack\Http\Controllers\StandardController@success')->name('paystack.standard.success');

        Route::get('/cancel', 'Webkul\Paystack\Http\Controllers\StandardController@cancel')->name('paystack.standard.cancel');
        Route::get('paystack/standard/ipn', 'Webkul\Paystack\Http\Controllers\StandardController@ipn')->name('paystack.standard.ipn');
    });
});

//Route::get('paystack/standard/ipn', 'Webkul\Paystack\Http\Controllers\StandardController@ipn')->name('paystack.standard.ipn');
