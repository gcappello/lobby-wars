<?php

namespace GCappello\LobbyWars\Application\UseCase;

use Exception;

class GetTrialWinnerUseCase
{
    public const PLAINTIFF = 'Plaintiff';
    public const DEFENDANT = 'Defendant';

    /**
     * @param GetTrialWinnerRequest $request
     * @return GetTrialWinnerResponse
     * @throws Exception
     */
    public function execute(GetTrialWinnerRequest $request): GetTrialWinnerResponse
    {
        $plaintiffPoints = $request->contract()->plaintiffPoints();
        $defendantPoints = $request->contract()->defendantPoints();

        if ($plaintiffPoints === $defendantPoints) {
            throw new Exception('Trial has no winner');
        }

        $winner = ($plaintiffPoints > $defendantPoints) ? self::PLAINTIFF : self::DEFENDANT;

        return new GetTrialWinnerResponse($winner);
    }
}
