<?php

namespace ShesTheFirst\SignUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ShesTheFirstSignUpBundle:Default:index.html.twig', array('name' => $name));
    }
}
