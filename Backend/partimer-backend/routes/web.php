<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Models\Company;
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

Route::get('/', function () {
    return view('landingpage', [
        'title' => ' ',
    ]);
})->name('landing_page');

Route::group(['prefix' => 'user' , 'namespace'=>'User'], function (){
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login_post'])->name('login.post');

    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'register_post'])->name('register.post');

    Route::group(['middleware' => ['auth:web']], function(){
        Route::get('/home', function(){
            return view('User.home', [
                'title' => 'Home',
            ]);
        })->name('user_homepage');

        Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');
        Route::get('/profile/{user}/edit',[UserController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}/update',[UserController::class, 'update'])->name('profile.update');
        Route::delete('/profile/{user}/delete',[UserController::class, 'delete'])->name('profile.delete');
    });
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});


Route::group(['prefix' => 'company' , 'namespace' => 'Company'], function(){
    Route::get('/login', [CompanyController::class, 'login'])->name('company_login');
    Route::post('/login', [CompanyController::class, 'login_post'])->name('company_login.post');

    Route::get('/register', [CompanyController::class , 'register'])->name('company_register');
    Route::post('/register', [CompanyController::class, 'register_post'])->name('company_register.post');

    Route::group(['middleware' => ['auth:company']], function() {
        Route::get('/index', function () {
            return view('Company.homepage', [
                'title' => "index"
            ]);
        })->name('company_homepage');
        
        Route::get('/index_job', [CompanyController::class, 'index'])->name('job.index.company');

    });
});

Route::get('/job', [JobController::class, 'index'])->name('job.index');
Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
Route::post('/job', [JobController::class, 'store'])->name('job.store');
Route::get('/job/{job}/edit',[JobController::class, 'edit'])->name('job.edit');
Route::put('/job/{job}/update',[JobController::class, 'update'])->name('job.update');
Route::delete('/job/{job}/delete',[JobController::class, 'delete'])->name('job.delete');