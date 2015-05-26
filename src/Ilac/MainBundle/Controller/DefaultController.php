<?php

namespace Ilac\MainBundle\Controller;

use Ilac\MainBundle\Entity\GlucoTest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $name = $this->getUser()->getUsername();

        $glucoTests = $this->getDoctrine()
            ->getRepository('IlacMainBundle:GlucoTest')
            ->findByUser($this->getUser()->getId());

        return $this->render(
            'IlacMainBundle:Default:index.html.twig',
            ['name' => $name, 'glucoTests' => $glucoTests]
        );
    }

    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $test = new GlucoTest();

        $form = $this->createFormBuilder($test)
            ->add('value', 'text')
            ->add('createdAt', 'date')
            ->add('save', 'submit', array('label' => 'Create Test'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            $test->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();

            return $this->redirectToRoute('ilac_main_homepage');
        }

        return $this->render('IlacMainBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
