<?php

namespace LibrarySystem\Actions;

use LibrarySystem\Entities\LibraryItem;
use LibrarySystem\Entities\Member;
use DateTime;

class Borrowing
{
    private $item;
    private $member;
    private $borrowDate;
    private $returnDate;
    private $dueDate;

    public function __construct(LibraryItem $item, Member $member, DateTime $borrowDate, DateTime $dueDate)
    {
        $this->item = $item;
        $this->member = $member;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
    }

    public function getItem(): LibraryItem
    {
        return $this->item;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function getBorrowDate(): DateTime
    {
        return $this->borrowDate;
    }

    public function getDueDate(): DateTime
    {
        return $this->dueDate;
    }

    public function getReturnDate(): ?DateTime
    {
        return $this->returnDate;
    }

    public function returnItem(DateTime $returnDate): bool
    {
        $this->returnDate = $returnDate;
        return true;
    }

    public function isOverdue(): bool
    {
        $now = new DateTime();
        return $now > $this->dueDate && $this->returnDate === null;
    }
}
?>