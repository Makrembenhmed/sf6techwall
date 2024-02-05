<?php

namespace App\Traits;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
trait TimeStampTrait
{
    #[Column(type: "datetime", nullable: true)]
    private $createdAt;

    #[Column(type: "datetime", nullable: true)]
    private $updatedAt;

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }
}