<?php

namespace Ilac\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="insulinbolus")
 */
class InsulinBolus {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="insulinBoluses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

    /** @ORM\Column(type="datetime", name="created_at") */
    protected $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    protected $value;

    /**
     * @ORM\Column(type="string")
     */
    protected $type;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }
}