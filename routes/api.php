<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//||||||||||||||||||||||||||||||||||||||||||||||||||||||
//---------------GUEST----------------------------------

//---------------REGISTER_LOGIN-------------------//
Route::post("/register",[AuthController::class,'register']);
Route::post("/login",[AuthController::class,"login"]);
//DEPARTMENTS(guest)------------------------------
Route::get("/department",[DepartmentController::class,"index"]);
Route::get("/department/{department}",[DepartmentController::class,"read"]);
//DOCTORS(guest)----------------------------------
Route::get("/doctor",[DoctorController::class,'index']);
Route::get("/doctor/{doctor}",[DoctorController::class,'read']);


//----------------GUEST END ----------------------
//|||||||||||||||||||||||||||||||||||||||||||||||||
//|||||||||||||||||||||||||||||||||||||||||||||||||
//--------------AUTH-----------------------------//
Route::middleware("auth:sanctum")->group(function (){
    //USERS------------------------------------
    Route::get("/logout",[AuthController::class,"logout"]);
    Route::get("/index",[AuthController::class,"index"]);
    Route::get('/profile/{user}',[AuthController::class,'view']);
    Route::patch("/update/{user}",[AuthController::class,'update']);
    Route::delete("/delete/{user}",[AuthController::class,'destroy']);
    //ROLES------------------------------------
    Route::get('/role',[RoleController::class,'index']);
    Route::get('/role/{role}',[RoleController::class,'read']);
    Route::post('/role',[RoleController::class,'create']);
    Route::patch('/role/update/{role}',[RoleController::class,'update']);
    Route::delete('/role/delete/{role}',[RoleController::class,'destroy']);
    //DEPARTMENTS(auth_required)----------------
    Route::post("/department",[DepartmentController::class,"create"]);
    Route::patch("/department/update/{department}",[DepartmentController::class,"update"]);
    Route::delete("/department/delete/{department}",[DepartmentController::class,"delete"]);
    //DOCTORS-----------------------------------
    Route::post("/doctor",[DoctorController::class,'create']);
    Route::patch("/doctor/update/{doctor}",[DoctorController::class,'update']);
    Route::delete("/doctor/delete/{doctor}",[DoctorController::class,'delete']);
});
//--------------AUTH END-------------------------------//
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
