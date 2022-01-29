<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'/payments'],function($router){
    $router->get('/all-wallets','PaymentsController@allWallets');
    $router->get('/all-transactions','PaymentsController@allTransactions');
    $router->get('/user-wallet','PaymentsController@getUserWallet');
    $router->post('/bill-wallet','PaymentsController@billWallet');
});
