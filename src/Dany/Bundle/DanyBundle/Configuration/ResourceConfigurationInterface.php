<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface ResourceConfigurationInterface
{
    /**
     * @return ModelConfigurationInterface
     */
    public function getModelConfiguration() : ModelConfigurationInterface;

    /**
     * @return ListenerConfigurationInterface
     */
    public function getListenerConfiguration() : ListenerConfigurationInterface;

    /**
     * @return FlowConfigurationInterface
     */
    public function getFlowConfiguration() : FlowConfigurationInterface;

    /**
     * @return bool
     */
    public function hasModelConfiguration() : bool;

    /**
     * @return bool
     */
    public function hasListenerConfiguration() : bool;

    /**
     * @return bool
     */
    public function hasFlowConfiguration() : bool;
}