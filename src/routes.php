<?php

Route::get('sablon-demo', function() {
    return Redirect::to('sablon-demo/dashboard');
});

Route::group(array('prefix' => 'sablon-demo'), function(){

    Route::get('dashboard', function() {
        return View::make('sablon::_demo.dashboard')
            ->with('title', 'Sablon Demo - Aql2 Dashboard');
    });
    Route::get('signin', function() {
        return View::make('sablon::_demo.signin')
            ->with('title', 'Sablon Demo - Aql2 Signin');
    });
    Route::post('signin', function() {
        return Redirect::to('sablon-demo');
    });
    Route::get('tables', function(){
        return View::make('sablon::_demo.tables')
            ->with('title', 'Sablon Demo - Aql2 Tables');
    });
    Route::get('forms', function(){
        return View::make('sablon::_demo.forms')
            ->with('title', 'Sablon Demo - Aql2 Forms');
    });

});