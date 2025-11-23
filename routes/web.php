<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananPublikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\EventPublikController;
use App\Http\Controllers\UlasanPublikController;
use App\Http\Controllers\Admin\AdminController;

// Halaman Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/layanan', [LayananPublikController::class, 'index'])->name('layanan.publik.index');

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index'); 

Route::get('/event', [EventPublikController::class, 'index'])->name('event.index');

Route::get('/review', [UlasanPublikController::class, 'index'])->name('review.index');

require __DIR__.'/auth.php';
Route::middleware(['auth'])->group(function () {
    Route::get('/booking/check-slots', [BookingController::class, 'checkSlots'])->name('booking.checkSlots');

    Route::get('/dashboard-user', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::post('/review/store', [ProfileController::class, 'storeReview'])->name('review.store');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index'); // Tampilkan form
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store'); // Proses submit
    Route::get('/booking/check-slots', [BookingController::class, 'checkSlots'])->name('booking.checkSlots');
    Route::get('/payment/{id}', [BookingController::class, 'showPayment'])->name('payment.show');
    Route::post('/payment/upload-bukti', [BookingController::class, 'uploadBukti'])->name('payment.uploadBukti');
    Route::get('/profile/{tab?}', [ProfileController::class, 'index'])
         ->where('tab', 'profile|riwayat|ulasan') // Memastikan tab valid
         ->name('profile.index'); 
});

Route::middleware(['auth', 'is.admin'])->prefix('admin')->group(function () {
    
    // Halaman 1: GRAFIK & KPI (Dashboard Utama)
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard'); 
    
    // Halaman 2: MANAJEMEN BOOKING
    Route::get('/booking', [AdminController::class, 'manageBooking'])->name('admin.booking.index');
    
    // Halaman 3: MANAJEMEN PEMBAYARAN
    Route::get('/pembayaran', [AdminController::class, 'managePembayaran'])->name('admin.pembayaran.index');
    
    // Halaman 4: MANAJEMEN KATALOG (Produk)
    Route::get('/katalog', [AdminController::class, 'manageKatalog'])->name('admin.katalog.index');
    
    // Halaman 5: MANAJEMEN EVENT (View Index Event)
    Route::get('/event', [AdminController::class, 'manageEvent'])->name('admin.event.index');
    
    // Halaman 6: MANAJEMEN ULASAN
    Route::get('/ulasan', [AdminController::class, 'manageUlasan'])->name('admin.ulasan.index');
    
});