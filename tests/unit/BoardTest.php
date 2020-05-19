<?php
declare(strict_types=1);

namespace Dominoes\Tests\Unit;

use Dominoes\Board;
use Dominoes\Piece;
use PHPUnit\Framework\TestCase;

/**
 * Class BoardTest
 *
 * @package Dominoes\Tests\Unit
 */
class BoardTest extends TestCase
{
    public function test_it_can_assemble_board_pieces()
    {
        $dominoesBoard = new Board();

        $pieces = $dominoesBoard->getPiecesFromStack(28);

        self::assertCount(28, $pieces);

        foreach ($pieces as $piece) {
            self::assertInstanceOf(\Dominoes\Interfaces\Piece::class, $piece);
            self::assertIsNumeric($piece->getLeftSideNumber());
            self::assertIsNumeric($piece->getRightSideNumber());
        }
    }

    public function test_it_can_start_game()
    {
        $dominoesBoard = new Board();
        $expectedPiece = $dominoesBoard->getPieceFromStack();
        $dominoesBoard->startGame($expectedPiece);
        $subject = $dominoesBoard->getPlayerPieces();

        self::assertEquals($expectedPiece, $subject[0]);
    }

    public function test_it_add_pieces()
    {
        $starterPiece = new Piece(2, 2);
        $leftPiece = new Piece(1, 2);
        $rightPiece = new Piece(2, 3);

        $subjectBoard = new Board();
        $subjectBoard->startGame($starterPiece);
        $subjectBoard->addPieceLeftEnd($leftPiece);
        $subjectBoard->addPieceRightEnd($rightPiece);

        self::assertEquals($leftPiece, $subjectBoard->getLastLeftPiece());
        self::assertEquals($rightPiece, $subjectBoard->getLastRightPiece());
    }

    public function test_it_can_get_piece_from_stack()
    {
        $subjectBoard = new Board();
        self::assertInstanceOf(\Dominoes\Interfaces\Piece::class, $subjectBoard->getPieceFromStack());
        self::assertCount(10, $subjectBoard->getPiecesFromStack(10));
    }

}
