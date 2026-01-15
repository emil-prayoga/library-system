<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Models\Borrowing;
use App\Policies\BookPolicy;
use App\Policies\BorrowingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Borrowing::class => BorrowingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Admin gate
        Gate::define('admin', function ($user) {
            return $user->isAdmin();
        });

        // Manage books gate
        Gate::define('manage-books', function ($user) {
            return $user->isAdmin();
        });

        // Manage borrowings gate
        Gate::define('manage-borrowings', function ($user) {
            return $user->isAdmin();
        });

        // Borrow books gate
        Gate::define('borrow-books', function ($user) {
            return $user->role === 'user';
        });
    }
}
