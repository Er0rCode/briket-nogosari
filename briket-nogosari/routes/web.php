<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Pintu Utama Landing Page Pelanggan
Route::get('/', [FrontendController::class, 'index'])->name('home');

// Jalur Autentikasi Login Admin (Matikan fitur register publik agar aman)
Auth::routes(['register' => false]);

// Kelompok Jalur URL Khusus Dashboard Admin (Wajib Login / Auth)
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    
    // Halaman Awal Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'productCount' => \App\Models\Product::count(),
            'galleryCount' => \App\Models\Gallery::count()
        ]);
    })->name('dashboard');

    // Routing CRUD Otomatis untuk Produk dan Galeri
    Route::resource('products', ProductController::class)->except(['create', 'edit', 'show']);
    Route::resource('gallery', GalleryController::class)->only(['index', 'store', 'destroy']);

    // Routing Pengaturan Konten Website
    Route::get('/profile', [SettingsController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');
    Route::get('/contact', [SettingsController::class, 'editContact'])->name('contact.edit');
    Route::put('/contact', [SettingsController::class, 'updateContact'])->name('contact.update');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
