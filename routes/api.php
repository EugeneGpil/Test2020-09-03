<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'namespace' => 'API'

], function($router) {

    Route::group([

        'middleware' => 'api',
    
    ], function ($router) {
    
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');



        Route::group([
    
            'prefix' => 'v1',
            'namespace' => 'Document'
        
        ], function ($router) {
        
            Route::post('document', 'DocumentController@create');
            Route::get('document/{id}', 'DocumentController@find');
            Route::patch('document/{id}', 'DocumentController@update');
            Route::post('document/{id}/publish', 'DocumentController@publish');
            Route::get('document', 'DocumentController@getPage');
        
        });
    
    });
});