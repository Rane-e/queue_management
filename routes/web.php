<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SEOController;

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


Route::middleware('auth')->group(function () {
    Route::post('/queue/{subject}/join', [QueueController::class, 'joinQueue'])->name('queue.join');
    Route::post('/queue/{queue}/skip', [QueueController::class, 'skip'])->name('queue.skip');
    Route::post('/queue/{queue}/end', [QueueController::class, 'goToEnd'])->name('queue.end');
    Route::delete('/queue/{queue}/leave', [QueueController::class, 'leaveQueue'])->name('queue.leave');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/subjects/create', [AdminController::class, 'create'])->name('admin.subjects.create');
    Route::post('/subjects', [AdminController::class, 'store'])->name('admin.subjects.store');
    Route::delete('/subjects/{subject}', [AdminController::class, 'destroy'])->name('admin.subjects.destroy');
    Route::get('/queue/edit/{subject}', [AdminController::class, 'editQueue'])->name('admin.queue.edit');
    Route::post('/queue/update', [AdminController::class, 'updateQueue'])->name('admin.queue.update');
});

    Route::get('/', [SEOController::class, 'index'])->name('home');
Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



