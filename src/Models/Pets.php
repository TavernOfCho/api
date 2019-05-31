<?php


namespace App\Models;


use ApiPlatform\Core\Annotation\ApiProperty;

class Pets
{
    /**
     * @ApiProperty(identifier=true)
     * @var string
     */
    private $name;

    /**
     * @var int $numCollected
     */
    private $numCollected;

    /**
     * @var int $numNotCollected
     */
    private $numNotCollected;

    /**
     * @var array $collected
     */
    private $collected;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Pets
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumCollected(): ?int
    {
        return $this->numCollected;
    }

    /**
     * @param int $numCollected
     * @return Pets
     */
    public function setNumCollected(?int $numCollected): self
    {
        $this->numCollected = $numCollected;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumNotCollected(): ?int
    {
        return $this->numNotCollected;
    }

    /**
     * @param int $numNotCollected
     * @return Pets
     */
    public function setNumNotCollected(?int $numNotCollected): self
    {
        $this->numNotCollected = $numNotCollected;

        return $this;
    }

    /**
     * @return array
     */
    public function getCollected(): ?array
    {
        return $this->collected;
    }

    /**
     * @param array $collected
     * @return Pets
     */
    public function setCollected(?array $collected): self
    {
        $this->collected = $collected;

        return $this;
    }
}
