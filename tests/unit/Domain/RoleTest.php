<?php

namespace GCappello\LobbyWarsTest\unit\Domain;

use GCappello\LobbyWars\Domain\Role;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{
    public function testGivenValidParamWhenConstructThenObjectIsCreated(): void
    {
        $role = new Role(Role::KING);

        $this->assertEquals(Role::KING, $role->name());
        $this->assertEquals(5, $role->points());
    }

    public function testGivenInvalidParamWhenConstructThenExceptionThrown(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Role('Judge');
    }
}
