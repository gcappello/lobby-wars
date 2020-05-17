<?php

namespace GCappello\LobbyWars\Domain;

use InvalidArgumentException;

class Contract
{
    /** @var int */
    private $plaintiffPoints;
    /** @var int */
    private $defendantPoints;

    /**
     * @param Role[] $plaintiffSigners
     * @param Role[] $defendantSigners
     */
    public function __construct(array $plaintiffSigners, array $defendantSigners)
    {
        $this->plaintiffPoints = $this->calculatePoints($plaintiffSigners);
        $this->defendantPoints = $this->calculatePoints($defendantSigners);
    }

    public function plaintiffPoints(): int
    {
        return $this->plaintiffPoints;
    }

    public function defendantPoints(): int
    {
        return $this->defendantPoints;
    }

    /**
     * @param Role[] $roles
     * @return array
     */
    private static function generateSignatures(array $roles): array
    {
        usort($roles, function (Role $a, Role $b) {
            return $a->points() < $b->points();
        });

        $signatures = [];
        $kingSignature = false;
        $emptySignature = false;
        foreach ($roles as $role) {
            if ($emptySignature && $role->isEmpty()) {
                throw new InvalidArgumentException('Only one empty signature per party allowed');
            }

            $signature = new Signature($role);
            if ($kingSignature && $role->isValidator()) {
                $signature->invalidatePoints();
            }
            $signatures[] = $signature;

            if ($role->isKing()) {
                $kingSignature = true;
            }

            if ($role->isEmpty()) {
                $emptySignature = true;
            }
        }

        return $signatures;
    }

    public static function calculatePoints(array $roles): int
    {
        $signatures = self::generateSignatures($roles);

        $total = 0;
        foreach ($signatures as $signature) {
            $total += $signature->points();
        }

        return $total;
    }
}
