<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Entrada;
use AppBundle\Form\EntradaType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="inicio")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $form=$this->createForm(new EntradaType());

        $em =  $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('AppBundle:Entrada')->findAll();
         
        return $this->render("AppBundle:Default:index.html.twig", 
            array(
                "entities"=>$entities,
                "form"=>$form->createView()
        ));
    }

    /**
     * Creates a new Entrada entity.
     *
     * @Route("/insertar", name="insertar")
     * @Method("POST")
     * @Template("AppBundle:Default:new.html.twig")
     */
    public function insertarAction(Request $request) {
        $entity = new Entrada();
        $form = $this->createForm(new EntradaType(), $entity);
        $form->handleRequest($request);
    
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inicio'));
        } 
    }
}
