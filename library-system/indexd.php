<?php
require_once __DIR__ . '/src/Entities/LibraryItem.php';
require_once __DIR__ . '/src/Entit/Borrowable.php';

require_once __DIR__ . '/src/Entities/Book.php';
require_once __DIR__ . '/src/Entities/Magazine.php';
require_once __DIR__ . '/src/Entities/Member.php';
require_once __DIR__ . '/src/Actions/Borrowing.php';
require_once __DIR__ . '/src/Library.php';

use LibrarySystem\Entities\Book;
use LibrarySystem\Entities\Magazine;
use LibrarySystem\Entities\Member;
use LibrarySystem\Library;

// Create library instance
$library = new Library();

// Add some books
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", "9780743273565", 3);
$book2 = new Book("To Kill a Mockingbird", "Harper Lee", "9780061120084", 2);
$book3 = new Book("1984", "George Orwell", "9780451524935", 1);

$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// Add some magazines
$magazine1 = new Magazine("National Geographic", "National Geographic Society", "June 2023", "MAG123456", 5);
$magazine2 = new Magazine("Time", "Time USA", "May 2023", "MAG789012", 3);
$magazine3 = new Magazine("Scientific American", "Springer Nature", "April 2023", "MAG345678", 2);

$library->addMagazine($magazine1);
$library->addMagazine($magazine2);
$library->addMagazine($magazine3);

// Register some members
$member1 = new Member("M001", "John Doe", "john@example.com");
$member2 = new Member("M002", "Jane Smith", "jane@example.com");
$member3 = new Member("M003", "Bob Johnson", "bob@example.com");

$library->registerMember($member1);
$library->registerMember($member2);
$library->registerMember($member3);

// Demonstrate borrowing
$dueDate1 = new DateTime('+14 days');
$dueDate2 = new DateTime('+7 days');
echo "Borrowing items:\n";
$library->borrowItem($book1, $member1, $dueDate1);
$library->borrowItem($magazine2, $member2, $dueDate2);
$library->borrowItem($book3, $member3, $dueDate1);

// Display all items using iterator
echo "\nAll Library Items:\n";
foreach ($library as $item) {
    echo "- " . $item->getDetails() . "\n";
}

// Display borrowing report
echo "\nBorrowing Report:\n";
foreach ($library->getBorrowings() as $borrowing) {
    $dueDate = $borrowing->getDueDate()->format('Y-m-d');
    $status = $borrowing->isOverdue() ? "OVERDUE" : "On Time";
    echo "- " . $borrowing->getMember()->getName() . " borrowed " .
        $borrowing->getItem()->getTitle() . " (Due: $dueDate, Status: $status)\n";
}

// Demonstrate returning an item
echo "\nReturning '1984' by Bob Johnson:\n";
$library->returnItem($book3, $member3);
echo "Now available copies: " . $book3->getAvailableCopies() . "\n";

// Display static property
echo "\nTotal items in library: " . Library::getTotalItems() . "\n";
?>
