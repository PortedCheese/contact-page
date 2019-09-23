<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Vendor\ContactPage\Site',
    'middleware' => ['web'],
    'as' => 'site.contact.',
], function () {
    if (! empty(siteconf()->get("contact-page", "path"))) {
        Route::get(siteconf()->get("contact-page", "path"), 'ContactController@page')
            ->name('page');
    }
});