<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PageController;

// Home redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest routes (no middleware)
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/dashboard', [GuestController::class, 'dashboard'])->name('dashboard');
    Route::get('/about', [GuestController::class, 'about'])->name('about');
    Route::get('/books/{book}', [GuestController::class, 'show'])->name('show');
    Route::get('/logout', [GuestController::class, 'logout'])->name('logout');
});

// Public routes
Route::get('/dashboard', function () {
    return redirect()->route('books.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Pages
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    
    // Contact Messages
    Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

    // Books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    
    // Borrowings
    Route::post('/borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('/my-borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('/my-borrowings/{borrowing}', [BorrowingController::class, 'show'])->name('borrowings.show');
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->name('borrowings.return');
    Route::get('/my-borrowings/export', [BorrowingController::class, 'export'])->name('borrowings.export');
});

// Admin Register routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/register', [AdminRegisterController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [AdminRegisterController::class, 'store'])->name('admin.register.store');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/view-as-user', function () {
        return redirect()->route('home');
    })->name('view-as-user');
    
    // Book Management
    Route::get('/books', [AdminDashboardController::class, 'booksIndex'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/{book}', [AdminBookController::class, 'show'])->name('books.show');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    
    // Category Management
    Route::resource('categories', AdminCategoryController::class);
    
    // User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/block', [AdminUserController::class, 'block'])->name('users.block');
    Route::post('/users/{user}/unblock', [AdminUserController::class, 'unblock'])->name('users.unblock');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    
    // Message Management
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/read', [AdminMessageController::class, 'markAsRead'])->name('messages.read');
    Route::post('/messages/{message}/archive', [AdminMessageController::class, 'markAsArchived'])->name('messages.archive');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    
    // Returns Management
    Route::get('/returns', [AdminDashboardController::class, 'returnsIndex'])->name('returns.index');
    
    // Borrowing Status Update & Export
    Route::patch('/borrowings/{borrowing}/status', [AdminDashboardController::class, 'updateStatus'])->name('borrowings.updateStatus');
    Route::get('/borrowings/export', [AdminDashboardController::class, 'exportTransactions'])->name('borrowings.export');
    Route::get('/borrowings/{borrowing}', [AdminDashboardController::class, 'showBorrowing'])->name('borrowings.show');
});

// Authentication routes
require __DIR__.'/auth.php';
