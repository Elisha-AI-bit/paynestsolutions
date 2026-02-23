<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [LoanController::class, 'index'])->name('dashboard');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans/calculate', [LoanController::class, 'calculate'])->name('loans.calculate');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/loans/{loan}/approve', [AdminDashboardController::class, 'approveLoan'])->name('loans.approve');
    Route::post('/loans/{loan}/reject', [AdminDashboardController::class, 'rejectLoan'])->name('loans.reject');

    // Users
    Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('users.update');

    // Products
    Route::get('/products', [\App\Http\Controllers\Admin\AdminProductController::class, 'index'])->name('products.index');
    Route::post('/products', [\App\Http\Controllers\Admin\AdminProductController::class, 'store'])->name('products.store');
    Route::patch('/products/{product}', [\App\Http\Controllers\Admin\AdminProductController::class, 'update'])->name('products.update');

    // Historical Loans
    Route::get('/loans', [\App\Http\Controllers\Admin\AdminLoanController::class, 'index'])->name('loans.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
