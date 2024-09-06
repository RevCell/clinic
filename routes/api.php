<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WorkingHoursController;
use Illuminate\Support\Facades\Route;

//||||||||||||||||||||||||||||||||||||||||||||||||||||||
//---------------GUEST----------------------------------

    //REGISTER_LOGIN----------------------------------
    Route::post("/register",[AuthController::class,'register']);
    Route::post("/login",[AuthController::class,"login"]);
    //DEPARTMENTS-------------------------------------
    Route::get("/department",[DepartmentController::class,"index"]);
    Route::get("/department/{department}",[DepartmentController::class,"read"]);
    //DOCTORS-----------------------------------------
    Route::get("/doctor",[DoctorController::class,'index']);
    Route::get("/doctor/{doctor}",[DoctorController::class,'read']);
    //DAYS_OF_WEEK------------------------------------
    Route::get("/days-of-week",[DaysController::class,'index']);
    Route::get("/days-of-week/{daysOfWeek}",[DaysController::class,"read"]);
    //WORKING_HOURS------------------------------------
    Route::get("/working-hours",[WorkingHoursController::class,"index"]);
    Route::get("/working-hours/{workingHours}",[WorkingHoursController::class,'read']);

//----------------GUEST END ----------------------
//|||||||||||||||||||||||||||||||||||||||||||||||||
//|||||||||||||||||||||||||||||||||||||||||||||||||
//--------------AUTH-----------------------------//
Route::middleware("auth:sanctum")->group(function (){
    //USERS-------------------------------------------
    Route::get("/logout",[AuthController::class,"logout"]);
    Route::get("/index",[AuthController::class,"index"]);
    Route::get('/profile/{user}',[AuthController::class,'view']);
    Route::patch("/update/{user}",[AuthController::class,'update']);
    Route::delete("/delete/{user}",[AuthController::class,'destroy']);
    //ROLES-------------------------------------------
    Route::get('/role',[RoleController::class,'index']);
    Route::get('/role/{role}',[RoleController::class,'read']);
    Route::post('/role',[RoleController::class,'create']);
    Route::patch('/role/update/{role}',[RoleController::class,'update']);
    Route::delete('/role/delete/{role}',[RoleController::class,'destroy']);
    //DEPARTMENTS-------------------------------------
    Route::post("/department",[DepartmentController::class,"create"]);
    Route::patch("/department/update/{department}",[DepartmentController::class,"update"]);
    Route::delete("/department/delete/{department}",[DepartmentController::class,"delete"]);
    //DOCTORS-----------------------------------------
    Route::post("/doctor",[DoctorController::class,'create']);
    Route::patch("/doctor/update/{doctor}",[DoctorController::class,'update']);
    Route::delete("/doctor/delete/{doctor}",[DoctorController::class,'delete']);
    //DAYS_OF_WEEK------------------------------------
    Route::post("/days-of-week/create/{daysOfWeek}",[DaysController::class,'create']);
    Route::patch("/days-of-week/update/{daysOfWeek}",[DaysController::class,'update']);
    Route::delete("/days-of-week/delete/{daysOfWeek}",[DaysController::class,'delete']);
    //WORKING_HOURS------------------------------------
    Route::post("/working-hours/create",[WorkingHoursController::class,'create']);
    Route::patch("/working-hours/update-doctor/{workingHours}",[WorkingHoursController::class,'update_doctor']);
    Route::patch("/working-hours/update-admin/{workingHours}",[WorkingHoursController::class,'update_admin']);
    Route::delete("/working-hours/delete/{workingHours}",[WorkingHoursController::class,'delete']);

});
//--------------AUTH END-------------------------------//
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||
