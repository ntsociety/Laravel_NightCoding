<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('accueil');
});


Route::get('test', [Controller::class, 'test']);
Route::post('store', [Controller::class, 'store']);
Route::put('update', [Controller::class, 'update']);
Route::delete('delete', [Controller::class, 'delete']);

// admin

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [Controller::class, 'dashboard']);
    Route::get('/profil', [Controller::class, 'profil']);
    Route::get('/parametre', [Controller::class, 'parametre']);
});

// user
Route::prefix('user')->group(function () {
    Route::get('/dashboard', [Controller::class, 'dashboard']);
    Route::get('/profil', [Controller::class, 'profil']);
    Route::get('/parametre', [Controller::class, 'parametre']);
});


// manager
Route::prefix('manager')->group(function () {
    Route::get('/dashboard', [Controller::class, 'dashboard']);
    Route::get('/profil', [Controller::class, 'profil']);
    Route::get('/parametre', [Controller::class, 'parametre']);
});



// catégorie
Route::get('test-accueil', [TestController::class, 'index'])->name('test');
// route ressource
Route::resource('categorie', CategoryController::class);

// produit
Route::resource('produit', ProduitController::class)->middleware('auth');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
