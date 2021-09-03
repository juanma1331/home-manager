<?php

namespace App\EventListener;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Subcategory;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class SlugListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Category ||
            $entity instanceof Product ||
            $entity instanceof Subcategory) {
            $slug = strtolower($this->slugger->slug($entity->getName()));
            $entity->setSlug($slug);
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Category ||
            $entity instanceof Product ||
            $entity instanceof Subcategory) {
            $slug = strtolower($this->slugger->slug($entity->getName()));
            $entity->setSlug($slug);
        }
    }
}