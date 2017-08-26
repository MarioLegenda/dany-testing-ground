<?php

namespace Dany\Bundle\DanyBundle\Configuration;

class ModelConfiguration implements ModelConfigurationInterface
{
    /**
     * @var string $modelNamespace
     */
    private $modelNamespace;
    /**
     * ModelConfiguration constructor.
     * @param string $modelNamespace
     */
    public function __construct(string $modelNamespace)
    {
        $this->modelNamespace = $modelNamespace;
    }
    /**
     * @inheritdoc
     */
    public function getModel(): string
    {
        return $this->modelNamespace;
    }
}