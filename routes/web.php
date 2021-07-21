<?php

use App\Http\Controllers\CastController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/', [PagesController::class, 'home'])->name('pages.home');
Route::get('/search', [PagesController::class, 'searchMovies'])->name('pages.searchMovies');
Route::get('/{movie}', [PagesController::class, 'detailMovie'])->name('pages.detailMovie');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
    // Dashboard
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
    // Ratings
    Route::resource('/ratings', RatingController::class)->except(['show']);
    // Genres
    Route::get('/genres/getGenres', [GenreController::class, 'getGenres'])->name('genres.select');
    Route::resource('/genres', GenreController::class)->except(['show']);
    // Directors
    Route::get('/directots/getDirectors', [DirectorController::class, 'getDirectors'])
        ->name('directors.select');
    Route::resource('/directors', DirectorController::class)->except(['show']);
    // Casts
    Route::get('/casts/select', [CastController::class, 'selectInput'])->name('casts.select');
    Route::resource('/casts', CastController::class);
    // Movies
    Route::resource('/movies', MovieController::class);
    // Roles
    Route::get('/roles/getRoles', [RoleController::class, 'getRoles'])->name('roles.select');
    Route::resource('/roles', RoleController::class);
    // Users
    Route::resource('/users', UserController::class)->except(['show']);

    // lfm
    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/index', [FileManagerController::class, 'index'])->name('fileManager.index');
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});