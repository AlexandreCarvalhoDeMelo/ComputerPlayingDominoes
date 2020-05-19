<?php
declare(strict_types=1);

namespace Dominoes\Tests\Unit;

use Dominoes\Piece;
use PHPUnit\Framework\TestCase;

/**
 * Class PieceTest
 *
 * @package Dominoes\Tests\Unit
 */
class PieceTest extends TestCase
{
    public function pieceProvider()
    {
        return [
            'piece' => [
                2,
                3
            ]
        ];
    }

    /**
     * @dataProvider pieceProvider
     * @param        $left
     * @param        $right
     */
    public function test_piece_has_right_numbers($left, $right)
    {
        $piece = new Piece($left, $right);
        self::assertEquals($left, $piece->getLeftSideNumber());
        self::assertEquals($right, $piece->getRightSideNumber());
    }

    /**
     * @dataProvider pieceProvider
     * @param        $left
     * @param        $right
     */
    public function test_it_can_turn_piece($left, $right)
    {
        $piece = new Piece($left, $right);
        $piece->turn();

        self::assertEquals($left, $piece->getRightSideNumber());
        self::assertEquals($right, $piece->getLeftSideNumber());
    }

    /**
     * @dataProvider pieceProvider
     * @param        $left
     * @param        $right
     */
    public function test_it_can_output_piece_string($left, $right)
    {
        $piece = new Piece($left, $right);
        $expected = "<" . $left . ":" . $right . ">";
        self::assertEquals($expected, $piece->toString());
    }
}
