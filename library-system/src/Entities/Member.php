<?php

namespace LibrarySystem\Entities;

use LibrarySystem\Entities\LibraryItem;

class Member
{
    private $memberId;
    private $name;
    private $email;
    private $borrowedItems = [];

    public function __construct(string $memberId, string $name, string $email)
    {
        $this->memberId = $memberId;
        $this->name = $name;
        $this->email = $email;
    }

    public function getMemberId(): string
    {
        return $this->memberId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBorrowedItems(): array
    {
        return $this->borrowedItems;
    }

    public function borrowItem(LibraryItem $item): bool
    {
        $this->borrowedItems[] = $item;
        return true;
    }

    public function returnItem(LibraryItem $item): bool
    {
        $index = array_search($item, $this->borrowedItems, true);
        if ($index !== false) {
            array_splice($this->borrowedItems, $index, 1);
            return true;
        }
        return false;
    }
}
?>