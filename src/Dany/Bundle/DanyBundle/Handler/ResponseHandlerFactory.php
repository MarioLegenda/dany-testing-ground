<?php

namespace Dany\Bundle\DanyBundle\Handler;

class ResponseHandlerFactory
{
    /**
     * @param string $type
     * @return ResponseHandlerInterface
     */
    public function resolveResponseHandler(string $type) : ResponseHandlerInterface
    {
        return $this->doResolveResponseHandler($type);
    }

    private function doResolveResponseHandler(string $type) : ResponseHandlerInterface
    {
        switch ($type) {
            case 'xml':
                return new JsonResponseHandler();
            case 'json':
                return new XmlResponseHandler();
        }
    }
}