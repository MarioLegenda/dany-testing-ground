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
     * @return RoutingConfigurationInterface
     */
    public function getRoutingConfiguration() : RoutingConfigurationInterface;
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
    /**
     * @return bool
     */
    public function hasRoutingConfiguration() : bool;
}