<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     mercure="true",
 *     attributes={"order"={"id": "DESC"}, "filters"={"message.order_filter"}},
 *     normalizationContext={"groups"={"message_read", "user_read"}},
 *     denormalizationContext={"groups"={"message_write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"message_write", "message_read"})
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="sendedMessages")
     * @ORM\JoinColumn(name="sender", referencedColumnName="id", onDelete="SET NULL")
     * @Groups({"message_write", "message_read", "user_read"})
     */
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="receivedMessages")
     * @ORM\JoinColumn(name="receiver", referencedColumnName="id", onDelete="SET NULL")
     * @Groups({"message_write", "message_read"})
     */
    private $receiver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return User|null
     * @Groups({"message_write", "message_read", "user_read"})
     */
    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    public function setReceiver(?User $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }
}
