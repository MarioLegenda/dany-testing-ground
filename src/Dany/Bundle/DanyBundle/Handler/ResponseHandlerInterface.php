<?php

namespace Dany\Bundle\DanyBundle\Handler;

use Symfony\Component\HttpFoundation\Response;

interface ResponseHandlerInterface
{
    /**
     * @param $data
     * @return Response
     */
    public function getResponse($data) : Response;
}