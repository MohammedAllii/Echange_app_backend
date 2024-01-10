<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AuthController;



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


Auth::routes();


Route::middleware('auth.redirect')->group(function () {
    // Your routes here
    Route::get('/product-form', [ProduitController::class, 'showProduitForm'])->name('product.form');
    Route::view('/welcome', 'categories.create');
    Route::view('/', 'categories.create');
    Route::view('/ban', 'ban');
    Route::get('/ban', [AuthController::class, 'getAllusersNotBan']);
    Route::get('/banuser', [AuthController::class, 'banUserRoute']);
    Route::view('/notban', 'notban');
    Route::get('/notban', [AuthController::class, 'getAllusersBan']);
    Route::get('/notbanuser', [AuthController::class, 'notbanUserRoute']);
    Route::put('/banusers/{idUser}', [AuthController::class, 'banUser']);
    Route::put('/usersopen/{idUser}', [AuthController::class, 'openUser']);
    Route::post('/admin-login', [AuthController::class, 'loginAdmin'])->name('admin-login');
    Route::get('/catego', [CategorieController::class, 'getAllcategory']);
    Route::get('/categorie', [CategorieController::class, 'categoryRoute']);
    Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');




});
Route::resource('categories', CategorieController::class);
