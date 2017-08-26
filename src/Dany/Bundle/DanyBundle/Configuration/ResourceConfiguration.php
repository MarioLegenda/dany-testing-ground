<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class ResourceConfiguration implements ResourceConfigurationInterface
{
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
     * ResourceConfiguration constructor.
     * @param ModelConfigurationInterface $modelConfiguration
     * @param ListenerConfigurationInterface $listenerConfiguration
     * @param FlowConfigurationInterface $flowConfiguration
     */
    public function __construct(
        ModelConfigurationInterface $modelConfiguration,
        ListenerConfigurationInterface $listenerConfiguration = null,
        FlowConfigurationInterface $flowConfiguration = null
    ) {
        $this->modelConfiguration = $modelConfiguration;
        $this->listenerConfiguration = $listenerConfiguration;
        $this->flowConfiguration = $flowConfiguration;
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
        if (!$this->hasFlowConfiguration()) {
            throw new \RuntimeException(
                sprintf('Model configuration request when there is none')
            );
        }

        return $this->modelConfiguration;
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
}