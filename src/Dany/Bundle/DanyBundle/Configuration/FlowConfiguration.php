<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class FlowConfiguration implements FlowConfigurationInterface
{
    /**
     * @var array $flowServices
     */
    private $flowServices;
    /**
     * FlowConfiguration constructor.
     * @param array $flowServices
     */
    public function __construct(array $flowServices)
    {
        $this->flowServices = $flowServices;
    }

    /**
     * @inheritdoc
     */
    public function getFlowServices(): array
    {
        return $this->flowServices;
    }
}