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
     * @var ResponseConfigurationInterface $responseConfiguration
     */
    private $responseConfiguration;
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
     * @param ResponseConfigurationInterface $responseConfiguration
     * @param ListenerConfigurationInterface $listenerConfiguration
     * @param FlowConfigurationInterface $flowConfiguration
     */
    public function __construct(
        string $name,
        ModelConfigurationInterface $modelConfiguration,
        RoutingConfigurationInterface $routingConfiguration,
        ResponseConfigurationInterface $responseConfiguration,
        ListenerConfigurationInterface $listenerConfiguration = null,
        FlowConfigurationInterface $flowConfiguration = null
    ) {
        $this->name = $name;
        $this->modelConfiguration = $modelConfiguration;
        $this->routingConfiguration = $routingConfiguration;
        $this->responseConfiguration = $responseConfiguration;
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
                sprintf('Internal error: Flow configuration request when there is none. Please, post an issue on Github')
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
                sprintf('Internal error: Listener configuration request when there is none. Please, post an issue on Github')
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
                sprintf('Internal error: Model configuration request when there is none. Please, post an issue on Github')
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
                sprintf('Internal error: Routing configuration request when there is none. Please, post an issue on Github')
            );
        }

        return $this->routingConfiguration;
    }
    /**
     * @inheritdoc
     */
    public function getResponseConfiguration() : ResponseConfigurationInterface
    {
        if (!$this->hasResponseConfiguration()) {
            throw new \RuntimeException(
                sprintf('Internal error: Response configuration request when there is none. Please, post an issue on Github')
            );
        }

        return $this->responseConfiguration;
    }
    /**
     * @inheritdoc
     */
    public function hasResponseConfiguration() : bool
    {
        return $this->responseConfiguration instanceof ResponseConfigurationInterface;
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