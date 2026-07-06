<?php

use App\Http\Controllers\MotorcycleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Serve storage files when symlink doesn't work (e.g. shared hosting / cPanel)
Route::match(['get', 'head'], 'storage/{path}', function () {
    $requestPath = ltrim(request()->path(), '/');
    if (!str_starts_with($requestPath, 'storage/')) {
        abort(404);
    }
    $path = substr($requestPath, 8); // strip 'storage/'
    if (empty($path) || str_contains($path, '..')) {
        abort(404);
    }

    $fullPath = storage_path('app/public/' . $path);
    $realPath = realpath($fullPath);
    $storageRoot = realpath(storage_path('app/public'));

    if (!$realPath || !is_file($realPath)) {
        abort(404);
    }
    if ($storageRoot && !Str::startsWith($realPath, $storageRoot)) {
        abort(404);
    }

    return response()->file($realPath);
})->where('path', '.*')->name('storage.serve');

Route::get('/', fn () => view('home'))->name('home');
Route::get('/about-us', fn () => view('about'))->name('about');
Route::get('/motorcycles', [MotorcycleController::class, 'index'])->name('motorcycles');
Route::get('/motorcycles/{slug}', [MotorcycleController::class, 'show'])->name('motorcycle.show');
Route::get('/ownership-plans', fn () => view('ownership-plans'))->name('ownership-plans');
Route::get('/parts', fn () => view('parts'))->name('parts');
Route::get('/service-center', fn () => view('service-center'))->name('service-center');
Route::get('/contact-us', fn () => view('contact'))->name('contact');
Route::get('/gallery', fn () => view('gallery'))->name('gallery');
