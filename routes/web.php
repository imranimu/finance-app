<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EmiPersonController;
use App\Http\Controllers\EmiListController;
use App\Http\Controllers\CreditBillController;
use App\Http\Controllers\WaiverController;

Route::get('/', function () { return redirect()->route('login'); });
// register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Placeholder routes যাতে sidebar লিংক কাজ করে
    Route::view('/invoices',   'dashboard')->name('invoices.index');
    Route::view('/bills',      'dashboard')->name('bills.index');
    Route::view('/banking',    'dashboard')->name('banking.index');
    Route::view('/customers',  'dashboard')->name('customers.index');
    Route::view('/suppliers',  'dashboard')->name('suppliers.index');
    Route::view('/reports',    'dashboard')->name('reports.index');
    Route::view('/accounts',   'dashboard')->name('accounts.index');
    Route::view('/settings',   'dashboard')->name('settings.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    // Edit, update, destroy methods for categories are implemented in CategoryController.php
    // Edit Category: GET /categories/{category}/edit
    // Update Category: PUT/PATCH /categories/{category}
    // Destroy Category: DELETE /categories/{category}
    Route::post('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::resource('banks', BankController::class);
    Route::resource('transactions', TransactionController::class);
    // Edit, update, destroy methods for transactions are implemented in TransactionController.php
    // Edit Transaction: GET /transactions/{transaction}/edit
    // Update Transaction: PUT/PATCH /transactions/{transaction}
    // Destroy Transaction: DELETE /transactions/{transaction}
    Route::post('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    Route::resource('emi-people', EmiPersonController::class);
    Route::resource('emi-lists', EmiListController::class);
    Route::resource('credit-bills', CreditBillController::class);
    Route::resource('waivers', WaiverController::class);
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Profile
    Route::get('/profile',          [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',        [ProfileController::class, 'update'])->name('profile.update');

    // Password
    Route::get('/password',         [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::patch('/password',       [ProfileController::class, 'updatePassword'])->name('password.update');

    // Settings
    Route::view('/settings', 'settings.index')->name('settings.index');

    // Placeholder routes
    Route::view('/invoices',  'dashboard')->name('invoices.index');
    Route::view('/bills',     'dashboard')->name('bills.index');
    Route::view('/banking',   'dashboard')->name('banking.index');
    Route::view('/customers', 'dashboard')->name('customers.index');
    Route::view('/suppliers', 'dashboard')->name('suppliers.index');
    Route::view('/reports',   'dashboard')->name('reports.index');
    Route::view('/accounts',  'dashboard')->name('accounts.index');
});

// Logout
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Auth (login/register)
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
