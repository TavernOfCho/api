<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class Guild
{
    /**
     * @ApiProperty(identifier=true)
     * @var string $name
     */
    private $name;

    /**
     * @var string $realm
     */
    private $realm;

    /**
     * @var string $battlegroup
     */
    private $battlegroup;

    /**
     * @var int $members
     */
    private $members;

    /**
     * @var int $achievementPoints
     */
    private $achievementPoints;

    /**
     * @var array $emblem
     */
    private $emblem;

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Guild
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getRealm(): ?string
    {
        return $this->realm;
    }

    /**
     * @param string $realm
     * @return Guild
     */
    public function setRealm(string $realm): self
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBattlegroup(): ?string
    {
        return $this->battlegroup;
    }

    /**
     * @param string $battlegroup
     * @return Guild
     */
    public function setBattlegroup(string $battlegroup): self
    {
        $this->battlegroup = $battlegroup;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMembers(): ?int
    {
        return $this->members;
    }

    /**
     * @param int $members
     * @return Guild
     */
    public function setMembers(int $members): self
    {
        $this->members = $members;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAchievementPoints(): ?int
    {
        return $this->achievementPoints;
    }

    /**
     * @param int $achievementPoints
     * @return Guild
     */
    public function setAchievementPoints(int $achievementPoints): self
    {
        $this->achievementPoints = $achievementPoints;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmblem()
    {
        return $this->emblem;
    }

    /**
     * @param $emblem
     * @return Guild
     */
    public function setEmblem($emblem): self
    {
        $this->emblem = $emblem;

        return $this;
    }
}
