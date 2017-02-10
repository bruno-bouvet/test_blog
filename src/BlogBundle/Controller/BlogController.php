<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Contact;
use BlogBundle\Form\ContactType;
use Symfony\Component\BrowserKit\Request;
use BlogBundle\Repository;

class BlogController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $posts = $em->getRepository('BlogBundle:Post')->getLatestPosts();

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
        $image = $em->getRepository('BlogBundle:Image')->find($id);

//        if (!$post) {
//            throw $this->createNotFoundException('Unable to find Blog post.');
//        }

        return $this->render('@Blog/Blog/show.html.twig', array(
            'post'  => $post,
            'image' => $image,
        ));
    }

    /**
     * Creates a new blog entity.
     *
     */
    public function newAction( )
    {
        $post = new Post();
        $form = $this->createForm('BlogBundle\Form\PostType', $post);
        $request = $this->get('request');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush($post);

            return $this->redirectToRoute('blog_new', array('id' => $post->getId()));
        }

        return $this->render('@Blog/Blog/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

//    /**
//     * Displays a form to edit an existing blog entity.
//     *
//     */
//    public function editAction(Post $post)
//    {
//        $deleteForm = $this->createDeleteForm($post);
//        $editForm = $this->createForm('BlogBundle\Form\blogType', $post);
//        $request = $this->get('request');
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
//
//            return $this->redirectToRoute('blog_edit', array('id' => $post->getId()));
//        }
//
//        return $this->render('@Eurotrade/blog/edit.html.twig', array(
//            'blog' => $blog,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }


}
