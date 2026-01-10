<?php

use App\Http\Controllers\MyJobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Jobs', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('jobs');

Route::post('/', function(Request $request){
    dd($request->all());
});

Route::get('/job/post-a-job', [MyJobController::class, 'create'])->name('job.create');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
