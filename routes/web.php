<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;

Route::get('/', function () {
    return view('home');
});

Route::get('/github/stats', [GitHubController::class, 'stats']);

Route::get('/github/repos', [GitHubController::class, 'repos']);

Route::get('/github/pinned', [GitHubController::class, 'pinned']);

// Admin (Basic Auth)
Route::middleware('basic.auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.projects.index'));

    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show']);
});
