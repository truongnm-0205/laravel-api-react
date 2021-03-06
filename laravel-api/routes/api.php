<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('/students',[StudentController::class,'index']);
    Route::get('/students/{id}',[StudentController::class,'edit']);
    Route::post('/students/create',[StudentController::class,'create']);
    Route::post('/students/update/{id}',[StudentController::class,'store']);
    Route::delete('/students/delete/{id}',[StudentController::class,'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


