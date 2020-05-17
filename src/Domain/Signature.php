<?php

namespace GCappello\LobbyWars\Domain;

class Signature
{
    /** @var Role */
    private $role;
    /** @var int */
    private $points;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->points = $role->points();
    }

    public function role(): Role
    {
        return $this->role;
    }

    public function points(): int
    {
        return $this->points;
    }

    public function invalidatePoints(): void
    {
        $this->points = 0;
    }
}
