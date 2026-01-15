<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin Library',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Users
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create Books
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'year' => 1997,
                'stock' => 5,
                'category' => 'Fiction',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'year' => 1937,
                'stock' => 3,
                'category' => 'Fantasy',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'year' => 1960,
                'stock' => 4,
                'category' => 'Classic',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'year' => 1949,
                'stock' => 2,
                'category' => 'Dystopian',
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'year' => 1925,
                'stock' => 0,
                'category' => 'Classic',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'year' => 2008,
                'stock' => 6,
                'category' => 'Technology',
            ],
            [
                'title' => 'Design Patterns',
                'author' => 'Gang of Four',
                'year' => 1994,
                'stock' => 3,
                'category' => 'Technology',
            ],
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'year' => 2011,
                'stock' => 4,
                'category' => 'History',
            ],
        ];

        foreach ($books as $bookData) {
            Book::create($bookData);
        }

        // Create some borrowings
        // Active borrowing (not overdue)
        Borrowing::create([
            'user_id' => $user1->id,
            'book_id' => 1,
            'borrow_date' => Carbon::now()->subDays(2),
            'return_deadline' => Carbon::now()->addDays(5),
            'status' => 'BORROWED',
        ]);

        // Active borrowing (overdue)
        Borrowing::create([
            'user_id' => $user1->id,
            'book_id' => 2,
            'borrow_date' => Carbon::now()->subDays(10),
            'return_deadline' => Carbon::now()->subDays(3),
            'status' => 'BORROWED',
        ]);

        // Returned (on time)
        Borrowing::create([
            'user_id' => $user2->id,
            'book_id' => 3,
            'borrow_date' => Carbon::now()->subDays(15),
            'return_deadline' => Carbon::now()->subDays(8),
            'return_date' => Carbon::now()->subDays(10),
            'status' => 'RETURNED',
            'fine' => 0,
        ]);

        // Returned (late with fine)
        Borrowing::create([
            'user_id' => $user2->id,
            'book_id' => 4,
            'borrow_date' => Carbon::now()->subDays(20),
            'return_deadline' => Carbon::now()->subDays(13),
            'return_date' => Carbon::now()->subDays(10),
            'status' => 'RETURNED',
            'fine' => 6000, // 3 days late * Rp 2.000
        ]);

        $this->command->info('Database seeded successfully!');
    }
}