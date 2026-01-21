<?php

use App\Http\Controllers\IndependentController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [IndependentController::class, 'home'])->name('home');
Route::get('/about-us', [IndependentController::class, 'about'])->name('about');

Route::get('/jobs', [MyJobController::class, 'index'])->name('jobs');
Route::post('/jobs', [MyJobController::class, 'store'])->name('job.store');
Route::get('/job/{job}', [MyJobController::class, 'show'])->name('job.show');

Route::get('/job/post-a-job', [MyJobController::class, 'create'])->name('job.create');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
