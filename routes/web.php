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

// home
    Route::group(['prefix' => 'home'], function () {
        
        Route::get('/', [HomeController::class, 'home']); 
        Route::get('/home', [HomeController::class, 'home']);
        Route::get('/listall', [HomeController::class, 'listData']);
        Route::get('/get/{id}', [HomeController::class, 'get_student']);
        Route::get('/api/home', [HomeController::class, 'api_home']);
    });    

// student
    Route::group(['prefix' => 'student'], function () {

        Route::get('/', [StudentController::class, 'student']);
        Route::get('/listall', [StudentController::class, 'listData']);
        Route::get('/get/{id}', [StudentController::class, 'get_student']);
        Route::get('/edit/{id}', [StudentController::class, 'edit_student']);
        Route::post('/update/{id}', [StudentController::class, 'update_student']);
        Route::get('/delete/{id}', [StudentController::class, 'delete_student']);
        Route::post('/store', [StudentController::class, 'store']);

        Route::get('/api/student', [StudentController::class, 'api_student']);
    });




