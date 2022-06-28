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
Route::view('/proyect_analitic/{id}','welcome');
Route::view('/footer','welcome');
Route::view('/tutorial','welcome');
Route::view('/login','welcome');
Route::view('/singup','welcome');
Route::view('/setting','welcome');
Route::view('/template_object/{template_object}','welcome');
Route::view('/edit_proyect/{id}','welcome');
Route::view('/delete/{ids}','welcome');

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\HistoryController;
//############## Controller user ##################
Route::post('/signup', [UserController::class, 'create']);
Route::get('/token', [UserController::class, 'show']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/update', [UserController::class, 'update']);
Route::get('/user_info', [UserController::class, 'user_info']);


//############## Controller proyect ##################
Route::get('/all_proyects/{id}', [ProyectController::class, 'index']);
Route::post('/add_proyect', [ProyectController::class, 'create']);
Route::post('/update_proyect', [ProyectController::class, 'update']);
Route::get('/edit/{id}', [ProyectController::class, 'show']);
Route::get('/delete/{ids}', [ProyectController::class, 'destroy']);


//############## Controller homework ##################
Route::get('/homeworks/{id}', [HomeworkController::class, 'index']);


//############## History homework ##################
Route::post('/add_history', [HistoryController::class, 'create']);
Route::post('/update_history', [HistoryController::class, 'update']);