<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $urlGithub = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlProd = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 300)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: HarkSkill::class, inversedBy: 'projects')]
    private Collection $harkSill;

    public function __construct()
    {
        $this->harkSill = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getUrlGithub(): ?string
    {
        return $this->urlGithub;
    }

    public function setUrlGithub(string $urlGithub): static
    {
        $this->urlGithub = $urlGithub;

        return $this;
    }

    public function getUrlProd(): ?string
    {
        return $this->urlProd;
    }

    public function setUrlProd(?string $urlProd): static
    {
        $this->urlProd = $urlProd;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, HarkSkill>
     */
    public function getHarkSill(): Collection
    {
        return $this->harkSill;
    }

    public function addHarkSill(HarkSkill $harkSill): static
    {
        if (!$this->harkSill->contains($harkSill)) {
            $this->harkSill->add($harkSill);
        }

        return $this;
    }

    public function removeHarkSill(HarkSkill $harkSill): static
    {
        $this->harkSill->removeElement($harkSill);

        return $this;
    }
}
