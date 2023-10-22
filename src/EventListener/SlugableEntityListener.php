<?php

namespace App\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use App\Entity\Interface\SlugableInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[AsDoctrineListener(event: Events::postPersist, priority: 500, connection: 'default')]
#[AsDoctrineListener(event: Events::postUpdate, priority: 500, connection: 'default')]
class SlugableEntityListener
{

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof SlugableInterface) {
            return;
        }

        $entity->slugify();
        // persist the data
        $em = $args->getObjectManager();
        $em->persist($entity);
        $em->flush();

    }


    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof SlugableInterface) {
            return;
        }

        $entity->slugify();

        $em = $args->getObjectManager();
        $em->persist($entity);
        $em->flush();
    }
}
