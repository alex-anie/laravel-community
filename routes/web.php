<?php

use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MyJobController::class, 'index'])->name('jobs');

Route::get('/job/post-a-job', [MyJobController::class, 'create'])->name('job.create');
Route::get('/job/{job}/', [MyJobController::class, 'show'])->name('job.show');
Route::post('/', [MyJobController::class, 'store'])->name('job.store');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
