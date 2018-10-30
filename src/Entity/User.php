<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $bnet_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bnet_sub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bnet_battletag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bnet_access_token;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBnetId(): ?int
    {
        return $this->bnet_id;
    }

    public function setBnetId(int $bnet_id): self
    {
        $this->bnet_id = $bnet_id;

        return $this;
    }

    public function getBnetSub(): ?string
    {
        return $this->bnet_sub;
    }

    public function setBnetSub(string $bnet_sub): self
    {
        $this->bnet_sub = $bnet_sub;

        return $this;
    }

    public function getBnetBattletag(): ?string
    {
        return $this->bnet_battletag;
    }

    public function setBnetBattletag(string $bnet_battletag): self
    {
        $this->bnet_battletag = $bnet_battletag;

        return $this;
    }

    public function getBnetAccessToken(): ?string
    {
        return $this->bnet_access_token;
    }

    public function setBnetAccessToken(string $bnet_access_token): self
    {
        $this->bnet_access_token = $bnet_access_token;

        return $this;
    }
}
