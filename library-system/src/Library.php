<?php

namespace LibrarySystem;

use DateTime;

use LibrarySystem\Entities\LibraryItem;
use LibrarySystem\Entities\Member;
use LibrarySystem\Actions\Borrowing;
use Iterator;



class Library implements Iterator
{
    private static $totalItems = 0;
    private $books = [];
    private $magazines = [];
    private $members = [];
    private $borrowings = [];
    private $position = 0;

    // Static method to get total item count
    public static function getTotalItems(): int
    {
        return self::$totalItems;
    }

    // Add a book to the library
    public function addBook(\LibrarySystem\Entities\Book $book): void
    {
        $this->books[] = $book;
        self::$totalItems++;
    }

    // Add a magazine to the library
    public function addMagazine(\LibrarySystem\Entities\Magazine $magazine): void
    {
        $this->magazines[] = $magazine;
        self::$totalItems++;
    }

    // Register a member
    public function registerMember(\LibrarySystem\Entities\Member $member): void
    {
        $this->members[] = $member;
    }

    // Borrow an item
    public function borrowItem(\LibrarySystem\Entities\LibraryItem $item, \LibrarySystem\Entities\Member $member, \DateTime $dueDate): bool
    {
        if ($item->borrowItem()) {
            $borrowing = new Borrowing($item, $member, new DateTime(), $dueDate);
            $this->borrowings[] = $borrowing;
            $member->borrowItem($item);
            return true;
        }
        return false;
    }

    // Return an item
    public function returnItem(\LibrarySystem\Entities\LibraryItem $item, \LibrarySystem\Entities\Member $member): bool
    {
        foreach ($this->borrowings as $borrowing) {
            if ($borrowing->getItem() === $item && $borrowing->getMember() === $member && $borrowing->getReturnDate() === null) {
                $item->returnItem();
                $borrowing->returnItem(new DateTime());
                $member->returnItem($item);
                return true;
            }
        }
        return false;
    }

    // Get all borrowings
    public function getBorrowings(): array
    {
        return $this->borrowings;
    }

    // Get all books
    public function getBooks(): array
    {
        return $this->books;
    }

    // Get all magazines
    public function getMagazines(): array
    {
        return $this->magazines;
    }

    // Get all members
    public function getMembers(): array
    {
        return $this->members;
    }

    // Iterator interface implementation
    public function current(): mixed
    {
        $allItems = array_merge($this->books, $this->magazines);
        return $allItems[$this->position];
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        $allItems = array_merge($this->books, $this->magazines);
        return isset($allItems[$this->position]);
    }
}
?>