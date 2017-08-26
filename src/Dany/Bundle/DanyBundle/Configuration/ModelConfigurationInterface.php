<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface ModelConfigurationInterface
{
    /**
     * Returns the model namespace string
     *
     * @return string
     */
    public function getModel() : string;
}