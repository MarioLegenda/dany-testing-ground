<?php

namespace Dany\Bundle\DanyBundle\Handler;

interface SerializationHandlerInterface
{
    /**
     * @param array $resources
     * @return string
     */
    public function serialize(array $resources) : string;
}