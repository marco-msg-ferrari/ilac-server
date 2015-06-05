<?php

namespace Ilac\MainBundle\Controller;

use Ilac\MainBundle\Entity\GlucoTest;
use Ilac\MainBundle\Entity\InsulinBolus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $name = $this->getUser()->getUsername();

        $events = $this->getDoctrine()
            ->getRepository('IlacMainBundle:BaseEvent')
            ->findByUser($this->getUser()->getId(), ['createdAt' => 'DESC']);

        return $this->render(
            'IlacMainBundle:Default:index.html.twig',
            ['name' => $name, 'events' => $events]
        );
    }

    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $test = new GlucoTest();

        $form = $this->createFormBuilder($test)
            ->add('value', 'integer', ['required' => true])
            ->add('type', 'choice', [
                'choices'  => ['before_meal' => 'Before Meal', 'after_meal' => 'After Meal'],
                'required' => true
            ])
            ->add('createdAt', 'datetime')
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
            'title' => 'Medition',
        ));
    }

    public function newBolusAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $test = new InsulinBolus();

        $form = $this->createFormBuilder($test)
            ->add('value', 'integer', ['required' => true])
            ->add('type', 'choice', [
                'choices'  => ['fast' => 'Fast', 'slow' => 'Slow'],
                'required' => true
            ])
            ->add('createdAt', 'datetime')
            ->add('save', 'submit', array('label' => 'Create Bolus'))
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
            'title' => 'Bolus',
        ));
    }
}
