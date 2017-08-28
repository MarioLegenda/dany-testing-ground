<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Bundle\DanyBundle\Model\DanyResource;

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
        $this->validate($modelNamespace);

        $this->modelNamespace = $modelNamespace;
    }
    /**
     * @inheritdoc
     */
    public function getModel(): string
    {
        return $this->modelNamespace;
    }

    private function validate(string $modelNamespace)
    {
        $interfaces = class_implements($modelNamespace);
        $interface = DanyResource::class;

        if (!in_array($interface, $interfaces)) {
            throw new \RuntimeException(
                sprintf(
                    'Invalid dany entity. Entity \'%s\' has to implement \'%s\'',
                    $modelNamespace,
                    $interface
                )
            );
        }
    }
}