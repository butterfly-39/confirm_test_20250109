<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::get('/admin', [ContactController::class, 'admin']);
    Route::delete('/admin/{id}', [ContactController::class, 'destroy']);
    Route::get('/admin/export', [ContactController::class, 'export']);
    Route::get('/logout', [ContactController::class, 'logout']);
});
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

