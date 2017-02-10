<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Contact;
use BlogBundle\Form\ContactType;
use Symfony\Component\BrowserKit\Request;

class BlogController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()
            ->getEntityManager();

        $posts = $em->createQueryBuilder()
            ->select('b')
            ->from('BlogBundle:Post',  'b')
//            ->addOrderBy('b.created', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('@Blog/Blog/index.html.twig', array(
            'posts' => $posts
        ));
    }

    public function aboutAction()
    {
        return $this->render('@Blog/Blog/about.html.twig');
    }

    public function contactAction()
    {
        $contact = new Contact();
        $form = $this->createForm(new ContactType(), $contact);
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                ////a remplir////

                return $this->redirect($this->generateUrl('blog_contact'));
            }else{
//                     An error ocurred, handle
                    var_dump("Errooooor :(");
                }
        }

        return $this->render('@Blog/Blog/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BlogBundle:Post')->find($id);

//        if (!$post) {
//            throw $this->createNotFoundException('Unable to find Blog post.');
//        }

        return $this->render('@Blog/Blog/show.html.twig', array(
            'post'      => $post,
        ));
    }

    /**
     * Creates a new blog entity.
     *
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('BlogBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush($post);

            return $this->redirectToRoute('blog_show', array('id' => $post->getId()));
        }

        return $this->render('@Blog/Blog/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }


}
