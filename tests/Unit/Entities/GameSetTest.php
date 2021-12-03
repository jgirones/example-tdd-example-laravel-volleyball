<?php

namespace Tests\Unit\Entities;

use App\Entities\GameSet;
use InvalidArgumentException;
use Tests\TestCase;

class GameSetTest extends TestCase
{
    public function test_create_valid_first_quarter_game_set_with_first_team_score(): void
    {
        $gameSet = new GameSet(number: 1, firstTeamScore: 25, secondTeamScore: 0);
        $this->assertSame(1, $gameSet->getNumber());
        $this->assertSame(25, $gameSet->getFirstTeamScore());
        $this->assertSame(0, $gameSet->getSecondTeamScore());
        $this->assertTrue($gameSet->isFirstTeamWinner());
        $this->assertFalse($gameSet->isSecondTeamWinner());
    }

    public function test_create_valid_first_quarter_game_set_with_first_team_extended_score(): void
    {
        $gameSet = new GameSet(number: 1, firstTeamScore: 28, secondTeamScore: 26);
        $this->assertSame(1, $gameSet->getNumber());
        $this->assertSame(28, $gameSet->getFirstTeamScore());
        $this->assertSame(26, $gameSet->getSecondTeamScore());
        $this->assertTrue($gameSet->isFirstTeamWinner());
        $this->assertFalse($gameSet->isSecondTeamWinner());
    }

    public function test_create_valid_first_quarter_game_set_with_second_team_score(): void
    {
        $gameSet = new GameSet(number: 1, firstTeamScore: 0, secondTeamScore: 25);
        $this->assertSame(1, $gameSet->getNumber());
        $this->assertSame(0, $gameSet->getFirstTeamScore());
        $this->assertSame(25, $gameSet->getSecondTeamScore());
        $this->assertFalse($gameSet->isFirstTeamWinner());
        $this->assertTrue($gameSet->isSecondTeamWinner());
    }

    public function test_create_valid_first_quarter_game_set_with_second_extended_score(): void
    {
        $gameSet = new GameSet(number: 1, firstTeamScore: 26, secondTeamScore: 28);
        $this->assertSame(1, $gameSet->getNumber());
        $this->assertSame(26, $gameSet->getFirstTeamScore());
        $this->assertSame(28, $gameSet->getSecondTeamScore());
        $this->assertFalse($gameSet->isFirstTeamWinner());
        $this->assertTrue($gameSet->isSecondTeamWinner());
    }

    public function test_create_valid_fifth_quarter_game_set_with_first_team_score(): void
    {
        $gameSet = new GameSet(number: 5, firstTeamScore: 15, secondTeamScore: 0);
        $this->assertSame(5, $gameSet->getNumber());
        $this->assertSame(15, $gameSet->getFirstTeamScore());
        $this->assertSame(0, $gameSet->getSecondTeamScore());
        $this->assertTrue($gameSet->isFirstTeamWinner());
        $this->assertFalse($gameSet->isSecondTeamWinner());
    }

    public function test_create_valid_fifth_quarter_game_set_with_first_team_extended_score(): void
    {
        $gameSet = new GameSet(number: 5, firstTeamScore: 17, secondTeamScore: 15);
        $this->assertSame(5, $gameSet->getNumber());
        $this->assertSame(17, $gameSet->getFirstTeamScore());
        $this->assertSame(15, $gameSet->getSecondTeamScore());
        $this->assertTrue($gameSet->isFirstTeamWinner());
        $this->assertFalse($gameSet->isSecondTeamWinner());
    }

    public function test_create_valid_fifth_quarter_game_set_with_second_team_score(): void
    {
        $gameSet = new GameSet(number: 5, firstTeamScore: 0, secondTeamScore: 15);
        $this->assertSame(5, $gameSet->getNumber());
        $this->assertSame(0, $gameSet->getFirstTeamScore());
        $this->assertSame(15, $gameSet->getSecondTeamScore());
        $this->assertFalse($gameSet->isFirstTeamWinner());
        $this->assertTrue($gameSet->isSecondTeamWinner());
    }

    public function test_create_valid_fifth_quarter_game_set_with_second_team_extended_score(): void
    {
        $gameSet = new GameSet(number: 5, firstTeamScore: 15, secondTeamScore: 17);
        $this->assertSame(5, $gameSet->getNumber());
        $this->assertSame(15, $gameSet->getFirstTeamScore());
        $this->assertSame(17, $gameSet->getSecondTeamScore());
        $this->assertFalse($gameSet->isFirstTeamWinner());
        $this->assertTrue($gameSet->isSecondTeamWinner());
    }

    public function test_fails_first_quarter_game_set_with_first_team_negative_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(499);
        new GameSet(number: 1, firstTeamScore: -1, secondTeamScore: 0);
    }

    public function test_fails_first_quarter_game_set_with_first_team_overflow_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(504);
        new GameSet(number: 1, firstTeamScore: 27, secondTeamScore: 0);
    }

    public function test_fails_first_quarter_game_set_with_second_team_negative_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(498);
        new GameSet(number: 1, firstTeamScore: 0, secondTeamScore: -1);
    }

    public function test_fails_first_quarter_game_set_with_second_team_overflow_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(505);
        new GameSet(number: 1, firstTeamScore: 0, secondTeamScore: 27);
    }


    public function test_fails_fifth_quarter_game_set_with_first_team_negative_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(499);
        new GameSet(number: 5, firstTeamScore: -1, secondTeamScore: 0);
    }

    public function test_fails_fifth_quarter_game_set_with_first_team_overflow_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(506);
        new GameSet(number: 5, firstTeamScore: 17, secondTeamScore: 0);
    }

    public function test_fails_fifth_quarter_game_set_with_second_team_negative_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(498);
        new GameSet(number: 5, firstTeamScore: 0, secondTeamScore: -1);
    }

    public function test_fails_fifth_quarter_game_set_with_second_team_overflow_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(507);
        new GameSet(number: 5, firstTeamScore: 0, secondTeamScore: 17);
    }

    public function test_fails_number_negative(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(500);
        new GameSet(number: -1, firstTeamScore: 25, secondTeamScore: 0);
    }

    public function test_fails_number_overflow(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(501);
        new GameSet(number: 7, firstTeamScore: 25, secondTeamScore: 0);
    }

    public function test_fails_first_quarter_invalid_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(502);
        new GameSet(number: 1, firstTeamScore: 23, secondTeamScore: 12);
    }

    public function test_fails_fifth_quarter_invalid_score(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(503);
        new GameSet(number: 5, firstTeamScore: 12, secondTeamScore: 7);
    }


}