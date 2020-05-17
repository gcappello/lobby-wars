<?php

namespace GCappello\LobbyWars\Domain;

class Contract
{
    /** @var array Signature[] */
    private $plaintiffSigns;
    /** @var array Signature[] */
    private $defendantSigns;

    /**
     * @param Role[] $plaintiffSigners
     * @param Role[] $defendantSigners
     */
    public function __construct(array $plaintiffSigners, array $defendantSigners)
    {
        $this->plaintiffSigns = $this->addSignatures($plaintiffSigners);
        $this->defendantSigns = $this->addSignatures($defendantSigners);
    }

    public function plaintiffPoints(): int
    {
        return $this->calculatePoints($this->plaintiffSigns);
    }

    public function defendantPoints(): int
    {
        return $this->calculatePoints($this->defendantSigns);
    }

    /**
     * @param Role[] $roles
     * @return array
     */
    private function addSignatures(array $roles): array
    {
        usort($roles, function (Role $a, Role $b) {
            return $a->points() < $b->points();
        });

        $signatures = [];
        $kingPresence = false;
        foreach ($roles as $role) {
            $signature = new Signature($role);
            if ($kingPresence && $role->name() == Role::VALIDATOR) {
                $signature->invalidatePoints();
            }
            $signatures[] = $signature;

            if ($role->name() == Role::KING) {
                $kingPresence = true;
            }
        }

        return $signatures;
    }

    /**
     * @param Signature[] $signatures
     * @return int
     */
    private function calculatePoints(array $signatures): int
    {
        $total = 0;
        foreach ($signatures as $signature) {
            $total += $signature->points();
        }

        return $total;
    }
}
