<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\HnrdaController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\SdgController;
use App\Http\Controllers\StrategicPillarController;
use App\Http\Controllers\ThematicAreaController;
use App\Http\Controllers\PrimaryIndicatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/indicators', [IndicatorController::class, 'index'])->name('indicators.index');
    Route::post('/indicators', [IndicatorController::class, 'store'])->name('indicators.store');
    Route::put('/indicators/{id}/update', [IndicatorController::class, 'update'])->name('indicators.update');
    Route::delete('/indicators/{id}/delete', [IndicatorController::class, 'destroy'])->name('indicators.destroy');

    Route::get('/indicators/primary', [PrimaryIndicatorController::class, 'index'])->name('primaryIndicators.index');
    Route::post('/indicators/primary/{id}/store', [PrimaryIndicatorController::class, 'store'])->name('primaryIndicators.store');
    Route::put('/indicators/primary/{id}/update', [PrimaryIndicatorController::class, 'update'])->name('primaryIndicators.update');
    Route::delete('/indicators/primary/{id}/delete', [PrimaryIndicatorController::class, 'destroy'])->name('primaryIndicators.destroy');
    Route::post('/indicators/primary/select', [PrimaryIndicatorController::class, 'select'])->name('primaryIndicators.select');

    Route::post('/comment/{id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::put('/comment/{id}/update', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{id}/delete', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/agencies', [AgencyController::class, 'index'])->name('agencies.index');
    Route::post('/agencies', [AgencyController::class, 'store'])->name('agencies.store');
    Route::put('/agencies/{id}/update', [AgencyController::class, 'update'])->name('agencies.update');
    Route::delete('/agencies/{id}/delete', [AgencyController::class, 'destroy'])->name('agencies.destroy');

    Route::get('/hnrdas', [HnrdaController::class, 'index'])->name('hnrdas.index');
    Route::post('/hnrdas', [HnrdaController::class, 'store'])->name('hnrdas.store');
    Route::put('/hnrdas/{id}/update', [HnrdaController::class, 'update'])->name('hnrdas.update');
    Route::delete('/hnrdas/{id}/delete', [HnrdaController::class, 'destroy'])->name('hnrdas.destroy');

    Route::get('/priorities', [PriorityController::class, 'index'])->name('priorities.index');
    Route::post('/priorities', [PriorityController::class, 'store'])->name('priorities.store');
    Route::put('/priorities/{id}/update', [PriorityController::class, 'update'])->name('priorities.update');
    Route::delete('/priorities/{id}/delete', [PriorityController::class, 'destroy'])->name('priorities.destroy');

    Route::get('/sdgs', [SdgController::class, 'index'])->name('sdgs.index');
    Route::post('/sdgs', [SdgController::class, 'store'])->name('sdgs.store');
    Route::put('/sdgs/{id}/update', [SdgController::class, 'update'])->name('sdgs.update');
    Route::delete('/sdgs/{id}/delete', [SdgController::class, 'destroy'])->name('sdgs.destroy');

    Route::get('/pillars', [StrategicPillarController::class, 'index'])->name('pillars.index');
    Route::post('/pillars', [StrategicPillarController::class, 'store'])->name('pillars.store');
    Route::put('/pillars/{id}/update', [StrategicPillarController::class, 'update'])->name('pillars.update');
    Route::delete('/pillars/{id}/delete', [StrategicPillarController::class, 'destroy'])->name('pillars.destroy');

    Route::get('/areas', [ThematicAreaController::class, 'index'])->name('areas.index');
    Route::post('/areas', [ThematicAreaController::class, 'store'])->name('areas.store');
    Route::put('/areas/{id}/update', [ThematicAreaController::class, 'update'])->name('areas.update');
    Route::delete('/areas/{id}/delete', [ThematicAreaController::class, 'destroy'])->name('areas.destroy');
});

require __DIR__.'/auth.php';
