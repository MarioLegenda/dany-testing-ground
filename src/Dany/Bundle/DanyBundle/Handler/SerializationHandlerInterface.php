<?php

namespace Dany\Bundle\DanyBundle\Handler;

interface SerializationHandlerInterface
{
    /**
     * @param array $resources
     * @param string $format
     * @return string
     */
    public function serialize(array $resources, string $format) : string;
}