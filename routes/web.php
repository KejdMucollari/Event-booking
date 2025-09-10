<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\PayPalController;

require __DIR__ . '/auth.php';

Route::resource('events', EventController::class);


Route::get('/', [EventController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// login routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [ProfileController::class, 'storeLogin']);

// register routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [ProfileController::class, 'storeRegister']);




// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

//admin only route for managing users 
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.role');
});


//organisers route to acces dashboard 
Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/organizer/dashboard', [OrganizerController::class, 'dashboard'])
        ->name('organizer.dashboard');
});

//booking route to acces 
Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

//payment routes 

Route::middleware('auth')->group(function(){
    Route::post('/paypal/pay', [PayPalController::class,'pay'])->name('paypal.pay');
    Route::get('/paypal/success',[PayPalController::class,'success'])->name('paypal.success');
    Route::get('/paypal/cancel',[PayPalController::class,'cancel'])->name('paypal.cancel');
});
