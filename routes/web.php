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
 Route::group(['middleware' => 'auth'], function () {
    // Protected routes here
    Route::resource("clinic","App\Http\Controllers\ClinicController");
    Route::resource("offers","App\Http\Controllers\OffersController");
    Route::resource("courses","App\Http\Controllers\CourseController");
    Route::resource("workshops","App\Http\Controllers\WorkshopsController");
    Route::resource("other","App\Http\Controllers\OthersController");
    Route::resource("conferences","App\Http\Controllers\ConferencesController");
    Route::resource("opportunities","App\Http\Controllers\VolunteeringController");
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::resource("main","App\Http\Controllers\LoginController");
Route::get('/', function () {
    return redirect()->route('main.index');
});
//for post a form 
Route::post('/login', [LoginController::class,'login']);

});
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::resource("clinic","App\Http\Controllers\ClinicController");
// Route::resource("offers","App\Http\Controllers\OffersController");
// Route::resource("courses","App\Http\Controllers\CourseController");
// Route::resource("workshops","App\Http\Controllers\WorkshopsController");
// Route::resource("other","App\Http\Controllers\OthersController");
// Route::resource("conferences","App\Http\Controllers\ConferencesController");

// Route::resource("opportunities","App\Http\Controllers\VolunteeringController");

// Route::get('/home', function () {
//     return redirect()->route('home.index');
// });
// Route::resource("main","App\Http\Controllers\LoginController");

// Route::get('/', [LoginController::class,'index'])->name('main');
// Route::get('/volunteering', [HomeController::class,'volunteering']);
// Route::get('/offers', [HomeController::class,'offers']);
// Route::get('/clinic', [HomeController::class,'clinic']);
// Route::get('/events', [HomeController::class,'events']);

// Route::get('/successlogin', [LoginController::class,'successlogin']);
// Route::get('/home', function (){return view('home');});
// Route::get('/opportunities', [VolunteeringController::class,'create']);
// Route::get('/opportunities-list', [VolunteeringController::class,'index']);

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/', 'LoginController@index');

// Route::post('/login', 'LoginController@checkLogin');
// // Route::post('/login', function () {
// //     return redirect()->route('main.checkLogin');
// // });
// Route::get('/successlogin', 'LoginController@successlogin');

// Route::get('/', function () {
//     return redirect()->route('main.successlogin');
// });
// Route::get('/opportunities-list', function () {
//     return redirect()->route('opportunities.index');
// });

