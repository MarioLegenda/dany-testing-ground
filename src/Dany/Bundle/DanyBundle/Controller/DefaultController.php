<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DanyBundle:Default:index.html.twig');
    }
}
