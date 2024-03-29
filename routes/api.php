<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
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

Route::get('login',[LoginController::class, 'showLoginPage']);

Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@do']);

Route::post('/done', [TaskController::class, 'toggleComplete']);

Route::post('/new', [TaskController::class, 'create']);

Route::post('/delete', [TaskController::class, 'delete']);

Route::post('/edit', [TaskController::class, 'edit']);

Route::get('/', [TaskController::class, 'getAll']);
