<?php

namespace GCappello\LobbyWars\Application\UseCase;

use GCappello\LobbyWars\Domain\Contract;
use GCappello\LobbyWars\Domain\Role;

class GetMinimumTrialWinnerFunctionRequest
{
    /** @var Contract */
    private $contract;
    /** @var Role[] */
    private $currentPartySigners;

    /**
     * @param Role[] $currentPartySigners
     * @param Role[] $oppositionPartySigners
     */
    public function __construct(array $currentPartySigners, array $oppositionPartySigners)
    {
        $this->contract = new Contract($currentPartySigners, $oppositionPartySigners);
        $this->currentPartySigners = $currentPartySigners;
    }

    public function contract(): Contract
    {
        return $this->contract;
    }

    /**
     * @return Role[]
     */
    public function currentPartySigners(): array
    {
        return $this->currentPartySigners;
    }
}
