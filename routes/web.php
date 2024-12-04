<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



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
    Route::get('/edit-job/{id}', [AccountController::class, 'editJob'])->name('edit.job');
    Route::put('/update-job/{id}', [AccountController::class, 'updateJob'])->name('update.job');
    Route::get('/delete-job/{id}', [AccountController::class, 'destroyJob'])->name('delete.job');

    Route::get('/applied-job', [JobController::class, 'myAppliedJob'])->name('applied.job');
    Route::delete('/applied-delete-job/{id}', [JobController::class, 'myAppliedDestroyJob'])
        ->name('applied.delete.job');

    Route::post('/ApplyJob', [JobController::class, 'ApplyJob'])->name('job.apply');

    Route::post('/SaveJob', [JobController::class, 'SaveJob'])->name('job.save');
    Route::get('/saved-job', [JobController::class, 'mySavedJob'])->name('saved.job');
    Route::delete('/saved-delete-job/{id}', [JobController::class, 'mySavedDestroyJob'])
        ->name('saved.delete.job');
});
Route::get('/job-detail/{id}', [AccountController::class, 'showJob'])->name('job.detail');


Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/filter', [JobController::class, 'filterJobs'])->name('jobs.filter');

Route::get('/', [HomeController::class, 'index'])->name('front.index');
require __DIR__ . '/auth.php';
