<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: HardSkill::class)]
    private Collection $harkSkills;

    public function __construct()
    {
        $this->harkSkills = new ArrayCollection();
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

    /**
     * @return Collection<int, HarkSkill>
     */
    public function getHarkSkills(): Collection
    {
        return $this->harkSkills;
    }

    public function addHarkSkill(HardSkill $harkSkill): static
    {
        if (!$this->harkSkills->contains($harkSkill)) {
            $this->harkSkills->add($harkSkill);
            $harkSkill->setCategory($this);
        }

        return $this;
    }

    public function removeHarkSkill(HardSkill $harkSkill): static
    {
        if ($this->harkSkills->removeElement($harkSkill)) {
            // set the owning side to null (unless already changed)
            if ($harkSkill->getCategory() === $this) {
                $harkSkill->setCategory(null);
            }
        }

        return $this;
    }
}
