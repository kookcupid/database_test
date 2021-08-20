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

// Route::get('/', function() {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'home']); 
Route::get('/home', [HomeController::class, 'home']);
Route::get('/student', [StudentController::class,'index']);
Route::post('/student/store', [StudentController::class,'store']);
Route::get('/listall', [HomeController::class, 'listData']);
Route::get('/listall', [StudentController::class, 'listData']);

Route::get('/api/student', [StudentController::class, 'api_student']);

