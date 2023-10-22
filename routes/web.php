<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(config('scramble.middleware', [RestrictedDocsAccess::class]))->group(function () {
    Route::get('/api.json', function (Dedoc\Scramble\Generator $generator) {
        return $generator();
    });

    Route::view('/api', 'scramble::docs');
});