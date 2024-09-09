<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HnrdaController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ThematicAreaController;
use App\Http\Controllers\StrategicPillarController;
use App\Http\Controllers\SdgController;
use App\Http\Controllers\AgencyController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HNRDA CRUD operations
    Route::get('/hnrda',[HnrdaController::class, 'index'])->name('hnrda.index');
    Route::post('/hnrda', [HnrdaController::class, 'store'])->name('hnrda.store');
    Route::put('/hnrda/{hnrda}', [HnrdaController::class, 'update'])->name('hnrda.update');
    Route::delete('/hnrda/{hnrda}', [HnrdaController::class, 'destroy'])->name('hnrda.destroy');

    // Priority CRUD operations
    Route::get('/priority',[PriorityController::class, 'index'])->name('priority.index');
    Route::post('/priority', [PriorityController::class, 'store'])->name('priority.store');
    Route::put('/priority/{priority}', [PriorityController::class, 'update'])->name('priority.update');
    Route::delete('/priority/{priority}', [PriorityController::class, 'destroy'])->name('priority.destroy');

    // DOST Thematic Area CRUD operations
    Route::get('/thematic-area', [ThematicAreaController::class, 'index'])->name('thematic-area.index');
    Route::post('/thematic-area', [ThematicAreaController::class, 'store'])->name('thematic-area.store');
    Route::put('/thematic-area/{thematicArea}', [ThematicAreaController::class, 'update'])->name('thematic-area.update');
    Route::delete('/thematic-area/{thematicArea}', [ThematicAreaController::class, 'destroy'])->name('thematic-area.destroy');

    // DOST Strategic Pillar CRUD operations
    Route::get('/strategic-pillar', [StrategicPillarController::class, 'index'])->name('strategic-pillar.index');
    Route::post('/strategic-pillar', [StrategicPillarController::class, 'store'])->name('strategic-pillar.store');
    Route::put('/strategic-pillar/{strategicPillar}', [StrategicPillarController::class, 'update'])->name('strategic-pillar.update');
    Route::delete('/strategic-pillar/{strategicPillar}', [StrategicPillarController::class, 'destroy'])->name('strategic-pillar.destroy');

    // DOST SDG CRUD operations
    Route::get('/sdg', [SdgController::class, 'index'])->name('sdg.index');
    Route::post('/sdg', [SdgController::class, 'store'])->name('sdg.store');
    Route::put('/sdg/{sdg}', [SdgController::class, 'update'])->name('sdg.update');
    Route::delete('/sdg/{sdg}', [SdgController::class, 'destroy'])->name('sdg.destroy');

    // DOST Agencies CRUD operations
    Route::get('/agency', [AgencyController::class, 'index'])->name('agency.index');
    Route::post('/agency', [AgencyController::class, 'store'])->name('agency.store');
    Route::put('/agency/{agency}', [AgencyController::class, 'update'])->name('agency.update');
    Route::delete('/agency/{agency}', [AgencyController::class, 'destroy'])->name('agency.destroy');

    Route::get('/users',[UserController::class, 'index'])->name('user.index');
    // to register
    Route::post('/users', [UserController::class, 'store'])->name('user.register');
    Route::get('/user/{user}/edit', [HnrdaController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{user}/destroy', [HnrdaController::class, 'destroy'])->name('user.destroy');

});

require __DIR__.'/auth.php';
