<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class ResourceConfiguration implements ResourceConfigurationInterface
{
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var RoutingConfigurationInterface $routingConfiguration
     */
    private $routingConfiguration;
    /**
     * @var ModelConfigurationInterface $modelConfiguration
     */
    private $modelConfiguration;

    /**
     * @var ListenerConfigurationInterface $listenerConfiguration
     */
    private $listenerConfiguration;

    /**
     * @var FlowConfigurationInterface $flowConfiguration
     */
    private $flowConfiguration;
    /**
     * @var bool $isCurrent
     */
    private $isCurrent = false;
    /**
     * ResourceConfiguration constructor.
     * @param string $name
     * @param ModelConfigurationInterface $modelConfiguration
     * @param RoutingConfigurationInterface $routingConfiguration
     * @param ListenerConfigurationInterface $listenerConfiguration
     * @param FlowConfigurationInterface $flowConfiguration
     */
    public function __construct(
        string $name,
        ModelConfigurationInterface $modelConfiguration,
        RoutingConfigurationInterface $routingConfiguration,
        ListenerConfigurationInterface $listenerConfiguration = null,
        FlowConfigurationInterface $flowConfiguration = null
    ) {
        $this->name = $name;
        $this->modelConfiguration = $modelConfiguration;
        $this->routingConfiguration = $routingConfiguration;
        $this->listenerConfiguration = $listenerConfiguration;
        $this->flowConfiguration = $flowConfiguration;
    }

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getFlowConfiguration(): FlowConfigurationInterface
    {
        if (!$this->hasFlowConfiguration()) {
            throw new \RuntimeException(
                sprintf('Flow configuration request when there is none')
            );
        }

        return $this->flowConfiguration;
    }

    /**
     * @inheritdoc
     */
    public function getListenerConfiguration(): ListenerConfigurationInterface
    {
        if (!$this->hasFlowConfiguration()) {
            throw new \RuntimeException(
                sprintf('Listener configuration request when there is none')
            );
        }

        return $this->listenerConfiguration;
    }

    /**
     * @inheritdoc
     */
    public function getModelConfiguration(): ModelConfigurationInterface
    {
        if (!$this->hasModelConfiguration()) {
            throw new \RuntimeException(
                sprintf('Model configuration request when there is none')
            );
        }

        return $this->modelConfiguration;
    }

    /**
     * @inheritdoc
     */
    public function getRoutingConfiguration(): RoutingConfigurationInterface
    {
        if (!$this->hasRoutingConfiguration()) {
            throw new \RuntimeException(
                sprintf('Routing configuration request when there is none')
            );
        }

        return $this->routingConfiguration;
    }

    /**
     * @inheritdoc
     */
    public function hasFlowConfiguration(): bool
    {
        return $this->flowConfiguration instanceof FlowConfigurationInterface;
    }

    /**
     * @inheritdoc
     */
    public function hasListenerConfiguration(): bool
    {
        return $this->listenerConfiguration instanceof ListenerConfigurationInterface;
    }

    /**
     * @inheritdoc
     */
    public function hasModelConfiguration(): bool
    {
        return $this->modelConfiguration instanceof ModelConfigurationInterface;
    }

    /**
     * @inheritdoc
     */
    public function hasRoutingConfiguration(): bool
    {
        return $this->routingConfiguration instanceof RoutingConfigurationInterface;
    }
    /**
     * @inheritdoc
     */
    public function markAsCurrent()
    {
        $this->isCurrent = true;
    }
    /**
     * @return bool
     */
    public function isCurrentConfig(): bool
    {
        return $this->isCurrent;
    }
}