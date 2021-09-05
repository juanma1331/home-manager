<?php

namespace App\Entity;

use App\Entity\Traits\NameTrait;
use App\Entity\Traits\UuidTrait;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Inventory
{
    use UuidTrait;

    use NameTrait;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="inventory", orphanRemoval=true)
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setInventory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getInventory() === $this) {
                $product->setInventory(null);
            }
        }

        return $this;
    }

}
