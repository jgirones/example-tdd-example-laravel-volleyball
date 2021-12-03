<?php

namespace Tests\Unit\Entities;

use App\Entities\Game;
use App\Entities\GameSet;
use InvalidArgumentException;
use Tests\TestCase;

class GameTest extends TestCase
{
    public function test_create_valid_first_team_with_minimum_sets(): void
    {
        $game = new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 25, 20),
                new GameSet(3, 25, 20)
            ]
        );

        $this->assertSame(3, $game->getSetsCount());
        $this->assertTrue($game->isFirstTeamWinner());
        $this->assertFalse($game->isSecondTeamWinner());
    }

    public function test_create_valid_first_team_with_maximum_sets(): void
    {
        $game = new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 20, 25),
                new GameSet(3, 25, 20),
                new GameSet(4, 20, 25),
                new GameSet(5, 15, 13),
            ]
        );

        $this->assertSame(5, $game->getSetsCount());
        $this->assertTrue($game->isFirstTeamWinner());
        $this->assertFalse($game->isSecondTeamWinner());
    }

    public function test_create_valid_first_team_with_sets(): void
    {
        $game = new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 25, 20),
                new GameSet(3, 21, 25),
                new GameSet(4, 25, 20)
            ]
        );

        $this->assertSame(4, $game->getSetsCount());
        $this->assertTrue($game->isFirstTeamWinner());
        $this->assertFalse($game->isSecondTeamWinner());
    }

    public function test_create_valid_second_team_with_minimum_sets(): void
    {
        $game = new Game(
            [
                new GameSet(1, 25, 27),
                new GameSet(2, 25, 27),
                new GameSet(3, 25, 27),
            ]
        );

        $this->assertSame(3, $game->getSetsCount());
        $this->assertTrue($game->isSecondTeamWinner());
        $this->assertFalse($game->isFirstTeamWinner());
    }

    public function test_create_valid_second_team_with_maximum_sets(): void
    {
        $game = new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 20, 25),
                new GameSet(3, 25, 20),
                new GameSet(4, 20, 25),
                new GameSet(5, 15, 13),
            ]
        );

        $this->assertSame(5, $game->getSetsCount());
        $this->assertTrue($game->isFirstTeamWinner());
        $this->assertFalse($game->isSecondTeamWinner());
    }

    public function test_create_valid_second_team_with_sets(): void
    {
        $game = new Game(
            [
                new GameSet(1, 25, 27),
                new GameSet(2, 25, 27),
                new GameSet(3, 27, 25),
                new GameSet(4, 25, 27)
            ]
        );

        $this->assertSame(4, $game->getSetsCount());
        $this->assertTrue($game->isSecondTeamWinner());
        $this->assertFalse($game->isFirstTeamWinner());
    }

    public function test_create_fails_teams_with_same_wins(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 25, 20),
                new GameSet(3, 20, 25),
                new GameSet(4, 20, 25)
            ]
        );
    }

    public function test_create_fails_teams_with_unnecessary_3win_4set_last_scored(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 25, 20),
                new GameSet(3, 25, 20),
                new GameSet(4, 20, 25)
            ]
        );
    }

    public function test_create_fails_teams_with_unnecessary_3win_4set_middle_scored(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 25, 20),
                new GameSet(3, 25, 20),
                new GameSet(4, 20, 25)
            ]
        );
    }

    public function test_create_fails_teams_with_repeat_sets_scored(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(2, 25, 20),
                new GameSet(3, 25, 20),
                new GameSet(3, 20, 25)
            ]
        );
    }

    public function test_create_valid_teams_with_unsorted_scored(): void
    {
        $game = new Game(
            [
                new GameSet(1, 25, 20),
                new GameSet(4, 25, 20),
                new GameSet(3, 25, 20),
                new GameSet(2, 20, 25)
            ]
        );
        $this->assertTrue($game->isFirstTeamWinner());
        $this->assertFalse($game->isSecondTeamWinner());
    }
}