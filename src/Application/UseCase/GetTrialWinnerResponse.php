<?php

namespace GCappello\LobbyWars\Application\UseCase;

class GetTrialWinnerResponse
{
    /** @var string */
    private $winner;

    public function __construct(string $winner)
    {
        $this->winner = $winner;
    }

    public function winner(): string
    {
        return $this->winner;
    }
}
