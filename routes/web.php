<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/welcome', [HomeController::class, 'welcome']);

Route::get('/searchJobs', [JobController::class, 'search_job_page']);



Route::get('/loginPage', [UserController::class, 'login_page']);
Route::post('/login', [UserController::class, 'user_login']);
Route::get('/registerPage', [UserController::class, 'register_page']);
Route::post('/makeAccount', [UserController::class, 'make_account']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/searchUsers', [UserController::class, 'search_user_page']);

Route::get('/toWorker', [UserController::class, 'switch_role_to_worker']);
Route::get('/toEmployer', [UserController::class, 'switch_role_to_employer']);
