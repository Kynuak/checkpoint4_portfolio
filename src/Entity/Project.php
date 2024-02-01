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

    #[ORM\ManyToMany(targetEntity: HardSkill::class, inversedBy: 'projects')]
    private Collection $hardSkills;

    public function __construct()
    {
        $this->hardSkills = new ArrayCollection();
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
    public function getHardSkills(): Collection
    {
        return $this->hardSkills;
    }

    public function addHardSkills(HardSkill $hardSkills): static
    {
        if (!$this->hardSkills->contains($hardSkills)) {
            $this->hardSkills->add($hardSkills);
        }

        return $this;
    }

    public function removeHardSills(HardSkill $hardSkills): static
    {
        $this->hardSkills->removeElement($hardSkills);

        return $this;
    }
}
