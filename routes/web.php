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

Route::get('/confirmation',function(){
    return view('confirmation');
});




Route::get('/register', [AuthController::class, 'createForm']);
Route::post('/register', [AuthController::class, 'create']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/account', [AuthController::class, 'account'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [CompetitionController::class, 'indexAdmin']);
    Route::get('/admin/create', [CompetitionController::class, 'create']);
    Route::post('/admin', [CompetitionController::class, 'store']);

    Route::get('/admin/{id}/edit', [CompetitionController::class, 'edit']);
    Route::put('/admin/{id}', [CompetitionController::class, 'update']);

    Route::delete('/admin/{id}', [CompetitionController::class, 'destroy']);
});

Route::get('/calendrier', [CompetitionController::class, 'calendrier']);

