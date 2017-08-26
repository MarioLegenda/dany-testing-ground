<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface ListenerConfigurationInterface
{
    /**
     * Returns a list of listener services
     *
     * @return array
     */
    public function getListenerServices() : array;
}