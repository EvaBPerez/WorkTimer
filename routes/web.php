<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/','welcome');
Route::view('/my_proyects','welcome');
Route::view('/homeworks/{id}','welcome');
Route::view('/footer','welcome');
Route::view('/tutorial','welcome');

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\HomeworkController;
//############## Controller user ##################
Route::post('/signup', [UserController::class, 'create']);


//############## Controller proyect ##################
Route::get('/all_proyects', [ProyectController::class, 'index']);
Route::post('/add_proyect', [ProyectController::class, 'create']);


//############## Controller homework ##################
Route::get('/homeworks/{id}', [HomeworkController::class, 'index']);