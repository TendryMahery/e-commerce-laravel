<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UtilisateurController;

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

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});


Route::post('/login', [UtilisateurController::class, 'login']);

Route::get('/', [ProduitController::class, 'index']);
Route::get('/detail/{id}', [ProduitController::class, 'detail']);
Route::get('recherche', [ProduitController::class, 'recherche']);
Route::post('panier', [ProduitController::class, 'panier']);
Route::get('/list', [ProduitController::class, 'list']);
Route::get('/delete/{id}', [ProduitController::class, 'delete']);
Route::get('/order', [ProduitController::class, 'order']);
