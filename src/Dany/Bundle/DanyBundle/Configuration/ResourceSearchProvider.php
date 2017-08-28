<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class ResourceSearchProvider extends ResourceConfigurationCollection implements ResourceSearchProviderInterface
{
    /**
     * @inheritdoc
     */
    public function findByModelName(string $modelNamespace)
    {
        foreach ($this->all() as $resource) {
            if ($resource->getModelConfiguration()->getModel() === $modelNamespace) {
                return $resource->getModelConfiguration();
            }
        }

        return null;
    }
}