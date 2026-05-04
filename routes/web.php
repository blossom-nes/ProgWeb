<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/competitions',[CompetitionController::class,'index']);
Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::get('/reservation', [ReservationController::class, 'create']);
Route::post('/reservation', [ReservationController::class, 'store']);




Route::get('/register', [AuthController::class, 'createForm']);
Route::post('/register', [AuthController::class, 'create']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/account', [AuthController::class, 'account'])->middleware('auth');

