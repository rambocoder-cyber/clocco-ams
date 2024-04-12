<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use App\Http\Middleware\RedirectAuthenticateUsers;
use App\Http\Middleware\RedirectGuest;
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

Route::middleware([RedirectAuthenticateUsers::class])->group(function(){
    Route::get('/',[AuthController::class,'loginPage'])->name('loginPage');
    Route::post('/login',[AuthController::class,'login'])->name('login');
    Route::get('/register',[AuthController::class,'registerPage'])->name('registerPage');
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::middleware([RedirectGuest::class])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
    Route::controller(AjaxController::class)->group(function () {
        Route::get('/specific-user/{id}', 'getUser')->name('getUser');
        Route::get('/show-user/{id}', 'showUser')->name('showUser');
        Route::get('/delete-user/{id}', 'deleteUser')->name('deleteUser');
        Route::get('/destroy/{id}', 'destroy')->name('destroy');
        Route::get('/create-user', 'createUser')->name('createUser');
        Route::post('/update-user', 'updateUser')->name('updateUser');
        Route::post('/store-user', 'storeUser')->name('storeUser');
    });

    Route::controller(ArtistController::class)->group(function(){
        Route::get('artists-list','getAllArtist')->name('getAllArtist');
        Route::get('get-artist/{id}','getArtist')->name('getArtist');
        Route::get('/delete-artist/{id}', 'deleteArtist')->name('deleteArtist');
        Route::get('/destroyArtist/{id}', 'destroyArtist')->name('destroyArtist');
        Route::get('create-artist','createArtist')->name('createArtist');
        Route::post('store-artist','storeArtist')->name('storeArtist');
        Route::post('update-artist','updateArtist')->name('updateArtist');
    });

    Route::controller(SongController::class)->group(function(){
        Route::get('songs/{id}','getSongs')->name('getSongs');
        Route::get('create-song/{id}','createSong')->name('createSong');
        Route::get('edit-song/{id}','editSong')->name('editSong');
        Route::post('/store-song', 'storeSong')->name('storeSong');
        Route::post('update-song','updateSong')->name('updateSong');
        Route::get('/delete-song/{id}', 'deleteSong')->name('deleteSong');
        Route::get('/destroySong/{id}', 'destroySong')->name('destroySong');
    });
});
