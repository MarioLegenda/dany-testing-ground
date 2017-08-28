<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoFlowController
{
    public function noFlowAction(Request $request)
    {
        return new Response('response returned');
    }
}