<?php

namespace App\Entity;

use App\Repository\ItemCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemCategoryRepository::class)
 */
class ItemCategory
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Item", inversedBy="itemCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item = null;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="itemCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category = null;

    /**
     * @ORM\Column(type="integer")
     */
    private $position = null;

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

}
