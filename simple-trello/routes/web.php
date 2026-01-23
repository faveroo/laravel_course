<?php

use App\Http\Controllers\InviteController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'home'])->name('home');

    Route::get('/projects', [ProjectController::class, 'list'])->name('projects');
    Route::get('/project/{id}', [ProjectController::class, 'index'])->name('project.show');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
    Route::post('/project/invite', [InviteController::class, 'invite'])->name('project.invite');

    Route::get('/invitation/{token}', [InviteController::class, 'accept'])->name('invitation.accept');

    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('update.status')
        ->middleware('permission:tasks.move');

    Route::get('/user/my-invites', [UserController::class, 'index'])->name('user.myinvites');
});
