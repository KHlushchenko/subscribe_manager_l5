<?php

Route::group([
    'middleware' => ['web'],
    'namespace' => 'Vis\SubscribeManager',
    'prefix'     => LaravelLocalization::setLocale(),
], function () {

    if (Request::ajax()) {

        Route::post('/subscribe/create',
            'SubscribeManagerController@doSubscribe');

        Route::post('/subscribe/create/{change}',
            'SubscribeManagerController@doSubscribe');

/*        Route::post('/subscribe/unsubscribe/{email}',
            'SubscribeManagerController@doUnsubscribe');*/

    }

});
