<?php

namespace Dany\Bundle\DanyBundle\Handler;

use Dany\Bundle\DanyBundle\Configuration\ModelConfigurationInterface;
use Doctrine\ORM\EntityManagerInterface;

interface RepositoryHandlerInterface
{
    public function resolve(
        ModelConfigurationInterface $modelConfiguration,
        EntityManagerInterface $em
    );

    public function handle() : array;
}