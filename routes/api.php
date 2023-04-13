<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/test', function (Request $request){
    return 'Testign'; 
});

Route::post('/test2', function (Request $request){
    return 'Testing2'; 
});

// Authentication Route
Route::post('/login',[AuthController::class,'login']);
// Route::post('/register'[AuthController::class,'register']);
// Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('/auth/login',function(Request $request){
    return $request->all();
});

Route::apiResource('posts',PostController::class);

Route::group(['middleware'=>'auth:sanctum'], function(){

    Route::apiResource('posts.comments',CommentController::class)->shallow();

});