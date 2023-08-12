<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/', [FileController::class, 'index'])
		->name('files.index')
		->middleware(['auth:sanctum', 'verified']);

// FILES
	// Route::resource('files', FileController::class);
	
	Route::get('/files', [FileController::class, 'index'])
		->name('files.index')
		->middleware(['auth:sanctum', 'verified']);

	Route::get('/files/create', [FileController::class, 'create'])
		->name('files.create')
		->middleware(['auth:sanctum', 'verified']);

	Route::post('files', [FileController::class, 'store'])
		->name('files.store')
		->middleware(['auth:sanctum', 'verified']);

	// Route::get('/files/{id}', [FileController::class, 'show'])
	// 	->name('files.show')
	// 	->middleware(['auth:sanctum', 'verified']);

	Route::get('/files/{file}/edit', [FileController::class, 'edit'])
		->name('files.edit')
		->middleware(['auth:sanctum', 'verified']);

	Route::put('/files/{file}', [FileController::class, 'update'])
		->name('files.update')
		->middleware(['auth:sanctum', 'verified']);

	Route::delete('/files/{file}', [FileController::class, 'delete'])
		->name('files.destroy')
		->middleware(['auth:sanctum', 'verified']);

// TAGS
	// Route::get('/tags', [TagController::class, 'index'])->name('tags.index');

	// Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
	
	// Route::post('tags', [TagController::class, 'store'])->name('tags.store');

	// Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');

	// Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');

	// Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');

	Route::resource('tags', TagController::class)->middleware(['auth:sanctum', 'verified']);

// VIDEO
	Route::get('/videos', [VideoController::class, 'index'])
		->name('videos.index')
		->middleware(['auth:sanctum', 'verified']);

	Route::get('/videos/create', [VideoController::class, 'create'])
		->name('videos.create')
		->middleware(['auth:sanctum', 'verified']);

	Route::post('videos', [VideoController::class, 'store'])
		->name('videos.store')
		->middleware(['auth:sanctum', 'verified']);

	Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])
		->name('videos.edit')
		->middleware(['auth:sanctum', 'verified']);

	Route::put('/videos/{video}', [VideoController::class, 'update'])
		->name('videos.update')
		->middleware(['auth:sanctum', 'verified']);

	Route::delete('/videos/{video}', [VideoController::class, 'destroy'])
		->name('videos.destroy')
		->middleware(['auth:sanctum', 'verified']);

// Tour Virtul 360
	Route::get('/tour', [TourController::class, 'index'])
		->name('tour.index')
		->middleware(['auth:sanctum', 'verified']);

	Route::get('/tour/create', [TourController::class, 'create'])
		->name('tour.create')
		->middleware(['auth:sanctum', 'verified']);

	Route::post('tour', [TourController::class, 'store'])
		->name('tour.store')
		->middleware(['auth:sanctum', 'verified']);

	Route::get('/tour/{tour}/edit', [TourController::class, 'edit'])
		->name('tour.edit')
		->middleware(['auth:sanctum', 'verified']);

	Route::put('/tour/{tour}', [TourController::class, 'update'])
		->name('tour.update')
		->middleware(['auth:sanctum', 'verified']);

	Route::delete('/tour/{tour}', [TourController::class, 'destroy'])
		->name('tour.destroy')
		->middleware(['auth:sanctum', 'verified']);
	

// Auth
	Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	    return view('dashboard');
	})->name('dashboard');
// API
	Route::get('/api', [ApiController::class, 'index'])->name('matt360view.index');