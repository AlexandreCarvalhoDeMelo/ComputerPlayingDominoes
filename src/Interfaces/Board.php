<?php
namespace Dominoes\Interfaces;

use Dominoes\Interfaces\Piece as PieceInterface;

interface Board
{
    public function startGame(PieceInterface $piece): void;
    public function addPieceLeftEnd(PieceInterface $piece): bool;
    public function addPieceRightEnd(PieceInterface $piece): bool;
    public function getLastLeftPiece(): PieceInterface;
    public function getLastRightPiece(): PieceInterface;
    public function getPieceFromStack(): ?PieceInterface;
    public function getLastRightPieceNumber(): int;
    public function getLastLeftPieceNumber(): int;

    /**
     * @param  int $total
     * @return array<PieceInterface>
     */
    public function getPiecesFromStack(int $total): array;

    /**
     * @return array<PieceInterface>
     */
    public function getPlayerPieces(): array;
}
