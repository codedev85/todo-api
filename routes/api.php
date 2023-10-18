<?php

use App\Http\Controllers\Api\Auth\Auth;
use App\Http\Controllers\Api\Todo;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'] , function(){

    Route::group(['prefix' => 'authenticate'] , function(){

         Route::post('user',[Auth::class,'authenticateUser']);

    });

    Route::group(['middleware' => ['auth:sanctum']] , function(){

    Route::group(['prefix' => 'todos'] , function(){

        Route::get('my-todos', [Todo::class ,'allTodos']);

        Route::post('create', [Todo::class ,'addTodos']);

        Route::get('mark-as-complete/{todo_id}', [Todo::class ,'markAsComplete']);

        Route::delete('delete/{todo_id}', [Todo::class ,'deleteTodo']);

      });
    });
});
