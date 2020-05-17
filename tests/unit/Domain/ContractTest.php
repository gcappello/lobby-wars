<?php

namespace GCappello\LobbyWarsTest\unit\Domain;

use GCappello\LobbyWars\Domain\Contract;
use GCappello\LobbyWars\Domain\Role;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ContractTest extends TestCase
{
    public function testGivenKingAndValidatorSignaturesInSamePartyWhenSignThenValidatorSignatureHasNoValue(): void
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

    public function testGivenMoreThanOneEmptySignatureWhenConstructThenExceptionThrown(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $empty = new Role(Role::EMPTY);
        $validator = new Role(Role::VALIDATOR);

        new Contract([$validator, $empty, $empty,], [$validator]);
    }
}
