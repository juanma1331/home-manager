<?php

namespace App\Entity;

use App\Entity\Traits\NameTrait;
use App\Entity\Traits\UuidTrait;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    use UuidTrait;

    use NameTrait;

    /**
     * @ORM\ManyToOne(targetEntity=Inventory::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $inventory;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): self
    {
        $this->inventory = $inventory;

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
}
