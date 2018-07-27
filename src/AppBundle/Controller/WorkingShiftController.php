<?php

namespace AppBundle\Controller;

use AppBundle\Entity\WorkingShift;
use AppBundle\Form\WorkingShiftType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Workingshift controller.
 *
 * @Route("workingshift")
 */
class WorkingShiftController extends Controller
{
    /**
     * Lists all workingShift entities.
     *
     * @Route("/", name="workingshift_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $workingShifts = $em->getRepository(WorkingShift::class)->findAll();

        return $this->render('workingshift/index.html.twig', array(
            'workingShifts' => $workingShifts,
        ));
    }

    /**
     * Creates a new workingShift entity.
     *
     * @Route("/new", name="workingshift_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $workingShift = new Workingshift();
        $form = $this->createForm(WorkingShiftType::class, $workingShift);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($workingShift);
            $em->flush();

            return $this->redirectToRoute('workingshift_show', array('id' => $workingShift->getId()));
        }

        return $this->render('workingshift/new.html.twig', array(
            'workingShift' => $workingShift,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a workingShift entity.
     *
     * @Route("/{id}", name="workingshift_show")
     * @Method("GET")
     */
    public function showAction(WorkingShift $workingShift)
    {
        return $this->render('workingshift/show.html.twig', array(
            'workingShift' => $workingShift,
        ));
    }

    /**
     * Displays a form to edit an existing workingShift entity.
     *
     * @Route("/{id}/edit", name="workingshift_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, WorkingShift $workingShift)
    {
        $editForm = $this->createForm(WorkingShiftType::class, $workingShift);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('workingshift_edit', array('id' => $workingShift->getId()));
        }

        return $this->render('workingshift/edit.html.twig', array(
            'workingShift' => $workingShift,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a workingShift entity.
     *
     * @Route("/delete/{id}", name="workingshift_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, WorkingShift $workingShift)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($workingShift);
            $em->flush();

        return $this->redirectToRoute('workingshift_index');
    }
}
