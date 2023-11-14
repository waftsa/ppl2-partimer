<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PDFController;
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

Route::group(['prefix' => 'user', 'namespace'=>'User' ], function (){
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login_post'])->name('login.post');

    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'register_post'])->name('register.post');

    Route::group(['middleware' => 'auth:web'], function(){
        Route::get('/home', function(){
            return view('User.home', [
                'title' => 'Home',
            ]);
        })->name('user_homepage');

        Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');
        Route::get('/profile/{user}/edit',[UserController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/{user}/update',[UserController::class, 'update'])->name('profile.update');
        Route::delete('/profile/{user}/delete',[UserController::class, 'delete'])->name('profile.delete');

        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    });
});
