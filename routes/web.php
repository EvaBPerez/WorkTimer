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
Route::view('/my_projects','welcome');
Route::view('/project_analitic/{id}','welcome');
Route::view('/homework_analitic/{id}','welcome');
Route::view('/homeworks/{id}','welcome');
Route::view('/footer','welcome');
Route::view('/tutorial','welcome');
Route::view('/login','welcome');
Route::view('/signup','welcome');
Route::view('/setting','welcome');
Route::view('/template_object/{template_object}','welcome');
Route::view('/edit_project/{id}','welcome');
Route::view('/edit_user_admin/{id}','welcome');
Route::view('/edit_homework/{id}','welcome');
Route::view('/delete/{ids}','welcome');
Route::view('/history','welcome');
Route::view('/users_list','welcome');
Route::view('/create_user','welcome');

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\HistoryController;
//############## Controller user ##################
Route::post('/signup', [UserController::class, 'create']);
Route::post('/create_user', [UserController::class, 'createAdmin']);
Route::get('/all_users', [UserController::class, 'index']);
Route::get('/token', [UserController::class, 'show']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/update', [UserController::class, 'update']);
Route::post('/update_admin', [UserController::class, 'updateUserAdmin']);
Route::get('/user_info/{id}', [UserController::class, 'userInfo']);
Route::post('/delete_user', [UserController::class, 'destroy']);
Route::post('/delete_users', [UserController::class, 'destroyUsers']);


//############## Controller project ##################
Route::get('/all_projects/{id}', [ProjectController::class, 'index']);
Route::post('/add_project', [ProjectController::class, 'create']);
Route::post('/update_project', [ProjectController::class, 'update']);
Route::get('/edit/{id}', [ProjectController::class, 'show']);
Route::get('/delete/{ids}', [ProjectController::class, 'destroy']);


//############## Controller homework ##################
Route::get('/all_homeworks/{id}', [HomeworkController::class, 'index']);
Route::post('/add_homework', [HomeworkController::class, 'create']);
Route::get('/edit_h/{id}', [HomeworkController::class, 'show']);
Route::post('/update_homework', [HomeworkController::class, 'update']);
Route::get('/delete_h/{ids}', [HomeworkController::class, 'destroy']);


//############## History homework ##################
Route::post('/add_history', [HistoryController::class, 'create']);
Route::post('/update_history', [HistoryController::class, 'update']);
Route::get('/all_history/{id}', [HistoryController::class, 'index']);
Route::get('/graphic_day_project/{id}', [HistoryController::class, 'graphicDaysProject']);
Route::get('/graphic_day_homework/{id}', [HistoryController::class, 'graphicDaysHomework']);
Route::get('/recent_homework/{id}', [HistoryController::class, 'recentHomework']);
Route::get('/crono_on/{id}', [HistoryController::class, 'show']);
Route::post('/delete_hy', [HistoryController::class, 'destroy']);