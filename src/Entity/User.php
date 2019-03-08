<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user_read"}},
 *     denormalizationContext={"groups"={"user_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity("username")
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
     * @var array
     *
     * @ORM\Column(type="json_array")
     * @Groups({"user_write", "user_read"})
     */
    private $roles = ["ROLE_USER"];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
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
     * @Groups({"user_write"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $bnet_sub;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $bnet_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $bnet_battletag;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_write", "user_read"})
     */
    private $bnet_access_token;

    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     * @Groups({"user_write", "user_read"})
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     * @Groups({"user_write", "user_read"})
     */
    private $email_enabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function hasRole(?string $role): ?bool
    {
        return in_array($role, $this->getRoles());
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function removeRole(?string $role): bool
    {
        $key = array_search($role, $this->roles, true);

        if ($key === false) {
            return false;
        }

        unset($this->roles[$key]);

        return true;
    }

    public function addRole(?string $role): self
    {
        $this->roles[] = $role;
        $this->roles = array_unique($this->roles);

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getBnetSub(): ?string
    {
        return $this->bnet_sub;
    }

    public function setBnetSub(?string $bnet_sub): self
    {
        $this->bnet_sub = $bnet_sub;

        return $this;
    }

    public function getBnetId(): ?int
    {
        return $this->bnet_id;
    }

    public function setBnetId(?int $bnet_id): self
    {
        $this->bnet_id = $bnet_id;

        return $this;
    }

    public function getBnetBattletag(): ?string
    {
        return $this->bnet_battletag;
    }

    public function setBnetBattletag(?string $bnet_battletag): self
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

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEmailEnabled(): ?bool
    {
        return $this->email_enabled;
    }

    public function setEmailEnabled(bool $email_enabled): self
    {
        $this->email_enabled = $email_enabled;

        return $this;
    }
}
