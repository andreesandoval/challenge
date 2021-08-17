<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\RecentlyViewedProductController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'users/{userId}'], function () use ($router) {
    $router->get('recently-viewed', ['uses' => 'RecentlyViewedProductController@list']);
    
    $router->post('recently-viewed', ['uses' => 'RecentlyViewedProductController@save']);
    
    $router->delete('recently-viewed/{productId}', ['uses' => 'RecentlyViewedProductController@delete']);
});
