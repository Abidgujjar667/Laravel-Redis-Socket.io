<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('home');
});

Route::get('/test',[\App\Http\Controllers\Test\TestController::class,'index']);

/*Route::get('/{vue_capture?}',function () {
    return redirect('/');
})->where('vue_capture', '[\/\w\.-]*');*/

/*Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*');*/

Auth::routes();