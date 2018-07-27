<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Porter;
use AppBundle\Form\PorterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Porter controller.
 *
 * @Route("porter")
 */
class PorterController extends Controller
{
    /**
     * Lists all porter entities.
     *
     * @Route("/", name="porter_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $porters = $em->getRepository(Porter::class)->findAll();

        return $this->render('porter/index.html.twig', array(
            'porters' => $porters,
        ));
    }

    /**
     * Creates a new porter entity.
     *
     * @Route("/new", name="porter_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $porter = new Porter();
        $form = $this->createForm(PorterType::class, $porter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($porter);
            $em->flush();

            return $this->redirectToRoute('porter_show', array('id' => $porter->getId()));
        }

        return $this->render('porter/new.html.twig', array(
            'porter' => $porter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a porter entity.
     *
     * @Route("/{id}", name="porter_show")
     * @Method("GET")
     */
    public function showAction(Porter $porter)
    {
        return $this->render('porter/show.html.twig', array(
            'porter' => $porter,
        ));
    }

    /**
     * Displays a form to edit an existing porter entity.
     *
     * @Route("/{id}/edit", name="porter_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Porter $porter)
    {
        $editForm = $this->createForm(PorterType::class, $porter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('porter_edit', array('id' => $porter->getId()));
        }

        return $this->render('porter/edit.html.twig', array(
            'porter' => $porter,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a porter entity.
     *
     * @Route("/delete/{id}", name="porter_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, Porter $porter)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($porter);
            $em->flush();

        return $this->redirectToRoute('porter_index');
    }
}
