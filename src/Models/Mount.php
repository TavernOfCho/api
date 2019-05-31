<?php

namespace App\Models;

use ApiPlatform\Core\Annotation\ApiProperty;

class Mount
{
    /**
     * @ApiProperty(identifier=true)
     * @var string
     */
    private $name;

    /**
     * @var int $spellId
     */
    private $spellId;

    /**
     * @var int $creatureId
     */
    private $creatureId;

    /**
     * @var int $itemId
     */
    private $itemId;

    /**
     * @var int $qualityId
     */
    private $qualityId;

    /**
     * @var string $icon
     */
    private $icon;

    /**
     * @var boolean $isGround
     */
    private $isGround;

    /**
     * @var boolean $isFlying
     */
    private $isFlying;

    /**
     * @var boolean $isAquatic
     */
    private $isAquatic;

    /**
     * @var boolean $isJumping
     */
    private $isJumping;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Mount
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getSpellId(): ?int
    {
        return $this->spellId;
    }

    /**
     * @param int $spellId
     * @return Mount
     */
    public function setSpellId(?int $spellId): Mount
    {
        $this->spellId = $spellId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatureId(): ?int
    {
        return $this->creatureId;
    }

    /**
     * @param int $creatureId
     * @return Mount
     */
    public function setCreatureId(?int $creatureId): Mount
    {
        $this->creatureId = $creatureId;

        return $this;
    }

    /**
     * @return int
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @param int $itemId
     * @return Mount
     */
    public function setItemId(?int $itemId): Mount
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * @return int
     */
    public function getQualityId(): ?int
    {
        return $this->qualityId;
    }

    /**
     * @param int $qualityId
     * @return Mount
     */
    public function setQualityId(?int $qualityId): Mount
    {
        $this->qualityId = $qualityId;

        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return Mount
     */
    public function setIcon(?string $icon): Mount
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return bool
     */
    public function isGround(): ?bool
    {
        return $this->isGround;
    }

    /**
     * @param bool $isGround
     * @return Mount
     */
    public function setIsGround(?bool $isGround): Mount
    {
        $this->isGround = $isGround;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFlying(): ?bool
    {
        return $this->isFlying;
    }

    /**
     * @param bool $isFlying
     * @return Mount
     */
    public function setIsFlying(?bool $isFlying): Mount
    {
        $this->isFlying = $isFlying;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAquatic(): ?bool
    {
        return $this->isAquatic;
    }

    /**
     * @param bool $isAquatic
     * @return Mount
     */
    public function setIsAquatic(?bool $isAquatic): Mount
    {
        $this->isAquatic = $isAquatic;

        return $this;
    }

    /**
     * @return bool
     */
    public function isJumping(): ?bool
    {
        return $this->isJumping;
    }

    /**
     * @param bool $isJumping
     * @return Mount
     */
    public function setIsJumping(?bool $isJumping): Mount
    {
        $this->isJumping = $isJumping;

        return $this;
    }

}
