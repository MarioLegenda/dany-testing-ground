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
    /**
     * @inheritdoc
     */
    public function serialize(array $resources, string $format) : string
    {
        return $this->serializer->serialize($resources, $format);
    }
}