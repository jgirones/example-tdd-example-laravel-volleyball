<?php

namespace App\Entities;

use InvalidArgumentException;

class Game
{

    public function __construct(private array $sets)
    {
        $setsCount = count($sets);
        if ($setsCount < 3) {
            throw new InvalidArgumentException('Count of `Sets` was wrong (' . $setsCount . ')', 449);
        }

        if ($setsCount > 5) {
            throw new InvalidArgumentException('Count of `Sets` was wrong (' . $setsCount . ')', 550);
        }

        if ($this->getFirstTeamWins() === $this->getSecondTeamWins()) {
            throw new InvalidArgumentException('First team and second team wins the same number of sets', 551);
        }

        $this->sets = collect($sets)->sort(function (GameSet $gameSetA, GameSet $gameSetB) {
            if ($gameSetA->getNumber() > $gameSetB->getNumber()) {
                return true;
            }
            return false;
        })->all();

        $repeatSets = collect($this->sets)->map(fn(GameSet $set) => $set->getNumber())->duplicates()->count();
        if ($repeatSets > 0) {
            throw new InvalidArgumentException('`Sets` was repeat', 552);
        }

        if ($this->getFirstTeamWins(3) >= 3 && count($this->sets) > 3) {
            throw new InvalidArgumentException('`Sets` score has unnecessary for first team and third game', 553);
        }

        if ($this->getFirstTeamWins(4) === 3 && count($this->sets) > 4) {
            throw new InvalidArgumentException('`Sets` score has unnecessary for first team and fifth game', 554);
        }

        if ($this->getSecondTeamWins(3) >= 3 && count($this->sets) > 3) {
            throw new InvalidArgumentException('`Sets` score has unnecessary for second team and third game', 555);
        }

        if ($this->getSecondTeamWins(4) === 3 && count($this->sets) > 4) {
            throw new InvalidArgumentException('`Sets` score has unnecessary for second team and fifth game', 556);
        }
    }

    public function getSetsCount(): int
    {
        return count($this->sets);
    }

    private function getFirstTeamWins($maxGameSetNumber = 5): int
    {
        return collect($this->sets)
            ->filter(fn(GameSet $set) => $set->getNumber() <= $maxGameSetNumber)
            ->filter(fn(GameSet $set) => $set->isFirstTeamWinner())->count();
    }

    private function getSecondTeamWins($maxGameSetNumber = 5): int
    {
        return collect($this->sets)
            ->filter(fn(GameSet $set) => $set->getNumber() <= $maxGameSetNumber)
            ->filter(fn(GameSet $set) => $set->isSecondTeamWinner())->count();
    }

    public function isFirstTeamWinner(): bool
    {
        return $this->getFirstTeamWins() > $this->getSecondTeamWins();
    }

    public function isSecondTeamWinner(): bool
    {
        return $this->getFirstTeamWins() < $this->getSecondTeamWins();;
    }
}