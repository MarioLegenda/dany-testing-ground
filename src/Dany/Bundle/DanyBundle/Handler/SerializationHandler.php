<?php

namespace Dany\Bundle\DanyBundle\Handler;

use JMS\Serializer\Serializer;

class SerializationHandler implements SerializationHandlerInterface
{
    /**
     * @var Serializer $serializer
     */
    private $serializer;
    /**
     * SerializationHandler constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize(array $resources)
    {
        return $this->serializer->serialize($resources, 'json');
    }
}