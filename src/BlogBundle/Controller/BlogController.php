<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Contact;
use Symfony\Component\BrowserKit\Request;
use BlogBundle\Form\ContactType;

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

    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                return $this->redirect($this->generateUrl('blog_contact'));
            }else{
//                     An error ocurred, handle
//                    var_dump("Errooooor :(");
//                }
        }

        return $this->render('@Blog/Blog/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

}
