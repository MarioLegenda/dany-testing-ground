<?php

namespace Dany\Library;

interface CollectionInterface extends \Countable, \IteratorAggregate
{
    public function add(string $type, $value) : CollectionInterface;
    public function has(string $type) : bool;
    public function get(string $type);
    public function all() : array;
}