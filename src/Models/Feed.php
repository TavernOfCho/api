<?php

namespace App\Models;

use ApiPlatform\Core\Annotation\ApiProperty;

class Feed
{
    /**
     * @ApiProperty(identifier=true)
     * @var string $type
     */
    private $type;

    /**
     * @var \DateTimeInterface $date
     */
    private $date;

    /**
     * @var Achievement $achievement
     */
    private $achievement;

    /**
     * @var bool $featOfStrength
     */
    private $featOfStrength;

    /**
     * @var array $criteria
     */
    private $criteria;

    /**
     * @var string $character
     */
    private $character;

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Feed
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Feed
     */
    public function setDate($date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Achievement
     */
    public function getAchievement(): ?Achievement
    {
        return $this->achievement;
    }

    /**
     * @param $achievement
     * @return Feed
     */
    public function setAchievement(Achievement $achievement): self
    {
        $this->achievement = $achievement;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getFeatOfStrength(): ?bool
    {
        return $this->featOfStrength;
    }

    /**
     * @param bool $featOfStrength
     * @return Feed
     */
    public function setFeatOfStrength(bool $featOfStrength): self
    {
        $this->featOfStrength = $featOfStrength;

        return $this;
    }

    /**
     * @return array
     */
    public function getCriteria(): ?array
    {
        return $this->criteria;
    }

    /**
     * @param $criteria
     * @return Feed
     */
    public function setCriteria(array $criteria): self
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacter(): ?string
    {
        return $this->character;
    }

    /**
     * @param string $character
     * @return Feed
     */
    public function setCharacter(string $character): self
    {
        $this->character = $character;

        return $this;
    }
}
