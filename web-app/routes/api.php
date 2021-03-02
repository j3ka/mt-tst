<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\AuthController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(
    [
        'middleware' => 'auth',
        'prefix' => 'auth'
    ],
    function($router) {
        $router->get('me', AuthController::class . '@me');
    }
);

$router->group(
    ['prefix' => 'auth'],
    function() use ($router) {
        $router->post('login', AuthController::class . '@login');
    }
);
