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

    /**
     * @return Collection<int, hardSkill>
     */
    public function gethardSkills(): Collection
    {
        return $this->hardSkills;
    }

    public function addhardSkill(HardSkill $hardSkill): static
    {
        if (!$this->hardSkills->contains($hardSkill)) {
            $this->hardSkills->add($hardSkill);
            $hardSkill->setCategory($this);
        }

        return $this;
    }

    public function removehardSkill(HardSkill $hardSkill): static
    {
        if ($this->hardSkills->removeElement($hardSkill)) {
            // set the owning side to null (unless already changed)
            if ($hardSkill->getCategory() === $this) {
                $hardSkill->setCategory(null);
            }
        }

        return $this;
    }
}
