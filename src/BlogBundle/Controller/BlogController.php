<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Blog/Blog/index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('@Blog/Blog/about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('@Blog/Blog/contact.html.twig');
    }
}
