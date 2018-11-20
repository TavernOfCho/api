<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 */
class Character
{
    const ALLOWED_FIELDS = [
        'achievements',
        'appearance',
        'feed',
        'guild',
        'hunterPets',
        'items',
        'mounts',
        'pets',
        'petSlots',
        'professions',
        'progression',
        'pvp',
        'quests',
        'reputation',
        'statistics',
        'stats',
        'talents',
        'titles',
        'audit',
    ];

    /**
     * @var \DateTime $lastModified
     */
    private $lastModified;

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
     * @var int $class
     */
    private $class;

    /**
     * @var int $race
     */
    private $race;

    /**
     * @var int $gender
     */
    private $gender;

    /**
     * @var int $level
     */
    private $level;

    /**
     * @var int $achievementPoints
     */
    private $achievementPoints;

    /**
     * @var string $thumbail
     */
    private $thumbail;

    /**
     * @var string $calcClass
     */
    private $calcClass;

    /**
     * @var int $faction
     */
    private $faction;

    /**
     * @var int $totalHonorableKills
     */
    private $totalHonorableKills;

    /**
     * @var ArrayCollection $achievements
     */
    private $achievements;

    /**
     * Character constructor.
     */
    public function __construct()
    {
        $this->achievements = new ArrayCollection();
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->lastModified;
    }

    /**
     * @param \DateTimeInterface|int $lastModified
     * @return Character
     */
    public function setLastModified($lastModified): self
    {
        if (!$lastModified instanceof \DateTimeInterface) {
            $lastModified = (new \DateTime())->setTimestamp($lastModified);
        }

        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Character
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
     * @return Character
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
     * @return Character
     */
    public function setBattlegroup(string $battlegroup): self
    {
        $this->battlegroup = $battlegroup;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getClass(): ?int
    {
        return $this->class;
    }

    /**
     * @param int $class
     * @return Character
     */
    public function setClass(int $class): self
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRace(): ?int
    {
        return $this->race;
    }

    /**
     * @param int $race
     * @return Character
     */
    public function setRace(int $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     * @return Character
     */
    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return Character
     */
    public function setLevel(int $level): self
    {
        $this->level = $level;

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
     * @return Character
     */
    public function setAchievementPoints(int $achievementPoints): self
    {
        $this->achievementPoints = $achievementPoints;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getThumbail(): ?string
    {
        return $this->thumbail;
    }

    /**
     * @param string $thumbail
     * @return Character
     */
    public function setThumbail(string $thumbail): self
    {
        $this->thumbail = $thumbail;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCalcClass(): ?string
    {
        return $this->calcClass;
    }

    /**
     * @param string $calcClass
     * @return Character
     */
    public function setCalcClass(string $calcClass): self
    {
        $this->calcClass = $calcClass;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFaction(): ?int
    {
        return $this->faction;
    }

    /**
     * @param int $faction
     * @return Character
     */
    public function setFaction(int $faction): self
    {
        $this->faction = $faction;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTotalHonorableKills(): ?int
    {
        return $this->totalHonorableKills;
    }

    /**
     * @param int $totalHonorableKills
     * @return Character
     */
    public function setTotalHonorableKills(int $totalHonorableKills): self
    {
        $this->totalHonorableKills = $totalHonorableKills;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAchievements(): ?ArrayCollection
    {
        return $this->achievements;
    }

    /**
     * @param ArrayCollection $achievements
     * @return Character
     */
    public function setAchievements(ArrayCollection $achievements): self
    {
        $this->achievements = $achievements;

        return $this;
    }
}
