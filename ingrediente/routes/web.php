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

$router->group(["prefix" =>"/v1"],function () use ($router){
    // $router->group(["prefix" =>"/ingrediente"],function () use ($router){
        $router->post("/register",'IngredienteController@create');
        $router->get("/list",'IngredienteController@getList');
        $router->post("/get",'IngredienteController@getIngrediente');        
        $router->get("/buy/{id}/{idpedido}",'IngredienteController@buy');
        $router->put("/update/{id}",'IngredienteController@update');
        $router->delete("/delete/{id}",'IngredienteController@delete');
        $router->get("/restore/{id}",'IngredienteController@restore');
    // });
});