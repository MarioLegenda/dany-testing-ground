<?php

namespace Dany\Library;

abstract class AbstractLooseCollection implements CollectionInterface
{
    /**
     * @var array $collection
     */
    protected $collection = [];
    /**
     * @param string $type
     * @param $value
     * @return CollectionInterface
     */
    public function add(string $type, $value): CollectionInterface
    {
        $this->collection[$type] = $value;

        return $this;
    }
    /**
     * @param string $type
     * @return bool
     */
    public function has(string $type): bool
    {
        return array_key_exists($type, $this->collection);
    }
    /**
     * @param string $type
     * @return mixed
     */
    public function get(string $type)
    {
        if ($this->has($type)) {
            return $this->collection[$type];
        }
    }
    /**
     * @return array
     */
    public function all(): array
    {
        return $this->collection;
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return count($this->collection);
    }
    /**
     * @return \ArrayIterator
     */
    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->collection);
    }
}