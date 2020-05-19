<?php
declare(strict_types=1);

namespace Dominoes\Tests\Unit;

use Dominoes\Board;
use PHPUnit\Framework\TestCase;

/**
 * Class PlayTest
 *
 * @package Dominoes\Tests\Unit
 */
class PlayTest extends TestCase
{
    /**
     * @return array|array[]
     */
    public function gameProvider(): array
    {
        return [
            'bootstrap' => [
                'playerListName' => [
                    'Jim',
                    'Root',
                    'Tom',
                ],
                'board' => new Board(),
            ]
        ];
    }


    /**
     * @dataProvider gameProvider
     * @param        array<string> $playerListName
     * @param        Board         $board
     */
    public function test_game_works(array $playerListName, Board $board): void
    {
        ob_start();
        new \Dominoes\Play($playerListName, $board);
        $bufferOutput = \ob_get_clean();

        self::assertStringContainsString('Won!', $bufferOutput);
    }

}
