<?php

namespace GCappello\LobbyWars\Domain;

use InvalidArgumentException;

class Role
{
    public const KING = 'King';
    public const NOTARY = 'Notary';
    public const VALIDATOR = 'Validator';
    public const EMPTY = 'Empty';

    private const ROLE_POINTS = [
        self::KING => 5,
        self::NOTARY => 2,
        self::VALIDATOR => 1,
        self::EMPTY => 0,
    ];

    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->guardAgainstInvalidName($name);
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function points(): int
    {
        return self::ROLE_POINTS[$this->name];
    }

    private function guardAgainstInvalidName(string $name): void
    {
        if (!array_key_exists($name, self::ROLE_POINTS)) {
            throw new InvalidArgumentException('Invalid Role name');
        }
    }

    public function isKing(): bool
    {
        return $this->name === Role::KING;
    }

    public function isEmpty(): bool
    {
        return $this->name === Role::EMPTY;
    }

    public function isValidator()
    {
        return $this->name === Role::VALIDATOR;
    }
}
