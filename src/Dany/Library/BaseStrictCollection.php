<?php

namespace Dany\Library;

class BaseStrictCollection extends BaseLooseCollection
{
    /**
     * @param string $type
     * @param $value
     * @return CollectionInterface
     */
    public function add(string $type, $value): CollectionInterface
    {
        if (!$this->has($type)) {
            throw new \RuntimeException(
                sprintf('Collection already has entry %s', $type)
            );
        }

        return parent::add($type, $value);
    }
    /**
     * @param string $type
     * @return mixed
     */
    public function get(string $type)
    {
        if (!$this->has($type)) {
            throw new \RuntimeException(
                sprintf('Entry %s not found in collection', $type)
            );
        }

        return parent::get($type);
    }
}