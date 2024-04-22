<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VolunteeringController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\WorkshpsController;
use App\Http\Controllers\OthersController;

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
 //Route::resource("home","App\Http\Controllers\HomeController");
Route::resource("clinic","App\Http\Controllers\ClinicController");
Route::resource("offers","App\Http\Controllers\OffersController");
Route::resource("courses","App\Http\Controllers\CourseController");
Route::resource("workshops","App\Http\Controllers\WorkshopsController");
Route::resource("other","App\Http\Controllers\OthersController");
Route::resource("conferences","App\Http\Controllers\ConferencesController");
Route::resource("clubs", "App\Http\Controllers\StudentClubsController");
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource("opportunities","App\Http\Controllers\VolunteeringController");
Route::resource("main","App\Http\Controllers\LoginController");

Route::get('/', function () {
<<<<<<< HEAD
    return redirect()->route('clinic.index');
=======
    return redirect()->route('main.index');
>>>>>>> 8b27d9efbab0608e19750cd053af6937cf3e8f27
});

//for post a form 
Route::post('/login', [LoginController::class,'login']);
