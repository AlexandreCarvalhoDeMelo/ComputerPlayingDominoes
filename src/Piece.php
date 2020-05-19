<?php
declare(strict_types=1);
namespace Dominoes;
use \Dominoes\Interfaces\Piece as PieceInterface;

/**
 * Class Piece
 * Pieces values are immutable
 *
 * @Author   Alexandre Melo <alexandre.carvalho.melo@gmail.com>
 * @package  Dominoes
 * @category assessent
 * @link     none
 */
class Piece implements PieceInterface
{
    /**
     * Piece left side number
     *
     * @var int
     */
    private $leftSideNumber;

    /**
     * Piece right side number
     *
     * @var int
     */
    private $rightSideNumber;

    /**
     * Piece constructor.
     *
     * @param int $leftNumber
     * @param int $rightNumber
     */
    public function __construct(int $leftNumber, int $rightNumber)
    {
        $this->leftSideNumber = $leftNumber;
        $this->rightSideNumber = $rightNumber;
    }

    /**
     * Turns piece so it fit on board
     */
    public function turn(): void
    {
        $rightSide = $this->getRightSideNumber();
        $leftSide = $this->getLeftSideNumber();

        $this->rightSideNumber = $leftSide;
        $this->leftSideNumber = $rightSide;
    }

    /**
     * Returns price string representation
     *
     * @return string
     */
    public function toString(): string
    {
        $rightSide = $this->getRightSideNumber();
        $leftSide = $this->getLeftSideNumber();

        return "<".$leftSide .":". $rightSide.">";
    }

    /**
     * Returns piece left number
     *
     * @return int
     */
    public function getLeftSideNumber(): int
    {
        return $this->leftSideNumber;
    }

    /**
     * Returns piece right number
     *
     * @return int
     */
    public function getRightSideNumber(): int
    {
        return $this->rightSideNumber;
    }
}