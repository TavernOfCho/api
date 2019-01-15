<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bnet_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bnet_sub;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bnet_battletag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bnet_access_token;

    /**
     * @ORM\Column(name="enabled", type="boolean", options={"default" : true})
     */
    private $enabled = true;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string $plainPassword
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $email_enabled = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getBnetId(): ?int
    {
        return $this->bnet_id;
    }

    /**
     * @param int $bnet_id
     * @return User
     */
    public function setBnetId(int $bnet_id): self
    {
        $this->bnet_id = $bnet_id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBnetSub(): ?string
    {
        return $this->bnet_sub;
    }

    /**
     * @param string $bnet_sub
     * @return User
     */
    public function setBnetSub(string $bnet_sub): self
    {
        $this->bnet_sub = $bnet_sub;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBnetBattletag(): ?string
    {
        return $this->bnet_battletag;
    }

    /**
     * @param string $bnet_battletag
     * @return User
     */
    public function setBnetBattletag(string $bnet_battletag): self
    {
        $this->bnet_battletag = $bnet_battletag;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBnetAccessToken(): ?string
    {
        return $this->bnet_access_token;
    }

    /**
     * @param string $bnet_access_token
     * @return User
     */
    public function setBnetAccessToken(string $bnet_access_token): self
    {
        $this->bnet_access_token = $bnet_access_token;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return User
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return array The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getEmailEnabled(): ?bool
    {
        return $this->email_enabled;
    }

    /**
     * @param bool $email_enabled
     * @return User
     */
    public function setEmailEnabled(bool $email_enabled): self
    {
        $this->email_enabled = $email_enabled;

        return $this;
    }
}
