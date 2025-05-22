<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TombController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/search/tomb',[TombController::class,'searchTombApi']);


Route::post('/search/tomb/place',[TombController::class,'searchTombByPlaceApi']);



Route::post('/search/tomb/block',[TombController::class,'searchTombByBlockApi']);

Route::post('/search/tomb/date',[TombController::class,'searchTombByDateApi']);




Route::post('/get/block',[BlockController::class,'getBlockApi']);


Route::post('/get/user/phone',[UserController::class,'getUserByPhoneApi']);






Route::post('/get/news',[NewsController::class,'getNews']);


Route::post('/get/users',[UserController::class,'getUsers']);






Route::post('/upload-image', [UserController::class, 'uploadImageApi']);

Route::post('/upload-image/{id}',[UserController::class,'uploadUpadteImageApi']);

Route::post('/register',[UserController::class,'registerApi']);

Route::post('/edit/user',[UserController::class,'editUserApi']);

Route::post('/delete/user',[UserController::class,'deleteUserApi']);


Route::post('/search/users',[UserController::class,'getAllUserByNameApi']);

Route::post('/add/tomb',[TombController::class,'addTombApi']);

Route::post('/upload-death', [TombController::class, 'uploadImageDeathApi']);

Route::post('/upload-shahed', [TombController::class, 'uploadImageShahedApi']);


Route::post('/edit/tomb',[TombController::class,'editTombApi']);


Route::post('/upload-image-update/{id}',[TombController::class,'uploadUpadteImageApi']);


// addTombApi








