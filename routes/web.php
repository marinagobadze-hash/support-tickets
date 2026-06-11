<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;

// თუ მომხმარებელი პირდაპირ საიტის მთავარ გვერდზე შევა, გადავიყვანოთ ლოგინზე
Route::get('/', function () {
    return redirect('/login');
});

// ავტორიზაციის გზები
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ადმინისტრატორის დეშბორდი და ბილეთის სტატუსის შეცვლის გზა
Route::get('/admin/dashboard', function () {
    return view('admin_dashboard');
})->middleware('auth');

Route::post('/admin/tickets/{id}/resolve', [TicketController::class, 'resolve'])->middleware('auth');

// კლიენტის დეშბორდი
Route::get('/client/dashboard', function () {
    return view('client_dashboard');
})->middleware('auth');

// 🎫 აი ეს არის ის გზა, რომელიც აკლდა შენს კოდს ბილეთის შესაქმნელად!
Route::post('/tickets', [TicketController::class, 'store'])->middleware('auth');