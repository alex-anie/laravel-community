<?php

use App\Http\Controllers\IndependentController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MyJobController::class, 'index'])->name('jobs');
Route::get('/about-us', [IndependentController::class, 'about'])->name('abput');

Route::get('/job/post-a-job', [MyJobController::class, 'create'])->name('job.create');
Route::post('/', [MyJobController::class, 'store'])->name('job.store');

Route::get('/job/{job}/', [MyJobController::class, 'show'])->name('job.show');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
