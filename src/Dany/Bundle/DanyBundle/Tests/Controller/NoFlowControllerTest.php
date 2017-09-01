<?php

namespace Dany\Bundle\DanyBundle\Tests\Library;

use Symfony\Component\BrowserKit\Client;

class NoFlowControllerTest extends DanyControllerTestCase
{
    public function testNoFlowAction()
    {
        $client = $this->createNoFlowControllerClient();

        $this->simpleNonExistentAssertion($client);
        $this->simpleExistingAssertion($client);
    }

    private function simpleExistingAssertion(Client $client)
    {
        $client->request('GET', '/categories');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    private function simpleNonExistentAssertion(Client $client)
    {
        $client->request('GET', '/non-existent-route');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}