<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entrada;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Entrada controller.
 *
 * @Route("entrada")
 */
class EntradaController extends Controller
{
    /**
     * Lists all entrada entities.
     *
     * @Route("/", name="entrada_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entradas = $em->getRepository('AppBundle:Entrada')->findAll();

        return $this->render('entrada/index.html.twig', array(
            'entradas' => $entradas,
        ));
    }

    /**
     * Creates a new entrada entity.
     *
     * @Route("/new", name="entrada_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $entrada = new Entrada();
        $form = $this->createForm('AppBundle\Form\EntradaType', $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entrada);
            $em->flush();

            return $this->redirectToRoute('entrada_show', array('id' => $entrada->getId()));
        }

        return $this->render('entrada/new.html.twig', array(
            'entrada' => $entrada,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a entrada entity.
     *
     * @Route("/{id}", name="entrada_show")
     * @Method("GET")
     */
    public function showAction(Entrada $entrada)
    {
        $deleteForm = $this->createDeleteForm($entrada);

        return $this->render('entrada/show.html.twig', array(
            'entrada' => $entrada,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entrada entity.
     *
     * @Route("/{id}/edit", name="entrada_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Entrada $entrada)
    {
        $deleteForm = $this->createDeleteForm($entrada);
        $editForm = $this->createForm('AppBundle\Form\EntradaType', $entrada);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entrada_edit', array('id' => $entrada->getId()));
        }

        return $this->render('entrada/edit.html.twig', array(
            'entrada' => $entrada,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a entrada entity.
     *
     * @Route("/{id}", name="entrada_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Entrada $entrada)
    {
        $form = $this->createDeleteForm($entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entrada);
            $em->flush();
        }

        return $this->redirectToRoute('entrada_index');
    }

    /**
     * Creates a form to delete a entrada entity.
     *
     * @param Entrada $entrada The entrada entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Entrada $entrada)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entrada_delete', array('id' => $entrada->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
