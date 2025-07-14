<?php

namespace LibrarySystem\Entities;

use LibrarySystem\Entities\Borrowable;

class Book extends LibraryItem implements Borrowable
{
    private $author;

    public function __construct(string $title, string $author, string $isbn, int $availableCopies)
    {
        parent::__construct($title, $isbn, $availableCopies);
        $this->author = $author;
    }

    public function getDetails(): string
    {
        return "Book: {$this->title} by {$this->author} (ISBN: {$this->isbn}) - {$this->availableCopies} available";
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function borrowItem(): bool
    {
        if (!$this->isBorrowed) {
            $this->isBorrowed = true;
            return true;
        }
        return false;
    }

    public function returnItem(): bool
    {
        if ($this->isBorrowed) {
            $this->isBorrowed = false;
            return true;
        }
        return false;
    }
}
?>