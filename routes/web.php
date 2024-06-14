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
Route::get('/about', [HomeController::class, 'about_page']);

Route::get('/searchJobs', [JobController::class, 'search_job_page']);


Route::get('/loginPage', [UserController::class, 'login_page']);
Route::post('/login', [UserController::class, 'user_login']);
Route::get('/registerPage', [UserController::class, 'register_page']);
Route::post('/makeAccount', [UserController::class, 'make_account']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/searchUsers', [UserController::class, 'search_user_page']);

Route::get('/toWorker', [UserController::class, 'switch_role_to_worker']);
Route::get('/toEmployer', [UserController::class, 'switch_role_to_employer']);

Route::get('/employerRegister', [UserController::class, 'employer_register_page']);
Route::post('/signEmployer', [UserController::class, 'employer_register']);


Route::get('/applicantsPage', [UserController::class, 'employer_applicants_page']);
Route::get('/acceptApplicant/{id}', [UserController::class, 'accept_employer_applicant']);
Route::get('/declineApplicant/{id}', [UserController::class, 'decline_employer_applicant']);

Route::get('/userProfile', [UserController::class, 'user_profile']);
Route::post('/changePicture', [UserController::class, 'change_profile_picture']);
Route::post('/changeUserInfo', [UserController::class, 'change_user_info']);
Route::post('/changeWorkerInfo', [UserController::class, 'change_worker_info']);
Route::post('/changeEmployerInfo', [UserController::class, 'change_employer_info']);
Route::get('/profile/view/{id}', [UserController::class, 'view_user_profile']);

Route::get('/manageJobs', [JobController::class, 'manage_jobs_page']);
Route::post('/makeJob', [JobController::class, 'make_job']);
Route::get('/viewJob/{id}', [JobController::class, 'view_job']);
Route::get('/jobInfo/{id}', [JobController::class, 'job_info']);
Route::post('/applyJob', [JobController::class, 'apply_job']);
Route::post('/acceptWorker', [JobController::class, 'accept_worker']);
Route::post('/declineWorker', [JobController::class, 'decline_worker']);
Route::get('/cancelJob/{id}', [JobController::class, 'cancel_job']);
Route::post('/endJob', [JobController::class, 'end_job']);
