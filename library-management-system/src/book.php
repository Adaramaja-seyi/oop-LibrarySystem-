<?php

namespace LibrarySystem\Entities;

// use LibrarySystem\Entities\LibraryItem;
use LibrarySystem\Entities\Borrowable;
class Book extends LibraryItem implements Borrowable
{
    private string $author;
    protected string $isbn;
    protected int $availableCopies;

    public function __construct(string $title, string $author, string $isbn, int $availableCopies)
    {
        parent::__construct($title);
        $this->author = $author;
        $this->isbn = $isbn;
        $this->setAvailableCopies($availableCopies);
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getAvailableCopies(): int
    {
        return $this->availableCopies;
    }

    public function setAvailableCopies(int $copies): void
    {
        if ($copies < 0) {
            throw new \InvalidArgumentException("Available copies cannot be negative.");
        }
        $this->availableCopies = $copies;
    }

    public function getDetails(): string
    {
        return "Book: {$this->getTitle()}, Author: {$this->author}, ISBN: {$this->isbn}, Available Copies: {$this->availableCopies}";
    }

    public function borrowItem(): bool
    {
        if ($this->availableCopies > 0) {
            $this->availableCopies--;
            return true;
        }
        return false;
    }

    public function returnItem():bool
    {
        return parent::returnItem();
    }
}
?>