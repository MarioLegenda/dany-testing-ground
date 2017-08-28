<?php

namespace AppBundle\Entity;

use Dany\Bundle\DanyBundle\Model\DanyResource;

class Word implements DanyResource
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var int $name
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getName(): int
    {
        return $this->name;
    }

    /**
     * @param int $name
     */
    public function setName(int $name)
    {
        $this->name = $name;
    }
}