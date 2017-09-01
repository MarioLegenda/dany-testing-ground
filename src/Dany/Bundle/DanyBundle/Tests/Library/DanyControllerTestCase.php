<?php

namespace Dany\Bundle\DanyBundle\Tests\Library;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;

class DanyControllerTestCase extends WebTestCase
{
    private $clients = [
        'no-flow-controller-client' => null,
    ];

    protected function createNoFlowControllerClient(bool $singleton = false)
    {
        if ($singleton === true) {
            return $this->getClientIfSingletonIsAskeg();
        }

        return $this->createDanyClient();
    }

    private function createDanyClient()
    {
        return static::createClient();
    }

    private function getClientIfSingletonIsAskeg() : Client
    {
        if ($this->clients['no-flow-controller-client'] instanceof Client) {
            return $this->clients['no-flow-controller-client'];
        }

        $this->clients['no-flow-controller-client'] = $this->createDanyClient();

        return $this->clients['no-flow-controller-client'];
    }


}