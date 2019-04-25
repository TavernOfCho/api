<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"achievement_group_read"}},
 *     denormalizationContext={"groups"={"achievement_group_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AchievementGroupRepository")
 */
class AchievementGroup
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Groups({"achievement_group_write", "achievement_group_read"})
     */
    private $name;

    /**
     * @var array
     * @ORM\Column(type="array")
     * @Groups({"achievement_group_write", "achievement_group_read"})
     */
    private $achievements = [];

    /**
     * @var array
     * @Groups({"achievement_group_read"})
     */
    private $achievementsDetails = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="completedAchievementGroup")
     */
    private $users;

    /**
     * AchievementGroup constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AchievementGroup
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAchievements(): ?array
    {
        return $this->achievements;
    }

    /**
     * @param array $achievements
     * @return AchievementGroup
     */
    public function setAchievements(array $achievements): self
    {
        $this->achievements = $achievements;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAchievementsDetails(): ?array
    {
        return $this->achievementsDetails;
    }

    /**
     * @param array $achievementsDetails
     * @return AchievementGroup
     */
    public function setAchievementsDetails(array $achievementsDetails): self
    {
        $this->achievementsDetails = $achievementsDetails;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return AchievementGroup
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addCompletedAchievementGroup($this);
        }

        return $this;
    }

    /**
     * @param User $user
     * @return AchievementGroup
     */
    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeCompletedAchievementGroup($this);
        }

        return $this;
    }
}
