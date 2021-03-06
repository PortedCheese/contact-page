<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Vendor\ContactPage\Admin',
    'middleware' => ['web', 'management'],
    'as' => 'admin.',
    'prefix' => 'admin',
], function () {
    Route::put('contact/settings', 'ContactController@saveSettings')
        ->name('contact.save-settings');
    Route::resource('contact', 'ContactController')->except([
        'create', 'edit'
    ]);
    Route::group([
        'as' => 'vue.contact.',
        'prefix' => 'vue/contact/{contact}',
    ], function () {
        Route::post('coord', 'ContactController@setCoord')
            ->name('set-coord');
        Route::post('days', 'ContactController@setDays')
            ->name('set-days');
        Route::post('links', 'ContactController@setLinks')
            ->name('set-links');
    });
});