<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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

/*
To implement authentication:
- Run composer require laravel/ui to download bootstrap libraries
- php artisan ui bootstrap --auth to integrate authentication to this app
- npm install to install the required libraries
- npm run dev to start the application
- Navigate to localhost/app_name/public to start using authentication
*/

// Root redirects to login. If the user is already logged in, redirects to home
Route::get('/', function () {
    return redirect('login');
});

// Return the Empleado view depending on the requested endpoint
// middleware('auth') forces to log in before returning the views
Route::resource('empleado', EmpleadoController::class)->middleware('auth');

// Remove "Register" and "Forgot your password?" options
//Auth::routes(['register'=>false, 'reset'=>false]);

Auth::routes();

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

// Applying these settings, login redirects to home
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
});