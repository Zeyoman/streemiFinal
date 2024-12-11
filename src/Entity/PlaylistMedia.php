<?php

namespace App\Entity;

use App\Repository\PlaylistMediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistMediaRepository::class)]
class PlaylistMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $addedAt = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\ManyToMany(targetEntity: Media::class, inversedBy: 'playlistMedia')]
    private Collection $mediaId;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\ManyToMany(targetEntity: Playlist::class, inversedBy: 'playlistMedia')]
    private Collection $playlistId;

    public function __construct()
    {
        $this->mediaId = new ArrayCollection();
        $this->playlistId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): static
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMediaId(): Collection
    {
        return $this->mediaId;
    }

    public function addMediaId(Media $mediaId): static
    {
        if (!$this->mediaId->contains($mediaId)) {
            $this->mediaId->add($mediaId);
        }

        return $this;
    }

    public function removeMediaId(Media $mediaId): static
    {
        $this->mediaId->removeElement($mediaId);

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
}
