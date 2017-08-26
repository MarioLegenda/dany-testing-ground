<?php

namespace Dany\Bundle\DanyBundle\Configuration;

use Dany\Library\CollectionInterface;

class ResourceConfigurationCollection implements CollectionInterface
{
    /**
     * @var array $resourceConfigurations
     */
    private $resourceConfigurations = [];
    /**
     * @param string $type
     * @param $value
     * @return CollectionInterface
     */
    public function add(string $type, $value): CollectionInterface
    {
        $this->validate($type, $value);

        $this->resourceConfigurations[$type] = $value;

        return $this;
    }
    /**
     * @param string $type
     * @return bool
     */
    public function has(string $type): bool
    {
        return array_key_exists($type, $this->resourceConfigurations);
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

        return $this->resourceConfigurations[$type];
    }
    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->resourceConfigurations);
    }
    /**
     * @return \ArrayIterator
     */
    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->resourceConfigurations);
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