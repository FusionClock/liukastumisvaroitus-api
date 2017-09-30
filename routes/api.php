<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Routing\Route as ApiRoute;

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

Route::get('/', function () {
    $routes = Route::getRoutes()->getRoutes();
    $routes = new Collection($routes);

    $api = $routes->map(function (ApiRoute $route) {
        return [
            'uri' => URL::to($route->uri),
            'methods' => $route->methods,
        ];
    });

    return JsonResponse::create($api);
});

Route::resource('warnings', 'WarningController', ['only' => [
    'index', 'show',
]]);
