<?php

namespace Ilac\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"insulin" = "InsulinBolus", "test" = "GlucoTest"})
 */
class BaseEvent {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="events")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    protected $user;

    /** @ORM\Column(type="datetime", name="created_at") */
    protected $createdAt;

    protected $discr = '';

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getDiscr() {
        return $this->discr;
    }
}
