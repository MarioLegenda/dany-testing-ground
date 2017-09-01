<?php

namespace Dany\Bundle\DanyBundle\Tests\Library;

class NoFlowControllerTest extends DanyControllerTestCase
{
    public function testNoFlowAction()
    {
        $client = $this->createNoFlowControllerClient();

        $client->request('GET', '/categories');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}