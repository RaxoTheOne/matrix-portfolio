<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitHubController;

Route::get('/', function () {
    return view('home');
});

Route::get('/github/stats', [GitHubController::class, 'stats']);

Route::get('/github/repos', [GitHubController::class, 'repos']);
