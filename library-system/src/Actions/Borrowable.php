<?php

namespace LibrarySystem\Actions;

interface Borrowable
{
    public function borrowItem(): bool;
    public function returnItem(): bool;
}
?>