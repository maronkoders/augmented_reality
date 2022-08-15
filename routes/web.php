<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\UsersActivitiesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth


Route::get('/', [HomeController::class, 'landing'])
    ->name('/')
    ->middleware('guest');

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');


Route::get('not-authorized', [HomeController::class, 'notAuthorized'])
    ->name('not-authorized')
    ->middleware('auth');

Route::get('forgot-password', [AuthenticatedSessionController::class, 'forgotPassword'])
    ->name('forgot-password')
    ->middleware('guest');


Route::get('reset-password', [AuthenticatedSessionController::class, 'setNewPassword'])
    ->name('reset-password')
    ->middleware('guest');


    Route::post('reset-email', [AuthenticatedSessionController::class, 'resetEmail'])
    ->name('reset-email')
    ->middleware('guest');


Route::post('set-password', [AuthenticatedSessionController::class, 'saveNewPassword'])
    ->name('set-password')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware(['notAllowed','auth']);

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware(['notAllowed','auth']);

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('users_activity', [UsersActivitiesController::class, 'index'])
    ->name('users_activity')
    ->middleware('auth');


Route::get('users_activity', [UsersActivitiesController::class, 'index'])
    ->name('users_activity')
    ->middleware('auth');

Route::get('users_activity/{id}', [UsersActivitiesController::class, 'viewMore'])
    ->name('users_activity')
    ->middleware('auth');

Route::get('users_activity/{id}/{date}', [UsersActivitiesController::class, 'viewDateLogs'])
    ->name('users_activity')
    ->middleware('auth');

Route::get('organizations/create', [UsersActivitiesController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [UsersActivitiesController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

// Route::get('users_activity/{organization}/edit', [UsersActivitiesController::class, 'edit'])
//     ->name('organizations.edit')
//     ->middleware('auth');

Route::put('organizations/{organization}', [UsersActivitiesController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [UsersActivitiesController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [UsersActivitiesController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');


//school system
Route::get('levels', [LevelsController::class, 'index'])->name('levels')->middleware('auth');

Route::get('levels/create', [LevelsController::class, 'create'])->name('levels')->middleware('auth');
Route::get('levels/{id}', [LevelsController::class, 'getLevel'])->name('levels')->middleware('auth');
Route::put('levels/{id}', [LevelsController::class, 'update'])->name('levels')->middleware('auth');
Route::delete('levels/{id}', [LevelsController::class, 'destroy'])->name('levels')->middleware('auth');


Route::post('create_level', [LevelsController::class,'newLevel']);
Route::post('create_subject', [SubjectsController::class,'createSubject']);
Route::get('subjects', [SubjectsController::class, 'index'])->name('subjects')->middleware('auth');
Route::get('topics', [SubjectsController::class, 'topics'])->name('topics')->middleware('auth');
Route::get('subjects/create', [SubjectsController::class, 'create'])->name('levels')->middleware('auth');
Route::get('topics/create', [TopicController::class, 'create'])->name('topics')->middleware('auth');
Route::post('create_topic', [TopicController::class, 'newTopic'])->name('topics')->middleware('auth');
