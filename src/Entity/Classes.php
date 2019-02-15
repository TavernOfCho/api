<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class Classes
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
     * @var string $powerType
     */
    private $powerType;

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
    public function getPowerType(): ?string
    {
        return $this->powerType;
    }

    /**
     * @param string $powerType
     * @return self
     */
    public function setPowerType(?string $powerType): self
    {
        $this->powerType = $powerType;

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
