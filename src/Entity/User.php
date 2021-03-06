<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user_read"}},
 *     denormalizationContext={"groups"={"user_write"}},
 *     itemOperations={
 *         "get",
 *         "put"={"access_control"="is_granted('user_update', object)"},
 *         "delete"={"access_control"="is_granted('user_delete', object)"},
 *     }
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
     * @ORM\Column(type="json_array", nullable=true)
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
    private $bnetSub;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $bnetId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $bnetBattletag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $bnetAccessToken;

    /**
     * @ORM\Column(type="boolean", options={"default" : false})
     * @Groups({"user_write", "user_read"})
     */
    private $enabled = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $enabledCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     * @Groups({"user_write", "user_read"})
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     * @Groups({"user_write", "user_read"})
     */
    private $emailEnabled = true;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AchievementGroup", inversedBy="users")
     */
    private $completedAchievementGroup;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $enabledCodeDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="sender")
     */
    private $sendedMessages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="receiver")
     */
    private $receivedMessages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $locale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $server;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_write", "user_read"})
     */
    private $character;

    public function __construct()
    {
        $this->completedAchievementGroup = new ArrayCollection();
        $this->sendedMessages = new ArrayCollection();
        $this->receivedMessages = new ArrayCollection();
    }

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
        return $this->bnetSub;
    }

    public function setBnetSub(?string $bnetSub): self
    {
        $this->bnetSub = $bnetSub;

        return $this;
    }

    public function getBnetId(): ?int
    {
        return $this->bnetId;
    }

    public function setBnetId(?int $bnetId): self
    {
        $this->bnetId = $bnetId;

        return $this;
    }

    public function getBnetBattletag(): ?string
    {
        return $this->bnetBattletag;
    }

    public function setBnetBattletag(?string $bnetBattletag): self
    {
        $this->bnetBattletag = $bnetBattletag;

        return $this;
    }

    public function getBnetAccessToken(): ?string
    {
        return $this->bnetAccessToken;
    }

    public function setBnetAccessToken(string $bnetAccessToken): self
    {
        $this->bnetAccessToken = $bnetAccessToken;

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

    public function getEnabledCode(): ?string
    {
        return $this->enabledCode;
    }

    public function setEnabledCode(?string $enabledCode): self
    {
        $this->enabledCode = $enabledCode;

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
        return $this->emailEnabled;
    }

    public function setEmailEnabled(bool $emailEnabled): self
    {
        $this->emailEnabled = $emailEnabled;

        return $this;
    }

    /**
     * @return Collection|AchievementGroup[]
     */
    public function getCompletedAchievementGroup(): Collection
    {
        return $this->completedAchievementGroup;
    }

    public function addCompletedAchievementGroup(AchievementGroup $completedAchievementGroup): self
    {
        if (!$this->completedAchievementGroup->contains($completedAchievementGroup)) {
            $this->completedAchievementGroup[] = $completedAchievementGroup;
        }

        return $this;
    }

    public function removeCompletedAchievementGroup(AchievementGroup $completedAchievementGroup): self
    {
        if ($this->completedAchievementGroup->contains($completedAchievementGroup)) {
            $this->completedAchievementGroup->removeElement($completedAchievementGroup);
        }

        return $this;
    }

    public function getEnabledCodeDate(): ?\DateTime
    {
        return $this->enabledCodeDate;
    }

    public function setEnabledCodeDate(?\DateTime $enabledCodeDate): self
    {
        $this->enabledCodeDate = $enabledCodeDate;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getSendedMessages(): Collection
    {
        return $this->sendedMessages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->sendedMessages->contains($message)) {
            $this->sendedMessages[] = $message;
            $message->setSender($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->sendedMessages->contains($message)) {
            $this->sendedMessages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getSender() === $this) {
                $message->setSender(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getUsername();
    }

    /**
     * @return Collection|Message[]
     */
    public function getReceivedMessages(): Collection
    {
        return $this->receivedMessages;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getServer(): ?string
    {
        return $this->server;
    }

    public function setServer(?string $server): self
    {
        $this->server = $server;

        return $this;
    }

    public function getCharacter(): ?string
    {
        return $this->character;
    }

    public function setCharacter(?string $character): self
    {
        $this->character = $character;

        return $this;
    }
}
