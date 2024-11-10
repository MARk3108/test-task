<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('swagger/docs/api-docs.yaml', function () {
    $path = resource_path('swagger/api-docs.yaml');

    if (!File::exists($path)) {
        abort(404, 'Swagger YAML file not found');
    }

    return Response::file($path, [
        'Content-Type' => 'application/x-yaml',
    ]);
});