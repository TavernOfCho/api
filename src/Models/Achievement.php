<?php

namespace App\Models;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class Achievement
{
    /**
     * @ApiProperty(identifier=true)
     * @var int $id
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var int $points
     */
    private $points;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var array $rewardItems
     */
    private $rewardItems;

    /**
     * @var string $icon
     */
    private $icon;

    /**
     * @var array $criteria
     */
    private $criteria;

    /**
     * @var bool $accountWide
     */
    private $accountWide;

    /**
     * @var int $factionId
     */
    private $factionId;

    /**
     * @var \DateTimeInterface $completedAt
     */
    private $completedAt;

    /**
     * @var string $category
     */
    private $category;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Achievement
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Achievement
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPoints(): ?int
    {
        return $this->points;
    }

    /**
     * @param int $points
     * @return Achievement
     */
    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Achievement
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRewardItems()
    {
        return $this->rewardItems;
    }

    /**
     * @param $rewardItems
     * @return Achievement
     */
    public function setRewardItems($rewardItems): self
    {
        $this->rewardItems = $rewardItems;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return Achievement
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param $criteria
     * @return Achievement
     */
    public function setCriteria($criteria): self
    {
        $this->criteria = $criteria;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAccountWide(): ?bool
    {
        return $this->accountWide;
    }

    /**
     * @param bool $accountWide
     * @return Achievement
     */
    public function setAccountWide(bool $accountWide): self
    {
        $this->accountWide = $accountWide;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFactionId(): ?int
    {
        return $this->factionId;
    }

    /**
     * @param int $factionId
     * @return Achievement
     */
    public function setFactionId(int $factionId): self
    {
        $this->factionId = $factionId;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCompletedAt(): ?\DateTimeInterface
    {
        return $this->completedAt;
    }

    /**
     * @param \DateTimeInterface|int $completedAt
     * @return Achievement
     */
    public function setCompletedAt($completedAt): self
    {
        if (!$completedAt instanceof \DateTimeInterface) {
            $completedAt = (new \DateTime())->setTimestamp($completedAt);
        }

        $this->completedAt = $completedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Achievement
     */
    public function setCategory(?string $category): Achievement
    {
        $this->category = $category;

        return $this;
    }


}
