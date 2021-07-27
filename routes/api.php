<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClassesController;
use App\Http\Controllers\Api\EmployeeController;

//Route::apiResource('/class',ClassesController::class);

Route::apiResource('/employee',EmployeeController::class);

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


//auth routes
Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

});
