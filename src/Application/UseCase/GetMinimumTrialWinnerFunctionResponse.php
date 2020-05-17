<?php

namespace GCappello\LobbyWars\Application\UseCase;

use GCappello\LobbyWars\Domain\Role;

class GetMinimumTrialWinnerFunctionResponse
{
    /** @var Role */
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function role(): Role
    {
        return $this->role;
    }
}
