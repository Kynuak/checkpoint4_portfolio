<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[Vich\Uploadable] 
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

    #[Vich\UploadableField(mapping: 'project_image', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\ManyToMany(targetEntity: HardSkill::class, inversedBy: 'projects')]
    private Collection $hardSkills;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DatetimeInterface $updatedAt = null;

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

    public function setImage(?string $image): static
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

    public function removeHardSkills(HardSkill $hardSkills): static
    {
        $this->hardSkills->removeElement($hardSkills);

        return $this;
    }

    public function setImageFile(File $image = null): Project
    {
        $this->imageFile = $image;
        if ($image) {
          $this->updatedAt = new DateTime('now');
        }
    
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

        /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
