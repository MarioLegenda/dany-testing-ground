<?php

namespace Dany\Bundle\DanyBundle\Handler;

use Symfony\Component\HttpFoundation\Response;

class XmlResponseHandler extends ResponseHandler
{
    public function getResponse($data): Response
    {
        return $this->createResponse()->setContent($data);
    }

    private function createResponse() : Response
    {
        $response = new Response();
        $response->headers->set('CONTENT-TYPE', 'application/json');

        return $response;
    }
}