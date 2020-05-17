<?php

namespace GCappello\LobbyWarsTest\unit\Domain;

use GCappello\LobbyWars\Domain\Signature;
use GCappello\LobbyWars\Domain\Role;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase
{
    public function testGivenValidParamsWhenGetPointsThenRolePointsReturned(): void
    {
        $role = new Role(Role::KING);
        $signature = new Signature($role);

        $this->assertEquals($role->points(), $signature->points());
    }

    public function testGivenValidSignatureWhenInvalidatePointsThenZeroPointsSet(): void
    {
        $role = new Role(Role::KING);
        $signature = new Signature($role);
        $signature->invalidatePoints();

        $this->assertEquals(0, $signature->points());
    }
}
