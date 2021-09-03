<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private array $productNames = ['Rice Large', 'Tuna', 'Rice Short', 'Milk', 'Beer', 'Yogurt', 'Olives', 'Potatoes'];

    public function load(ObjectManager $manager)
    {

        $foodCategory = new Category();
        $foodCategory->setName('Food');

        foreach ($this->productNames as $productName) {
            $product = new Product();
            $product->setName($productName);
            $foodCategory->addProduct($product);
        }

        $cleaningCategory = new Category();
        $cleaningCategory->setName('Cleaning');

        $manager->persist($foodCategory);
        $manager->persist($cleaningCategory);
        $manager->flush();
    }
}
