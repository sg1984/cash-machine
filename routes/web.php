<?php

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

$router->get('withdraw', [
    'as' => 'withdraw',
    'uses' => 'CashMachineController@makeWithdraw',
]);

$router->post('withdraw', [
    'as' => 'withdraw',
    'uses' => 'CashMachineController@makeWithdraw',
]);

$router->get('/', [
    'as' => 'withdraw',
    'uses' => 'CashMachineController@info',
]);

$router->get('/{info}', [
    'as' => 'withdraw',
    'uses' => 'CashMachineController@info',
]);