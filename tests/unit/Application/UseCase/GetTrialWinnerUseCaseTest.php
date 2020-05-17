<?php

namespace GCappello\LobbyWarsTest\unit\Application\UseCase;

use Exception;
use GCappello\LobbyWars\Application\UseCase\GetTrialWinnerRequest;
use GCappello\LobbyWars\Application\UseCase\GetTrialWinnerUseCase;
use GCappello\LobbyWars\Domain\Contract;
use GCappello\LobbyWars\Domain\Role;
use PHPUnit\Framework\TestCase;

class GetTrialWinnerUseCaseTest extends TestCase
{
    /** @var GetTrialWinnerUseCase */
    private $useCase;

    protected function setUp()
    {
        parent::setUp();
        $this->useCase = new GetTrialWinnerUseCase();
    }

    public function testGivenKNvsNNVContractWhenWinnerRequestedThenPlaintiffReturned(): void
    {
        $notary = new Role(Role::NOTARY);
        $king = new Role(Role::KING);
        $validator = new Role(Role::VALIDATOR);

        $plaintiffSigners = [
            $king,
            $notary,
        ];
        $defendantSigners = [
            $notary,
            $notary,
            $validator,
        ];

        $contract = new Contract($plaintiffSigners, $defendantSigners);
        $request = new GetTrialWinnerRequest($contract);

        $response = $this->useCase->execute($request);

        $this->assertEquals(GetTrialWinnerUseCase::PLAINTIFF, $response->winner());
    }

    public function testGivenAContractWithSamePointsPerPartyWhenWinnerRequestedThenExceptionThrown(): void
    {
        $this->expectException(Exception::class);

        $signers = [
            new Role(Role::NOTARY),
            new Role(Role::VALIDATOR),
        ];

        $contract = new Contract($signers, $signers);
        $request = new GetTrialWinnerRequest($contract);

        $this->useCase->execute($request);
    }
}
