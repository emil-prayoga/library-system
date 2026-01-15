<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BorrowingTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Book $book;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->book = Book::factory()->create(['stock' => 1]);
    }

    /**
     * Test user can borrow book
     */
    public function test_user_can_borrow_book(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('borrowings.store'), [
                'book_id' => $this->book->id,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('borrowings', [
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'status' => 'BORROWED',
        ]);
        $this->book->refresh();
        $this->assertEquals(0, $this->book->stock);
    }

    /**
     * Test cannot borrow when stock habis (0)
     */
    public function test_cannot_borrow_when_stock_is_zero(): void
    {
        $this->book->update(['stock' => 0]);

        $response = $this->actingAs($this->user)
            ->post(route('borrowings.store'), [
                'book_id' => $this->book->id,
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Buku tidak tersedia. Stok habis.');
    }

    /**
     * Test cannot borrow more than 3 books
     */
    public function test_cannot_borrow_more_than_three_books(): void
    {
        // Create 3 books and borrow them
        for ($i = 0; $i < 3; $i++) {
            $book = Book::factory()->create(['stock' => 1]);
            Borrowing::create([
                'user_id' => $this->user->id,
                'book_id' => $book->id,
                'borrow_date' => now(),
                'return_deadline' => now()->addDays(7),
                'status' => 'BORROWED',
            ]);
        }

        // Try to borrow 4th book
        $book4 = Book::factory()->create(['stock' => 1]);
        $response = $this->actingAs($this->user)
            ->post(route('borrowings.store'), [
                'book_id' => $book4->id,
            ]);

        $response->assertSessionHas('error', 'Anda sudah meminjam 3 buku. Kembalikan salah satu buku terlebih dahulu sebelum meminjam buku lain.');
    }

    /**
     * Test cannot borrow same book twice
     */
    public function test_cannot_borrow_same_book_twice(): void
    {
        Borrowing::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'borrow_date' => now(),
            'return_deadline' => now()->addDays(7),
            'status' => 'BORROWED',
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('borrowings.store'), [
                'book_id' => $this->book->id,
            ]);

        $response->assertSessionHas('error', 'Anda sudah meminjam buku ini. Kembalikan terlebih dahulu sebelum meminjam lagi.');
    }

    /**
     * Test user can return book
     */
    public function test_user_can_return_book(): void
    {
        $borrowing = Borrowing::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'borrow_date' => now(),
            'return_deadline' => now()->addDays(7),
            'status' => 'BORROWED',
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('borrowings.return', $borrowing));

        $response->assertRedirect();
        $borrowing->refresh();
        $this->assertEquals('RETURNED', $borrowing->status);
        $this->book->refresh();
        $this->assertEquals(1, $this->book->stock);
    }

    /**
     * Test fine calculated for overdue return
     */
    public function test_fine_calculated_for_overdue_return(): void
    {
        $borrowing = Borrowing::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'borrow_date' => now()->subDays(10),
            'return_deadline' => now()->subDays(3), // 3 days overdue
            'status' => 'BORROWED',
        ]);

        $this->actingAs($this->user)
            ->post(route('borrowings.return', $borrowing));

        $borrowing->refresh();
        $expectedFine = 3 * 2000; // Rp 2000 per day
        $this->assertEquals($expectedFine, $borrowing->fine);
    }

    /**
     * Test user cannot access other user's borrowing
     */
    public function test_user_cannot_view_other_user_borrowing(): void
    {
        $otherUser = User::factory()->create();
        $borrowing = Borrowing::create([
            'user_id' => $otherUser->id,
            'book_id' => $this->book->id,
            'borrow_date' => now(),
            'return_deadline' => now()->addDays(7),
            'status' => 'BORROWED',
        ]);

        // Attempt to return someone else's book
        $response = $this->actingAs($this->user)
            ->post(route('borrowings.return', $borrowing));

        $response->assertStatus(403);
    }
}
