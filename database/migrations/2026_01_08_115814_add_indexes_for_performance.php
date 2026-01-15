<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes on borrowings table
        Schema::table('borrowings', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('book_id');
            $table->index('status');
            $table->index(['user_id', 'status']);
            $table->index(['book_id', 'status']);
        });

        // Add indexes on books table
        Schema::table('books', function (Blueprint $table) {
            $table->index('category');
            $table->index('title');
        });

        // Add indexes on users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['book_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['book_id', 'status']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['title']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
        });
    }
};
