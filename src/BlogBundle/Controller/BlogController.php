<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use BlogBundle\Entity\Contact;
use BlogBundle\Form\ContactType;
use BlogBundle\Form\PostType;
use BlogBundle\Form\DeleteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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

    /**
     * Displays a form to edit an existing blog entity.
     *
     */
    public function editAction(Request $request, Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('BlogBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_edit', array('id' => $post->getId()));
        }

        return $this->render('@Blog/Blog/edit.html.twig', array(
            'blog' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a blog entity.
     *
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush($post);
        }

        return $this->redirectToRoute('blog_homepage');
    }
    /**
     * Creates a form to delete a blog entity.
     *
     * @param post $post The blog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blog_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
