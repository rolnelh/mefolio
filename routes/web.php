<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CreatifController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

// Route::get('/dashboard/{slug}', [DashboardController::class, 'show'])->name('dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'dashboard'])->name('dashboard');
    Route::get('/projets/creer', [ProjectController::class, 'create'])->name('projets.create');
    Route::post('/projets', [ProjectController::class, 'store'])->name('projets.store');
    Route::get('/projets/{project}/edit', [ProjectController::class, 'edit'])->name('projets.edit');
    Route::put('/projets/{project}', [ProjectController::class, 'update'])->name('projets.update');
    Route::delete('/projets/{project}', [ProjectController::class, 'destroy'])->name('projets.destroy');

    Route::post('/projects/{project}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/projects/{project}/comments/ajax', [CommentController::class, 'storeAjax'])->name('comments.store.ajax');
});
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');




Route::get('/creatifs', [CreatifController::class, 'index'])->name('creatifs.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/creatifs/create', [CreatifController::class, 'create'])->name('creatifs.create');
    Route::post('/creatifs', [CreatifController::class, 'store'])->name('creatifs.store');
    Route::get('/creatifs/edit', [CreatifController::class, 'edit'])->name('creatifs.edit');
    Route::put('/creatifs/update', [CreatifController::class, 'update'])->name('creatifs.update');
});
Route::get('/creatifs', [CreatifController::class, 'index'])->name('creatifs.index');

Route::get('/creatifs/{slug}', [CreatifController::class, 'show'])->name('creatifs.show');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('blog', [PostController::class, 'index'])->name('blog');


Route::get('/missions', function () {
    return view('missions.index');
})->name('missions.index');




require __DIR__.'/auth.php';
