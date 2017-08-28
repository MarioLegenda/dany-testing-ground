<?php

namespace Dany\Bundle\DanyBundle\Configuration;

interface ResourceSearchProviderInterface
{
    /**
     * @param string $modelNamespace
     * @return mixed
     */
    public function findByModelName(string $modelNamespace);
}