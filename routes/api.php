<?php

$router->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers\Api'], function ($router) {
    $router->group(['auth:sanctum', 'verified'], function ($router) {
        $router->group(['prefix' => 'editor'], function ($router) {
            $router->post('save-content/{fileId}', 'EditorController@saveContent');
        });
    });
});
