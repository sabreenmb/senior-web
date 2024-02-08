<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VolunteeringController;

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
Route::resource("opportunities","App\Http\Controllers\VolunteeringController");
Route::resource("main","App\Http\Controllers\LoginController");


// Route::resource("main","App\Http\Controllers\LoginController");

// Route::get('/', [LoginController::class,'index'])->name('main');
Route::post('/login', [LoginController::class,'login']);
Route::post('/opportunities-list', [LoginController::class,'successlogin']);

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
Route::get('/opportunities-list', function () {
    return redirect()->route('opportunities.index');
});
Route::get('/', function () {
    return redirect()->route('main.index');
});
