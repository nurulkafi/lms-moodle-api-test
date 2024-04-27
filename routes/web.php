<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/courses', [CourseController::class, 'getAll']);
Route::post('course/search', [CourseController::class, 'search']);
Route::get('course/search/{value}', [CourseController::class, 'searchProcess']);
Route::get('/course/create', [CourseController::class, 'create']);
Route::post('/course/store', [CourseController::class, 'store']);
Route::get('/sign-up', [UsersController::class, 'signUp']);
Route::post('/signup', [UsersController::class, 'signUpPost']);
Route::get('/test', function () {
    return view('layouts.master');
});
