<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoFlowController extends Controller
{
    public function noFlowAction(Request $request)
    {
        $this->get('doctrine')->getRepository('AppBundle:Category');
        return new Response('response returned');
    }
}