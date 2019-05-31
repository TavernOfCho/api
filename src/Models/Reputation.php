<?php

namespace App\Models;

class Reputation
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var int $standing
     */
    private $standing;

    /**
     * @var int $value
     */
    private $value;

    /**
     * @var int $max
     */
    private $max;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Reputation
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

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
     * @return Reputation
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getStanding(): ?int
    {
        return $this->standing;
    }

    /**
     * @param int $standing
     * @return Reputation
     */
    public function setStanding(?int $standing): self
    {
        $this->standing = $standing;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Reputation
     */
    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return Reputation
     */
    public function setMax(?int $max): self
    {
        $this->max = $max;

        return $this;
    }
}
