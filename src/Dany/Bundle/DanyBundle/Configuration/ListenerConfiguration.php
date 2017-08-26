<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class ListenerConfiguration implements ListenerConfigurationInterface
{
    /**
     * @var array $listenerServices
     */
    private $listenerServices;

    /**
     * ListenerConfiguration constructor.
     * @param array $listenerServices
     */
    public function __construct(array $listenerServices)
    {
        $this->listenerServices = $listenerServices;
    }

    /**
     * @inheritdoc
     */
    public function getListenerServices(): array
    {
        return $this->listenerServices;
    }
}