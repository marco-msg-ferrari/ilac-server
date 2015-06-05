<?php

namespace Ilac\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class InsulinBolus extends BaseEvent {
    /**
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     */
    protected $carbohydrates;

    protected $discr = 'Bolus';

    public function setValue($value){
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setCarbohydrates($carbohydrates) {
        $this->carbohydrates = $carbohydrates;
    }

    public function getCarbohydrates() {
        return $this->carbohydrates;
    }
}