<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/competitions',[CompetitionController::class,'index']);
