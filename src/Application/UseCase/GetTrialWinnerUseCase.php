<?php

namespace GCappello\LobbyWars\Application\UseCase;

use Exception;
use GCappello\LobbyWars\Domain\Contract;

class GetTrialWinnerUseCase
{
    public const PLAINTIFF = 'Plaintiff';
    public const DEFENDANT = 'Defendant';

    /**
     * @param Contract $contract
     * @return string
     * @throws Exception
     */
    public function execute(Contract $contract): string
    {
        $plaintiffPoints = $contract->plaintiffPoints();
        $defendantPoints = $contract->defendantPoints();

        if ($plaintiffPoints == $defendantPoints) {
            throw new Exception();
        }

        return ($plaintiffPoints > $defendantPoints) ? self::PLAINTIFF : self::DEFENDANT;
    }
}
