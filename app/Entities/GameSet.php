<?php

namespace App\Entities;

use InvalidArgumentException;

class GameSet
{


    /**
     * @param int $number
     * @param int $firstTeamScore
     * @param int $secondTeamScore
     */
    public function __construct(private int $number, private int $firstTeamScore, private int $secondTeamScore)
    {
        if ($this->number <= 0 || $this->number > 5) {
            throw new InvalidArgumentException('Set `number` was wrong');
        }

        if ($number !== 5 && $this->firstTeamScore < 25 && $this->secondTeamScore < 25) {
            throw new InvalidArgumentException('Set `score` was wrong');
        }

        if ($number === 5 && $this->firstTeamScore < 15 && $this->secondTeamScore < 15) {
            throw new InvalidArgumentException('Set `score` was wrong');
        }

        if ($number !== 5 && $this->firstTeamScore > 25 && $this->firstTeamScore > $this->secondTeamScore && ($this->firstTeamScore - $this->secondTeamScore) > 2) {
            throw new InvalidArgumentException('Set `score` was wrong. (first quarter overflow in `firstTeamScore`)');
        }

        if ($number !== 5 && $this->secondTeamScore > 25 && $this->secondTeamScore > $this->firstTeamScore && ($this->secondTeamScore - $this->firstTeamScore) > 2) {
            throw new InvalidArgumentException('Set `score` was wrong. (first quarter overflow in `secondTeamScore`)');
        }

        if ($number === 5 && $this->firstTeamScore > 15 && $this->firstTeamScore > $this->secondTeamScore && ($this->firstTeamScore - $this->secondTeamScore) > 2) {
            throw new InvalidArgumentException('Set `score` was wrong. (fifth quarter overflow in `firstTeamScore`)');
        }

        if ($number === 5 && $this->secondTeamScore > 15 && $this->secondTeamScore > $this->firstTeamScore && ($this->secondTeamScore - $this->firstTeamScore) > 2) {
            throw new InvalidArgumentException('Set `score` was wrong. (fifth quarter overflow in `secondTeamScore`)');
        }
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return int
     */
    public function getFirstTeamScore(): int
    {
        return $this->firstTeamScore;
    }

    /**
     * @return int
     */
    public function getSecondTeamScore(): int
    {
        return $this->secondTeamScore;
    }

    /**
     * @return bool
     */
    public function isFirstTeamWinner(): bool
    {
        return $this->firstTeamScore > $this->secondTeamScore;
    }

    /**
     * @return bool
     */
    public function isSecondTeamWinner(): bool
    {
        return $this->secondTeamScore > $this->firstTeamScore;
    }
}