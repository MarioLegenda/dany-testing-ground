<?php

namespace Dany\Bundle\DanyBundle\Handler;

use Symfony\Component\HttpFoundation\Response;

interface ResponseHandlerInterface
{
    /**
     * @return Response
     */
    public function getResponse($data) : Response;
}