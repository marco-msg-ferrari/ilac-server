<?php

namespace Ilac\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class GlucoTest extends BaseEvent {
    /**
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    protected $discr = 'Test';

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

    public function getStatus() {
        $min = 60;
        $max = 100;
        if ($this->type == 'after_meal') {
            $min = 100;
            $max = 140;
        }

        if ($this->value < $min) {
            return 'low';
        } elseif ($this->value > $max) {
            return 'high';
        } else {
            return 'normal';
        }
    }
}