<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class ResponseConfiguration implements ResponseConfigurationInterface
{
    /**
     * @var string $format
     */
    private $format;
    /**
     * ResponseConfiguration constructor.
     * @param array $responseConfig
     */
    public function __construct(array $responseConfig)
    {
        $this->format = $responseConfig['format'];
    }
    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }
}