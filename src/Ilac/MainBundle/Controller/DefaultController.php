<?php

namespace Ilac\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
