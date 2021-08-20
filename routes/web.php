<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;

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

// Home
Route::get('/', [HomeController::class, 'home']); 
Route::get('/home', [HomeController::class, 'home']);

// Student
Route::group(['prefix' => 'student'], function () {

Route::get('/', [StudentController::class, 'student']);
Route::post('/add', [StudentController::class, 'add_student']);
Route::get('/edit/{id}', [StudentController::class, 'edit_student']);
Route::post('/update/{id}', [StudentController::class, 'update_student']);
Route::get('/get/{id}', [StudentController::class, 'get_student']);
Route::get('/delete/{id}', [StudentController::class, 'delete_student']);
Route::get('/listall', [StudentController::class, 'listData']);

Route::post('/store', [StudentController::class,'store']);

// api
Route::get('/api/student', [StudentController::class, 'api_student']);

});



