<?php
declare(strict_types=1);

namespace Dominoes;

use Dominoes\Interfaces\Piece as PieceInterface;
use Dominoes\Interfaces\Board as BoardInterface;

/**
 * Class Board
 *
 * @Author   Alexandre Melo <alexandre.carvalho.melo@gmail.com>
 * @package  Dominoes
 * @category assessent
 * @link     none
 */
class Board implements BoardInterface
{
    /**
     * Games Rules
     */
    private const START_PIECE_NUMBER = 0;
    private const FINAL_PIECE_NUMBER = 6;

    /**
     * Pieces used in the game
     *
     * @var array<PieceInterface>
     */
    private $playerPieces = [];

    /**
     * Pieces available on the board
     *
     * @var array<PieceInterface>
     */
    public $pieceStack = [];

    /**
     * Last left number registered in the board
     *
     * @var int
     */
    private $lastLeftPieceNumberOnboard;

    /**
     * Last right number registered in the board
     *
     * @var int
     */
    private $lastRightPieceNumberOnboard;

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->assemblePieceStack();
    }

    /**
     * Builds piece stack to be used during the game
     */
    private function assemblePieceStack(): void
    {
        for ($leftSide = self::START_PIECE_NUMBER; $leftSide <= self::FINAL_PIECE_NUMBER; $leftSide++) {
            for ($rightSide = $leftSide; $rightSide <= self::FINAL_PIECE_NUMBER; $rightSide++) {
                $this->pieceStack[] = new Piece($leftSide, $rightSide);
            }
        }

        shuffle($this->pieceStack);
    }

    /**
     * Set first
     *
     * @param PieceInterface $piece
     */
    public function startGame(PieceInterface $piece): void
    {
        $this->lastLeftPieceNumberOnboard = $piece->getLeftSideNumber();
        $this->lastRightPieceNumberOnboard = $piece->getRightSideNumber();
        $this->playerPieces[] = $piece;
    }

    /**
     * Adds piece to left end of the board
     *
     * @param  PieceInterface $piece
     * @return bool
     */
    public function addPieceLeftEnd(PieceInterface $piece): bool
    {
        array_unshift($this->playerPieces, $piece);
        $this->lastLeftPieceNumberOnboard = $piece->getLeftSideNumber();
        $lastAddedPiece = $this->playerPieces[0];
        return $lastAddedPiece->getRightSideNumber() === $piece->getRightSideNumber() &&
            $lastAddedPiece->getLeftSideNumber() === $piece->getLeftSideNumber();
    }

    /**
     * Adds piece to right end of the board
     *
     * @param  PieceInterface $piece
     * @return bool
     */
    public function addPieceRightEnd(PieceInterface $piece): bool
    {
        $this->playerPieces[] = $piece;
        $this->lastRightPieceNumberOnboard = $piece->getRightSideNumber();

        /**
         * @var Piece $lastAddedPiece
         */
        $lastAddedPiece = $this->playerPieces[0];
        return $lastAddedPiece->getRightSideNumber() === $piece->getRightSideNumber() &&
            $lastAddedPiece->getLeftSideNumber() === $piece->getLeftSideNumber();
    }

    /**
     * Gets a piece from the stack
     *
     * @return PieceInterface|null
     */
    public function getPieceFromStack(): ?PieceInterface
    {
        if (empty($this->pieceStack)) {
            return null;
        }

        $pieceKey = array_rand($this->pieceStack, 1);
        $piece = $this->pieceStack[$pieceKey];
        unset($this->pieceStack[$pieceKey]);

        return $piece;
    }

    /**
     * Returns total of pieces defined by user
     *
     * @param  int $total
     * @return array<PieceInterface>
     */
    public function getPiecesFromStack(int $total): array
    {
        $playerPieces = [];
        for ($piecesRequested = 1; $piecesRequested <= $total; $piecesRequested++) {
            $playerPieces[] = $this->getPieceFromStack();
        }

        return $playerPieces;
    }

    /**
     * List player pieces
     *
     * @return array<PieceInterface>
     */
    public function getPlayerPieces(): array
    {
        return $this->playerPieces;
    }

    /**
     * Returns last piece on the left end of the board
     *
     * @return PieceInterface
     */
    public function getLastLeftPiece(): PieceInterface
    {
        return $this->playerPieces[0];
    }

    /**
     * Returns last piece on the right end of the board
     *
     * @return PieceInterface
     */
    public function getLastRightPiece(): PieceInterface
    {
        return end($this->playerPieces);
    }

    /**
     * Get board left end number
     *
     * @return int
     */
    public function getLastLeftPieceNumber(): int
    {
        return $this->lastLeftPieceNumberOnboard;
    }

    /**
     * Get board right end number
     *
     * @return int
     */
    public function getLastRightPieceNumber(): int
    {
        return $this->lastRightPieceNumberOnboard;
    }

}