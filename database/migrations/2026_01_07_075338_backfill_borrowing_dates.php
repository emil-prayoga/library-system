<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Backfill borrow_date for records where it's null
        DB::table('borrowings')
            ->whereNull('borrow_date')
            ->update(['borrow_date' => DB::raw('created_at')]);

        // Backfill return_deadline for records where it's null (7 days from borrow_date)
        DB::table('borrowings')
            ->whereNull('return_deadline')
            ->update(['return_deadline' => DB::raw('DATE_ADD(borrow_date, INTERVAL 7 DAY)')]);

        // For RETURNED status with null return_date, set it to borrow_date + 7 days
        DB::table('borrowings')
            ->where('status', 'RETURNED')
            ->whereNull('return_date')
            ->update(['return_date' => DB::raw('return_deadline')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse - just revert to null if needed
        // This is data that will be preserved
    }
};
