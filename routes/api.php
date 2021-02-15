<?php

use Illuminate\Support\Facades\Route;
use Publish\Http\Controllers\LastPublishRunController;
use Publish\Http\Controllers\PublishController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::post('/publish', PublishController::class);

Route::get('/last-publish-run', LastPublishRunController::class);
