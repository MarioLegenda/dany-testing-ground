<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface FlowConfigurationInterface
{
    /**
     * Returns a list of flow services
     *
     * @return array
     */
    public function getFlowServices() : array;
}