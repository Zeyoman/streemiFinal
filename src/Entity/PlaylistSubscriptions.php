<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionsRepository::class)]
class PlaylistSubscriptions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $SubscribedAt = null;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\ManyToMany(targetEntity: Playlist::class, inversedBy: 'playlistSubscriptions')]
    private Collection $playlistId;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\ManyToMany(targetEntity: Users::class, inversedBy: 'playlistSubscriptions')]
    private Collection $userId;

    public function __construct()
    {
        $this->playlistId = new ArrayCollection();
        $this->userId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscribedAt(): ?\DateTimeInterface
    {
        return $this->SubscribedAt;
    }

    public function setSubscribedAt(\DateTimeInterface $SubscribedAt): static
    {
        $this->SubscribedAt = $SubscribedAt;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylistId(): Collection
    {
        return $this->playlistId;
    }

    public function addPlaylistId(Playlist $playlistId): static
    {
        if (!$this->playlistId->contains($playlistId)) {
            $this->playlistId->add($playlistId);
        }

        return $this;
    }

    public function removePlaylistId(Playlist $playlistId): static
    {
        $this->playlistId->removeElement($playlistId);

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(Users $userId): static
    {
        if (!$this->userId->contains($userId)) {
            $this->userId->add($userId);
        }

        return $this;
    }

    public function removeUserId(Users $userId): static
    {
        $this->userId->removeElement($userId);

        return $this;
    }
}
