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
        Schema::table('books', function (Blueprint $table) {
            // Add new columns after existing ones
            $table->string('isbn')->nullable()->after('author');
            $table->string('publisher')->nullable()->after('category');
            $table->date('published_date')->nullable()->after('publisher');
            $table->text('description')->nullable()->after('published_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['isbn', 'publisher', 'published_date', 'description']);
        });
    }
};
