<?php

namespace Ilac\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GraphController extends Controller
{
    public function indexAction()
    {
        $name = $this->getUser()->getUsername();

        $events = $this->getDoctrine()
            ->getRepository('IlacMainBundle:GlucoTest')
            ->findByUser($this->getUser()->getId(), ['createdAt' => 'ASC']);

        return $this->render(
            'IlacMainBundle:Graph:index.html.twig',
            [
                'name' => $name,
                'days' => $this->getDays($events)
            ]
        );
    }

    private function getDays($events) {
        $days = [];
        $firstDate = $events[0]->getCreatedAt()->format('Y-m-d');
        $currentDate = $firstDate;
        $lastDate = $events[count($events) -1]->getCreatedAt()->format('Y-m-d');

        while ($currentDate != $lastDate) {
            $days[$currentDate]['morning_before'] = '';
            $days[$currentDate]['morning_after'] = '';
            $days[$currentDate]['afternoon_before'] = '';
            $days[$currentDate]['afternoon_after'] = '';
            $days[$currentDate]['evening_before'] = '';
            $days[$currentDate]['evening_after'] = '';
            $days[$currentDate]['night'] = '';
            $fecha = new \DateTime($currentDate);
            $currentDate = $fecha->add(new \DateInterval('P1D'))->format('Y-m-d');
        }
        $days[$lastDate]['morning_before'] = '';
        $days[$lastDate]['morning_after'] = '';
        $days[$lastDate]['afternoon_before'] = '';
        $days[$lastDate]['afternoon_after'] = '';
        $days[$lastDate]['evening_before'] = '';
        $days[$lastDate]['evening_after'] = '';
        $days[$lastDate]['night'] = '';

        foreach ($events as $event) {
            $type = '_before';
            if ($event->getType() == 'after_meal') {
                $type = '_after';
            }
            $days[$event->getCreatedAt()->format('Y-m-d')][$event->getPartOfDay() . $type] = $event->getValue();
        }

        return $days;
    }
}
