<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//---------------REGISTER_LOGIN-------------------//
Route::post("/register",[AuthController::class,'register']);
Route::post("/login",[AuthController::class,"login"]);

//--------------AUTH-----------------------------//
Route::middleware("auth:sanctum")->group(function (){
    //USERS--------------------
    Route::get("/logout",[AuthController::class,"logout"]);
    Route::get("/index",[AuthController::class,"index"]);
    Route::get('/profile/{user}',[AuthController::class,'view']);
    Route::patch("/update/{user}",[AuthController::class,'update']);
    Route::delete("/delete/{user}",[AuthController::class,'destroy']);
});

