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

Route::get('/', function () { return redirect()->route('login'); });
// register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
