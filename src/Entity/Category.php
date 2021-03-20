<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ItemCategory", mappedBy="category", cascade={"persist"}, orphanRemoval=true)
     *
     * @var Collection<int, ItemCategory>
     */
    private $itemCategories;

    public function __construct()
    {
        $this->itemCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ItemCategory[]
     */
    public function getItemCategories(): Collection
    {
        return $this->itemCategories;
    }

    public function addItemCategory(ItemCategory $itemCategory): self
    {
        if (!$this->itemCategories->contains($itemCategory)) {
            $this->itemCategories[] = $itemCategory;
            $itemCategory->setCategory($this);
        }

        return $this;
    }

    public function removeItemCategory(ItemCategory $itemCategory): self
    {
        if ($this->itemCategories->removeElement($itemCategory)) {
            // set the owning side to null (unless already changed)
            if ($itemCategory->getCategory() === $this) {
                $itemCategory->setCategory(null);
            }
        }

        return $this;
    }
}
