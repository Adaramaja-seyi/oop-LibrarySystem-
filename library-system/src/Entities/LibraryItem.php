<?php

namespace LibrarySystem\Entities;

abstract class LibraryItem
{

    protected bool $isBorrowed = false;

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

    public function isBorrowed(): bool
    {
        return $this->isBorrowed;
    }

    protected $title;
    protected $isbn;
    protected $availableCopies;

    public function __construct(string $title, string $isbn, int $availableCopies)
    {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->availableCopies = $availableCopies;
    }

    abstract public function getDetails(): string;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getAvailableCopies(): int
    {
        return $this->availableCopies;
    }

    protected function setAvailableCopies(int $copies): void
    {
        if ($copies >= 0) {
            $this->availableCopies = $copies;
        } else {
            throw new \InvalidArgumentException("Available copies cannot be negative");
        }
    }
}
?>