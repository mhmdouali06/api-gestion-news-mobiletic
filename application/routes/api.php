<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategorieController;

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


/**
 * les routes pour authentification
*/
Route::post("login",[AuthController::class,"login"]);
Route::get("me",[AuthController::class,"me"]);


/**
 * les routes pour les categories
 */
Route::post('categories',[CategorieController::class,'store']);
Route::get('categories',[CategorieController::class,'index']);
Route::get('categories/{name}',[CategorieController::class,'show']);


/**
 * les routes pour les news
*/
Route::middleware("auth:api")->group(function(){
    Route::apiResource('news',NewsController::class);
//les news dans l'ordre décroissant de leur date de publication
Route::get('dernieres-news',[NewsController::class,'dernieres_news']);
});


