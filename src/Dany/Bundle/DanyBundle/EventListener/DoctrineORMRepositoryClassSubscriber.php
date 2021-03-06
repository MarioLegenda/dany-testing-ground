<?php

namespace Dany\Bundle\DanyBundle\EventListener;

use Dany\Bundle\DanyBundle\Configuration\ModelConfigurationInterface;
use Dany\Bundle\DanyBundle\Configuration\ResourceSearchProviderInterface;
use Dany\Bundle\DanyBundle\Repository\DanyEntityRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineORMRepositoryClassSubscriber implements EventSubscriber
{
    /**
     * @var ResourceSearchProviderInterface $resourceCollection
     */
    private $resourceProvider;
    /**
     * DoctrineORMRepositoryClassSubscriber constructor.
     * @param ResourceSearchProviderInterface $resourceProvider
     */
    public function __construct(ResourceSearchProviderInterface $resourceProvider)
    {
        $this->resourceProvider = $resourceProvider;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            Events::loadClassMetadata,
        ];
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $this->setRepositoryClass($eventArgs->getClassMetadata());
    }

    private function setRepositoryClass(ClassMetadata $metadata)
    {
        $modelConfiguration = $this->resourceProvider->findByModelName($metadata->getName());

        if ($modelConfiguration instanceof ModelConfigurationInterface) {
            $metadata->setCustomRepositoryClass(DanyEntityRepository::class);
        }
    }
}