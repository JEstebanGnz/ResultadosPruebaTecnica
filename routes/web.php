<?php

use Illuminate\Support\Facades\Route;

/* >>>>>>>>>>>>>>>>>>>>> Forms answers routes <<<<<<<<<<<<<<<<<<<< */
Route::resource('api/answers', \App\Http\Controllers\FormAnswersController::class, [
    'as' => 'api'
]);

/* >>>>>>>>>>>>>>>>>>>>>>>>>>>> General routes <<<<<<<<<<<<<<<<<<<<<<<< */
Route::inertia('/', 'SuperTest');


Route::get('/prueba', [\App\Http\Controllers\PruebaController::class, 'index'])->name('prueba.index');
