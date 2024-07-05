<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CollegeController;
use App\Http\Controllers\API\StudentsController;
use App\Http\Controllers\API\GroupsController;
use App\Http\Controllers\API\LessonsController;

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

// Работа со студентами
Route::prefix('Students')->name('Students')->group(function() {
    Route::get('/list', [StudentsController::class, 'list'])
        ->name('list');
    Route::get('/about', [StudentsController::class, 'about'])
        ->name('about');
    Route::post('/create', [StudentsController::class, 'create'])
        ->name('create');
    Route::post('/update', [StudentsController::class, 'update'])
        ->name('update');
    Route::delete('/delete', [StudentsController::class, 'delete'])
        ->name('delete');
});

// Работа с классами
Route::prefix('Groups')->name('Groups')->group(function() {
    Route::get('/list', [GroupsController::class, 'list'])
        ->name('list');
    Route::get('/about', [GroupsController::class, 'about'])
        ->name('about');
    Route::get('/getPlan', [GroupsController::class, 'getPlan'])
        ->name('getPlan');
    Route::post('/createPlan', [GroupsController::class, 'createPlan'])
        ->name('createPlan');
    Route::post('/changePlan', [GroupsController::class, 'changePlan'])
        ->name('changePlan');
    Route::post('/create', [GroupsController::class, 'create'])
        ->name('create');
    Route::post('/update', [GroupsController::class, 'update'])
        ->name('update');
    Route::delete('/delete', [GroupsController::class, 'delete'])
        ->name('delete');
});

// Работа с лекциями
Route::prefix('Lessons')->name('Lessons')->group(function() {
    Route::get('/list', [LessonsController::class, 'list'])
        ->name('list');
    Route::get('/about', [LessonsController::class, 'about'])
        ->name('about');
    Route::post('/create', [LessonsController::class, 'create'])
        ->name('create');
    Route::post('/update', [LessonsController::class, 'update'])
        ->name('update');
    Route::delete('/delete', [LessonsController::class, 'delete'])
        ->name('delete');
});

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/