<?php

namespace LibrarySystem\Entities;

use LibrarySystem\Entities\Borrowable;

class Magazine extends LibraryItem implements Borrowable
{
    private $issueNumber;
    private $publisher;

    public function __construct(string $title, string $publisher, string $issueNumber, string $isbn, int $availableCopies)
    {
        parent::__construct($title, $isbn, $availableCopies);
        $this->publisher = $publisher;
        $this->issueNumber = $issueNumber;
    }

    public function getDetails(): string
    {
        return "Magazine: {$this->title} (Issue: {$this->issueNumber}, Publisher: {$this->publisher}) - {$this->availableCopies} available";
    }

    public function getIssueNumber(): string
    {
        return $this->issueNumber;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function borrowItem(): bool
    {
        if ($this->availableCopies > 0) {
            $this->setAvailableCopies($this->availableCopies - 1);
            return true;
        }
        return false;
    }

    public function returnItem(): bool
    {
        $this->setAvailableCopies($this->availableCopies + 1);
        return true;
    }
}
?>