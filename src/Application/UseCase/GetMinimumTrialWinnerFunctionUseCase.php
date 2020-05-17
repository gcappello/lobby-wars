<?php

namespace GCappello\LobbyWars\Application\UseCase;

use Exception;
use GCappello\LobbyWars\Domain\Contract;
use GCappello\LobbyWars\Domain\Role;

class GetMinimumTrialWinnerFunctionUseCase
{
    /**
     * @param GetMinimumTrialWinnerFunctionRequest $request
     * @return GetMinimumTrialWinnerFunctionResponse
     * @throws Exception
     */
    public function execute(GetMinimumTrialWinnerFunctionRequest $request): GetMinimumTrialWinnerFunctionResponse
    {
        $sortedRoles = [
            new Role(Role::VALIDATOR),
            new Role(Role::NOTARY),
            new Role(Role::KING),
        ];

        foreach ($sortedRoles as $role) {
            $minimumPoints = Contract::calculatePoints(array_merge($request->currentPartySigners(), [$role]));
            if ($minimumPoints > $request->contract()->defendantPoints()) {
                return new GetMinimumTrialWinnerFunctionResponse($role);
            }
        }

        throw new Exception('Not enough total points to win');
    }
}
