<?php

use App\Http\Controllers\LevelsController;
use App\Http\Controllers\SubjectsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('create_level',[LevelsController::class,'newLevel']);
Route::post('create_subject',[SubjectsController::class,'createSubject']);
Route::get('get_subjects',[SubjectsController::class,'getSubjects']);
 Route::get('get_levels',[LevelsController::class,'getLevels']);
