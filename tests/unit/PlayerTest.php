<?php
declare(strict_types=1);

namespace Dominoes\Tests\Unit;

use Dominoes\Board;
use Dominoes\Piece;
use Dominoes\Player;
use PHPUnit\Framework\TestCase;

/**
 * Class PlayerTest
 *
 * @package Dominoes\Tests\Unit
 */
class PlayerTest extends TestCase
{
    /**
     * @return array|array[]
     */
    public function playerProvider(): array
    {
        return [
            'player' => [
                'name' => 'Jom',
                'hand' => [
                    new Piece(1, 2),
                    new Piece(3, 1),
                    new Piece(3, 5),
                    new Piece(5, 2),
                    new Piece(2, 2),
                    new Piece(2, 3),
                ],
                'board' => new Board(),
            ]
        ];
    }

    /**
     * @dataProvider playerProvider
     * @param        string $playerName
     * @param        array  $playerHand
     * @param        Board  $board
     */
    public function test_player_piece_search_fallback(string $playerName, array $playerHand, Board $board): void
    {
        $player = new Player($playerName, $playerHand);
        $firstPiece = array_shift($playerHand);
        $board->startGame($firstPiece);
        $player->lookAtBoard($board);
        $piece = $player->searchCompatiblePiece() ?? $player->requestMatchingPieceFromBoard();
        self::assertNotEmpty($piece);
        self::assertInstanceOf(\Dominoes\Interfaces\Piece::class, $piece);
    }

    /**
     * @dataProvider playerProvider
     * @param        string $playerName
     * @param        array  $playerHand
     * @param        Board  $board
     */
    public function test_player_can_get_first_piece(string $playerName, array $playerHand, Board $board): void
    {
        ob_start();
        $player = new Player($playerName, $playerHand);
        $firstPiece = $player->getFirstPiece();
        ob_end_clean();
        self::assertNotEmpty($firstPiece->getLeftSideNumber());
        self::assertNotEmpty($firstPiece->getRightSideNumber());
    }

    /**
     * @dataProvider playerProvider
     * @param        string $playerName
     * @param        array  $playerHand
     * @param        Board  $board
     */
    public function test_if_player_can_match_pieces(string $playerName, array $playerHand, Board $board): void
    {
        $expectedPiece = new Piece(5, 1);
        $player = new Player($playerName, $playerHand);
        $board->startGame($expectedPiece);
        $player->lookAtBoard($board);

        $piece = $player->searchCompatiblePiece();
        self::assertInstanceOf(\Dominoes\Interfaces\Piece::class, $piece);
        self::assertEquals($expectedPiece->getRightSideNumber(), $piece->getLeftSideNumber());
    }

    /**
     * @dataProvider playerProvider
     * @param        string $playerName
     * @param        array  $playerHand
     * @param        Board  $board
     */
    public function test_player_can_read_hand_count(string $playerName, array $playerHand, Board $board): void
    {
        $player = new Player($playerName, $playerHand);
        self::assertEquals(6, $player->getHandCount());
    }

    /**
     * @dataProvider playerProvider
     * @param        string $playerName
     * @param        array  $playerHand
     * @param        Board  $board
     */
    public function test_player_can_put_piece_on_board(string $playerName, array $playerHand, Board $board): void
    {
        ob_start();
        $player = new Player($playerName, $playerHand);
        $expectedPiece = new Piece(5, 1);
        $board->startGame($expectedPiece);
        $player->lookAtBoard($board);
        $piece = $player->searchCompatiblePiece() ?? $player->requestMatchingPieceFromBoard();
        $player->putPieceOnBoard($piece);
        $playerPieces = $board->getPlayerPieces();
        ob_end_clean();
        self::assertEquals($expectedPiece->getRightSideNumber(), $playerPieces[1]->getLeftSideNumber());
    }

}
