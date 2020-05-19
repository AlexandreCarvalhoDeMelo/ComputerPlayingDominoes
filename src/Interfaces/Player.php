<?php
namespace Dominoes\Interfaces;

use Dominoes\Interfaces\Piece as PieceInterface;

interface Player
{
    public function getFirstPiece(): ?PieceInterface;
    public function lookAtBoard(Board $board): void;
    public function getHandCount(): int;
    public function searchCompatiblePiece(): ?PieceInterface;
    public function requestMatchingPieceFromBoard(): ?PieceInterface;
    public function putPieceOnBoard(PieceInterface $piece);
    public function isGameEnd(): bool;
}
