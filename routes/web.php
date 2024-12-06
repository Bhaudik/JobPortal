<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\applicationController;
use App\Http\Controllers\admin\DashbordControllers;
use App\Http\Controllers\admin\jobController as AdminJobController;
use App\Http\Controllers\admin\userController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckAdmin;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashbordControllers::class, 'index'])->name('admin.index');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index'); // List all users
        Route::get('/{id}', [UserController::class, 'show'])->name('show'); // View user details
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{id}', [UserController::class, 'update'])->name('update'); // Update user
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('destroy'); // Delete user
    });
    Route::prefix('job')->name('admin.jobs.')->group(function () {
        Route::get('/', [AdminJobController::class, 'index'])->name('index'); // List all users
        Route::get('/{id}', [AdminJobController::class, 'show'])->name('show'); // View user details
        Route::get('/{id}/edit', [AdminJobController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{id}', [AdminJobController::class, 'update'])->name('update'); // Update user
        Route::get('delete/{id}', [AdminJobController::class, 'destroy'])->name('destroy'); // Delete user
    });
    Route::prefix('application')->name('admin.application.')->group(function () {
        Route::get('/', [applicationController::class, 'index'])->name('index'); // List all users
        Route::delete('delete/{id}', [applicationController::class, 'destroy'])->name('destroy'); // Delete user
    });
});

Route::group(['prefix' => 'account'], function () {



    Route::middleware('auth')->group(function () {

        Route::get('/profile', [ProfileController::class, 'profile'])->name('account.profile');
        Route::post('/update/profile/pic', [ProfileController::class, 'updateProfilePic'])->name('update.profilepic');
        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/profile/edite', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

        Route::post('/update-password', [AccountController::class, 'updatepassword'])
            ->name('update.password');
    });
});
Route::get('/job-detail/{id}', [AccountController::class, 'showJob'])->name('job.detail');


Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/filter', [JobController::class, 'filterJobs'])->name('jobs.filter');

Route::get('/', [HomeController::class, 'index'])->name('front.index');
require __DIR__ . '/auth.php';
