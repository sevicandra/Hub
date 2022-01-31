<?php
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\agendaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/register', [registerController::class, 'store']);

Route::post('/login', [loginController::class, 'login']);
Route::post('/logout', [loginController::class, 'logout']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/Home', [loginController::class, 'home'])->middleware('auth');


Route::get('/register', function() {
    return view('register');
});

Route::post('/asd', [agendaController::class, 'agenda']);


Route::get('/test', function() {
    return view('test');
});


Route::post('/test', function(Request $request) {
    //
    var_dump($request->date);
});
