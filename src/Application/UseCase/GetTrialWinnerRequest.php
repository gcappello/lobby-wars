<?php

namespace GCappello\LobbyWars\Application\UseCase;

use GCappello\LobbyWars\Domain\Contract;

class GetTrialWinnerRequest
{
    /** @var Contract */
    private $contract;

    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    public function contract(): Contract
    {
        return $this->contract;
    }
}
