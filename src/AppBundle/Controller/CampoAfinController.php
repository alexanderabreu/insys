<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CampoAfin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Campoafin controller.
 *
 * @Route("campoafin")
 */
class CampoAfinController extends Controller
{
    /**
     * Lists all campoAfin entities.
     *
     * @Route("/", name="campoafin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $campoAfins = $em->getRepository('AppBundle:CampoAfin')->findAll();

        return $this->render('campoafin/index.html.twig', array(
            'campoAfins' => $campoAfins,
        ));
    }

    /**
     * Creates a new campoAfin entity.
     *
     * @Route("/new", name="campoafin_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $campoAfin = new Campoafin();
        $form = $this->createForm('AppBundle\Form\CampoAfinType', $campoAfin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($campoAfin);
            $em->flush();

            return $this->redirectToRoute('campoafin_show', array('id' => $campoAfin->getId()));
        }

        return $this->render('campoafin/new.html.twig', array(
            'campoAfin' => $campoAfin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a campoAfin entity.
     *
     * @Route("/{id}", name="campoafin_show")
     * @Method("GET")
     */
    public function showAction(CampoAfin $campoAfin)
    {
        $deleteForm = $this->createDeleteForm($campoAfin);

        return $this->render('campoafin/show.html.twig', array(
            'campoAfin' => $campoAfin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing campoAfin entity.
     *
     * @Route("/{id}/edit", name="campoafin_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CampoAfin $campoAfin)
    {
        $deleteForm = $this->createDeleteForm($campoAfin);
        $editForm = $this->createForm('AppBundle\Form\CampoAfinType', $campoAfin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('campoafin_edit', array('id' => $campoAfin->getId()));
        }

        return $this->render('campoafin/edit.html.twig', array(
            'campoAfin' => $campoAfin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a campoAfin entity.
     *
     * @Route("/{id}", name="campoafin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CampoAfin $campoAfin)
    {
        $form = $this->createDeleteForm($campoAfin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($campoAfin);
            $em->flush();
        }

        return $this->redirectToRoute('campoafin_index');
    }

    /**
     * Creates a form to delete a campoAfin entity.
     *
     * @param CampoAfin $campoAfin The campoAfin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CampoAfin $campoAfin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('campoafin_delete', array('id' => $campoAfin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
