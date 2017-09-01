<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface ResourceHolderInterface
{
    /**
     * @param \Dany\Bundle\DanyBundle\Configuration\ResourceConfigurationInterface $resource
     * @return mixed
     */
    public function setResource(ResourceConfigurationInterface $resource);
    /**
     * @return ResourceConfigurationInterface
     */
    public function getResource() : ResourceConfigurationInterface;
    /**
     * @return bool
     */
    public function hasResource() : bool;
}