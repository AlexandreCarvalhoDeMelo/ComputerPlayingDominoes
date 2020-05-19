<?php
declare(strict_types=1);

namespace Dominoes;

use Dominoes\Interfaces\Board;
use \Dominoes\Interfaces\Piece as PieceInterface;
use \Dominoes\Interfaces\Player as PlayerInterface;

/**
 * Class Player
 *
 * @Author   Alexandre Melo <alexandre.carvalho.melo@gmail.com>
 * @package  Dominoes
 * @category assessent
 * @link     none
 */
class Player implements PlayerInterface
{
    /**
     * Player name
     *
     * @var string
     */
    public $name;

    /**
     * Player hand pieces
     *
     * @var array<PieceInterface>
     */
    private $handPieces;

    /**
     * Board being observed
     *
     * @var Board
     */
    private $board;

    /**
     * Board possible combinations
     *
     * @var array<int>
     */
    private $possibleCombinations;

    /**
     * Smallest Hand Counter Player fields
     */
    public const FIELD_PLAYER_HAND_COUNT = 'handCount';
    public const FIELD_PLAYER_NAME = 'name';

    /**
     * Player constructor.
     *
     * @param string $name
     * @param array  $pieces
     */
    public function __construct(string $name, array $pieces)
    {
        $this->name = $name;
        $this->handPieces = $pieces;
    }

    /**
     * Retains board state through each play
     *
     * @param  Board $board
     * @return void
     */
    public function lookAtBoard(Board $board): void
    {
        $this->board = $board;
        $this->possibleCombinations = [
            $this->board->getLastLeftPieceNumber(),
            $this->board->getLastRightPieceNumber(),
        ];
    }

    /**
     * Requests a piece matching board
     *
     * @return PieceInterface|null
     */
    public function requestMatchingPieceFromBoard(): ?PieceInterface
    {
        $piece = $this->board->getPieceFromStack();

        $allPiecesWereUsed = $piece === null;

        if ($allPiecesWereUsed) {
            return null;
        }

        $this->say(
            $this->name . " can't play drawing piece " . $piece->toString()
        );

        if ($this->isRightPiece($piece)) {
            return $piece;
        }

        return $this->requestMatchingPieceFromBoard();
    }

    /**
     * Search compatible piece inside player hands
     * In case it fails, the fallback will get a piece from the board
     * @see requestMatchingPieceFromBoard
     *
     * @return PieceInterface
     */
    public function searchCompatiblePiece(): ?PieceInterface
    {
        $piece = null;

        foreach ($this->handPieces as $pieceKey => $pieceValue) {
            if (empty($this->handPieces[$pieceKey])) {
                continue;
            }
            if ($this->isRightPiece($this->handPieces[$pieceKey])) {
                $piece = $this->handPieces[$pieceKey];
                unset($this->handPieces[$pieceKey]);
                break;
            }
        }

        return $piece;
    }

    /**
     * Compare piece end numbers with board expected ends numbers
     *
     * @param  PieceInterface $piece
     * @return bool
     */
    protected function isRightPiece(PieceInterface $piece): bool
    {
        $foundRightPiece = in_array($piece->getRightSideNumber(), $this->possibleCombinations, true);
        $foundLeftPiece = in_array($piece->getLeftSideNumber(), $this->possibleCombinations, true);

        return $foundLeftPiece || $foundRightPiece;
    }

    /**
     * Returns player first piece, used to start the game
     *
     * @return PieceInterface
     */
    public function getFirstPiece(): PieceInterface
    {
        $pieceKey = array_rand($this->handPieces);
        $piece = $this->handPieces[$pieceKey];
        unset($this->handPieces[$pieceKey]);

        $this->say('Gaming starting with ' . $piece->toString());

        return $piece;
    }

    /**
     * Fits piece on board
     * @todo: refactor giving more time.
     * @param PieceInterface $piece
     */
    public function putPieceOnBoard(PieceInterface $piece): void
    {
        $board = $this->board;
        $boardPieces = $board->getPlayerPieces();
        $boardLeftEndPiece = $board->getLastLeftPiece();
        $boardRightEndPiece = $board->getLastRightPiece();
        $playerPieceNumbers = [$piece->getRightSideNumber(), $piece->getLeftSideNumber()];

        $foundPlaceOnBoardLeftEnd = in_array($boardLeftEndPiece->getLeftSideNumber(), $playerPieceNumbers, true);
        if ($foundPlaceOnBoardLeftEnd) {
            if ($boardLeftEndPiece->getLeftSideNumber() !== $piece->getRightSideNumber()) {
                $piece->turn();
            }

            $connectedPiece = array_shift($boardPieces);
            $this->board->addPieceLeftEnd($piece);
        } else {
            if ($boardRightEndPiece->getRightSideNumber() !== $piece->getLeftSideNumber()) {
                $piece->turn();
            }

            $connectedPiece = end($boardPieces);
            $this->board->addPieceRightEnd($piece);
        }

        $this->say($this->name . ' will play ' . $piece->toString() . ' connecting with ' . $connectedPiece->toString());

        $boardState = array_map(
            static function ($piece): string {
                return $piece->toString();
            }, $this->board->getPlayerPieces()
        );

        $text = implode(" ", $boardState);

        $this->say('Board now is ' . $text);
    }

    /**
     * Returns player hand count
     *
     * @return int
     */
    public function getHandCount(): int
    {
        return count($this->handPieces);
    }


    /**
     * Assert if player is out of pieces
     *
     * @return bool
     */
    public function isGameEnd(): bool
    {
        if (count($this->handPieces) === 0) {
            return true;
        }

        return false;
    }

    /**
     * Print to buffer
     *
     * @param $text
     */
    public function say($text): void
    {
        echo $text . PHP_EOL;
    }

    /**
     * Player won the game!
     *
     */
    public function iWon(): void
    {
        $this->say($this->name . ' Won!');
    }

    /**
     * Players draw
     *
     * @param $sameHandCountPlayerName
     */
    public function aDraw(string $sameHandCountPlayerName): void
    {
        $sameHandCountPlayerName === $this->name ?
            $this->iWon() :
            $this->say(
                'We ' . $sameHandCountPlayerName . ' and ' . $this->name .
                ' Won! a draw with ' . $this->getHandCount() . ' pieces.'
            );
    }
}