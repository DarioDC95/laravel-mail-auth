<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// MODIFICHIAMO LA ROTTA DELLA VIEW "DASHBOARD" PERCHE' ABBIAMO UN CONTROLLER CHE C'E' LA RESTITUISCE
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// COSI FACENDO HO APPLICATO IL MIDDLEWARE ONLY TO THE PBLUC FUNCTION "INDEX" DEL "DASHBOARDCONTROLLER"
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// QUESTO E' IL METODO DI GRUPPO
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function() {
    // DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // PROJECT CONTROLLER
    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
    // PROVA DI LANCIO DI UN COMANDO DI SEEDER DALLA VIEW DI PROJECT
    Route::get('/fillProject', function(){
        Artisan::call('db:seed', ['--class' => 'ProjectSeeder']);
        return redirect()->route('admin.projects.index')->with('message', 'I Progetti sono stati creati correttamente');
    })->name('seederProject');
    // TYPE CONTROLLER
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
    // PROVA DI LANCIO DI UN COMANDO DI SEEDER DALLA VIEW di TYPE
    Route::get('/fillType', function(){
        Artisan::call('db:seed', ['--class' => 'TypeSeeder']);
        return redirect()->route('admin.types.index')->with('message', 'Le Tipologie sono state create correttamente');
    })->name('seederType');
    Route::resource('technologies', TechnologyController::class)->parameters(['technologies' => 'technology:slug']);
    // PROVA DI LANCIO DI UN COMANDO DI SEEDER DALLA VIEW di TECHNOLOGY
    Route::get('/fillTechnology', function(){
        Artisan::call('db:seed', ['--class' => 'TechnologySeeder']);
        return redirect()->route('admin.technologies.index')->with('message', 'Le Tecnologie sono state create correttamente');
    })->name('seederTechnology');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';