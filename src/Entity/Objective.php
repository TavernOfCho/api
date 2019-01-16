<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ObjectiveRepository")
 * @ORM\Table(name="objective")
 */
class Objective
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ending_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $achievement_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $character;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realm;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mail_sent = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $bnet_user;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Objective
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->ending_date;
    }

    /**
     * @param \DateTimeInterface $ending_date
     * @return Objective
     */
    public function setEndingDate(\DateTimeInterface $ending_date): self
    {
        $this->ending_date = $ending_date;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAchievementId(): ?int
    {
        return $this->achievement_id;
    }

    /**
     * @param int $achievement_id
     * @return Objective
     */
    public function setAchievementId(int $achievement_id): self
    {
        $this->achievement_id = $achievement_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCharacter(): ?string
    {
        return $this->character;
    }

    /**
     * @param string $character
     * @return Objective
     */
    public function setCharacter(string $character): self
    {
        $this->character = $character;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRealm(): ?string
    {
        return $this->realm;
    }

    /**
     * @param string $realm
     * @return Objective
     */
    public function setRealm(string $realm): self
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMailSent(): ?bool
    {
        return $this->mail_sent;
    }

    /**
     * @param bool $mail_sent
     * @return Objective
     */
    public function setMailSent(bool $mail_sent): self
    {
        $this->mail_sent = $mail_sent;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getBnetUser(): ?User
    {
        return $this->bnet_user;
    }

    /**
     * @param User|null $bnet_user
     * @return Objective
     */
    public function setBnetUser(?User $bnet_user): self
    {
        $this->bnet_user = $bnet_user;

        return $this;
    }
}
