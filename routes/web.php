<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\CratecarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/' ,[Controller::class , 'index'])->name('admin.index');




Route::resource('carcreate', CratecarController::class);
Route::get('/car/{id}', [CratecarController::class, 'showCar'])->name('carcreate.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
