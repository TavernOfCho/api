<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class Race
{
    /**
     * @ApiProperty(identifier=true)
     * @var int $id
     */
    private $id;

    /**
     * @var int $mask
     */
    private $mask;

    /**
     * @var string $side
     */
    private $side;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getMask(): ?int
    {
        return $this->mask;
    }

    /**
     * @param int $mask
     * @return self
     */
    public function setMask(?int $mask): self
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * @return string
     */
    public function getSide(): ?string
    {
        return $this->side;
    }

    /**
     * @param string $side
     * @return self
     */
    public function setSide(?string $side): self
    {
        $this->side = $side;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
