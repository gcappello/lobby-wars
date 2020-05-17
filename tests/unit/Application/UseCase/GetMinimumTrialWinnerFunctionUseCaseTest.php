<?php

namespace GCappello\LobbyWarsTest\unit\Application\UseCase;

use Exception;
use GCappello\LobbyWars\Application\UseCase\GetMinimumTrialWinnerFunctionRequest;
use GCappello\LobbyWars\Application\UseCase\GetMinimumTrialWinnerFunctionUseCase;
use GCappello\LobbyWars\Domain\Role;
use PHPUnit\Framework\TestCase;

class GetMinimumTrialWinnerFunctionUseCaseTest extends TestCase
{
    public function testGivenContractWithAnEmptySignWhenExecuteThenNotaryRoleReturned(): void
    {
        $useCase = new GetMinimumTrialWinnerFunctionUseCase();

        $empty = new Role(Role::EMPTY);
        $validator = new Role(Role::VALIDATOR);
        $notary = new Role(Role::NOTARY);

        $plaintiffSigners = [
            $notary,
            $empty,
            $validator,
        ];
        $defendantSigners = [
            $notary,
            $validator,
            $validator,
        ];

        $request = new GetMinimumTrialWinnerFunctionRequest($plaintiffSigners, $defendantSigners);

        $response = $useCase->execute($request);

        $this->assertEquals(Role::NOTARY, $response->role()->name());
    }

    public function testGivenContractWithAnEmptySignWhenExecuteThenKingRoleReturned(): void
    {
        $useCase = new GetMinimumTrialWinnerFunctionUseCase();

        $empty = new Role(Role::EMPTY);
        $validator = new Role(Role::VALIDATOR);
        $notary = new Role(Role::NOTARY);
        $king = new Role(Role::KING);

        $plaintiffSigners = [
            $king,
            $empty,
            $validator,
        ];
        $defendantSigners = [
            $king,
            $notary,
            $validator,
        ];

        $request = new GetMinimumTrialWinnerFunctionRequest($plaintiffSigners, $defendantSigners);

        $response = $useCase->execute($request);

        $this->assertEquals(Role::KING, $response->role()->name());
    }

    public function testGivenContractWithAnEmptySignWhenExecuteThenExceptionThrown(): void
    {
        $this->expectException(Exception::class);

        $useCase = new GetMinimumTrialWinnerFunctionUseCase();

        $empty = new Role(Role::EMPTY);
        $notary = new Role(Role::NOTARY);
        $king = new Role(Role::KING);

        $plaintiffSigners = [
            $notary,
            $empty,
        ];
        $defendantSigners = [
            $notary,
            $king,
        ];

        $request = new GetMinimumTrialWinnerFunctionRequest($plaintiffSigners, $defendantSigners);

        $useCase->execute($request);
    }
}
