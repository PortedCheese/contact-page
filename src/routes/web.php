<?php

Route::group([
    'namespace' => 'PortedCheese\ContactPage\Http\Controllers\Admin',
    'middleware' => ['web', 'role:admin|editor'],
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

Route::group([
    'namespace' => 'PortedCheese\ContactPage\Http\Controllers\Site',
    'middleware' => ['web'],
    'as' => 'site.contact.',
    'prefix' => siteconf()->get('contact-page.path'),
], function () {
    Route::get('/', 'ContactController@page')
        ->name('page');
});