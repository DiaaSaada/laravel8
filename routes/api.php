<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'namespace' => 'API',
    ], function () {
    Route::middleware('throttle:60,1,default')->group(function () {

        Route::post('image-upload', [\App\Http\Controllers\API\ImageUploadController::class, 'uploadImage']);
        // auth via facebook
        Route::get('test_api', [\App\Http\Controllers\API\ApiController::class, 'test_api']);
        Route::get('test_repository', [\App\Http\Controllers\API\ApiController::class, 'test_repository']);

    });

});

