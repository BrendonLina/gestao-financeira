<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/cadastrar', [LoginController::class, 'cadastrar']);
Route::post('/cadastrar', [LoginController::class, 'cadastrarPost'])->name('cadastrar.post');

Route::post('/dashboard', [UserController::class, 'dashboard']);

Route::middleware(['auth'])->group(function () {

    
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::put('/carteira/{id}', [UserController::class, 'carteiraPost'])->name('carteira.add');
    Route::get('/carteira/{id}', [UserController::class, 'carteira'])->name('carteira');
});
