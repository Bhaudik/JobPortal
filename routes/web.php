<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/account/profile', [ProfileController::class, 'profile'])->name('account.profile');
    Route::post('/update/profile/pic', [ProfileController::class, 'updateProfilePic'])->name('update.profilepic');
    Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('account.updateProfile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create-job', [AccountController::class, 'createJob'])->name('create.job');
    Route::get('/show-job', [AccountController::class, 'showMyJob'])->name('show.job');
    Route::post('/store-job', [AccountController::class, 'storeJob'])->name('store.job');
    Route::get('/job-detail/{id}', [AccountController::class, 'showJob'])->name('job.detail');


    Route::get('/edit-job/{id}', [AccountController::class, 'editJob'])->name('edit.job');
    Route::put('/update-job/{id}', [AccountController::class, 'updateJob'])->name('update.job');
    Route::get('/delete-job/{id}', [AccountController::class, 'destroyJob'])->name('delete.job');
});

Route::get('/Home', [HomeController::class, 'index'])->name('front.index');
require __DIR__ . '/auth.php';
