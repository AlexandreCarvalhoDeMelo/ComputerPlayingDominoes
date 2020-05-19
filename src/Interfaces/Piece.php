<?php

namespace Dominoes\Interfaces;

interface Piece
{
    public function getRightSideNumber(): int;
    public function getLeftSideNumber(): int;
    public function turn(): void;
    public function toString(): string;
}
