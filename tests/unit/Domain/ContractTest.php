<?php

namespace GCappello\LobbyWarsTest\unit\Domain;

use GCappello\LobbyWars\Domain\Contract;
use GCappello\LobbyWars\Domain\Role;
use PHPUnit\Framework\TestCase;

class ContractTest extends TestCase
{
    public function testGivenKingAndValidatorSignaturesInSamePartyWhenSignedThenValidatorSignatureHasNoValue(): void
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
            $king,
            $validator,
        ];

        $defendantPoints = $notary->points() + $king->points();

        $contract = new Contract($plaintiffSigners, $defendantSigners);

        $this->assertEquals($defendantPoints, $contract->defendantPoints());
    }
}
