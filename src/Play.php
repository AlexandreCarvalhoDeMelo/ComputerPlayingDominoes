<?php
declare(strict_types=1);

namespace Dominoes;

use Dominoes\Interfaces\Board as BoardInterface;

/**
 * Class Play
 *
 * @Author   Alexandre Melo <alexandre.carvalho.melo@gmail.com>
 * @package  Dominoes
 * @category assessent
 * @link     none
 */
class Play
{
    public const MIN_PLAYER_NUMBER = 2;
    public const MAX_PLAYER_NUMBER = 4;

    /**
     * @var array<Player>
     */
    public $players = [];

    /**
     * @var bool
     */
    protected $gameIsNotFinished = true;

    /**
     * @param array<string> $playerNamesList
     * @param Board         $board
     */
    public function __construct(array $playerNamesList, Board $board)
    {
        if ($this->validatePlayerList($playerNamesList)) {
            $this->assemblePlayersList($playerNamesList, $board);
            $this->runGameOn($board);
        }
    }

    /**
     * Game state controller
     * My idea here was let the game as close to a real
     * Table game as possible, with most of the actions being
     * Taken by the player and some by the game rules
     * For the easiness of maintenance, most of the
     * critical game code runs here, with all the
     * important abstractions being interfaced and decoupled
     * I completely understand that all the transformations/decorations
     * Through out the program could be different classes following more close with SOLID
     * But this is done given a short time frame
     *
     * @param Board $board
     */
    private function runGameOn(Board $board): void
    {
        $gameFirstPiece = $this->players[0]->getFirstPiece();

        $board->startGame($gameFirstPiece);

        $smallestPieceCountPlayer = [];
        $playersOutCount = 0;
        while ($this->gameIsNotFinished) {
            foreach ($this->players as $player) {

                if ($gameFirstPiece) {
                    $gameFirstPiece = false;
                    continue;
                }

                if ($player->isGameEnd()) {
                    $player->iWon();
                    $this->gameIsNotFinished = false;
                    break;
                }

                $player->lookAtBoard($board);

                $piece = $player->searchCompatiblePiece() ?? $player->requestMatchingPieceFromBoard();

                $noMorePiecesForPlayer = is_null($piece);

                if ($noMorePiecesForPlayer) {
                    $playerName = $player->name;
                    $playerHandCount = $player->getHandCount();

                    if (empty($smallestPieceCountPlayer)) {
                        $smallestPieceCountPlayer = $this->assemblePossibleWinner($playerName, $playerHandCount);
                        continue;
                    }

                    $currentPlayerPieceCountIsLower =
                        $playerHandCount < $smallestPieceCountPlayer[Player::FIELD_PLAYER_HAND_COUNT];

                    if ($currentPlayerPieceCountIsLower) {
                        $smallestPieceCountPlayer = $this->assemblePossibleWinner($playerName, $playerHandCount);
                    }

                    $allPlayersAreOutGameShouldEnd = $playersOutCount === count($this->players);
                    if ($allPlayersAreOutGameShouldEnd) {
                        if ($currentPlayerPieceCountIsLower) {
                            $player->iWon();
                            $this->gameIsNotFinished = false;
                            break;
                        }

                        $smallestPieceCountPlayerName = $smallestPieceCountPlayer[Player::FIELD_PLAYER_NAME];
                        $player->aDraw($smallestPieceCountPlayerName);
                        $this->gameIsNotFinished = false;
                        break;
                    }

                    $playersOutCount++;
                    continue;
                }

                $player->putPieceOnBoard($piece);
            }
        }
    }


    /**
     * Transforms the list from names to objects
     * Also distributes each player pieces
     *
     * @param array<string>  $playerNames
     * @param BoardInterface $board
     */
    private function assemblePlayersList(array $playerNames, BoardInterface $board): void
    {
        foreach ($playerNames as $playerName) {
            $this->players[] = new Player($playerName, $board->getPiecesFromStack(7));
        }

        shuffle($this->players);
    }

    /**
     * Transforms possible winner data
     *
     * @param  string $name
     * @param  int    $handCount
     * @return array<string>
     */
    private function assemblePossibleWinner(string $name, int $handCount): array
    {
        return [
            Player::FIELD_PLAYER_NAME => $name,
            Player::FIELD_PLAYER_HAND_COUNT => $handCount
        ];
    }

    /**
     * Validates player list
     *
     * @param  array $playerNameList
     * @return bool
     */
    private function validatePlayerList(array $playerNameList): bool
    {
        $isValid = true;
        $totalPlayers = count($playerNameList);
        if ($totalPlayers > self::MAX_PLAYER_NUMBER || $totalPlayers < self::MIN_PLAYER_NUMBER) {
            echo "Hey, minimal number os players is two, maximum number of players is four : )\r\n";
            $isValid = false;
        }

        $allPlayersHaveDifferentNames = count(array_unique($playerNameList)) === count($playerNameList);
        if (!$allPlayersHaveDifferentNames) {
            echo "Hey, All players must have different names : )\r\n";
            $isValid = false;
        }

        return $isValid;
    }

}