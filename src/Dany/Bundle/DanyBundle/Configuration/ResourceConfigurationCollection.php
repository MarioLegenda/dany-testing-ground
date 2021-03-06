<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Library\BaseLooseCollection;
use Dany\Library\CollectionInterface;

class ResourceConfigurationCollection extends BaseLooseCollection implements ResourceHolderInterface
{
    /**
     * @var ResourceConfigurationInterface $currentResource
     */
    private $currentResource;
    /**
     * @param string $type
     * @param $value
     * @return CollectionInterface
     */
    public function add(string $type, $value): CollectionInterface
    {
        $this->validate($type, $value);

        return parent::add($type, $value);
    }
    /**
     * @param string $type
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function get(string $type)
    {
        if (!$this->has($type)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid collection. This collection does not contain type %s',
                    $type
                )
            );
        }

        return parent::get($type);
    }
    /**
     * @inheritdoc
     */
    public function setResource(ResourceConfigurationInterface $resource)
    {
        $this->currentResource = $resource;
    }
    /**
     * @inheritdoc
     */
    public function getResource() : ResourceConfigurationInterface
    {
        return $this->currentResource;
    }
    /**
     * @inheritdoc
     */
    public function hasResource() : bool
    {
        return $this->currentResource instanceof ResourceConfigurationInterface;
    }

    private function validate(string $type, $value)
    {
        if (!$value instanceof ResourceConfigurationInterface) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid collection. %s accepts only %s types',
                    ResourceConfigurationCollection::class,
                    ResourceConfigurationInterface::class
                )
            );
        }

        if ($this->has($type)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Invalid collection. This collection already has type %s',
                    $type
                )
            );
        }
    }
}