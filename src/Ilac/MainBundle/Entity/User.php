<?php

namespace Ilac\MainBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="GlucoTest", mappedBy="user")
     **/
    private $glucoTests;

    /**
     * @ORM\OneToMany(targetEntity="InsulinBolus", mappedBy="user")
     **/
    private $insulinBoluses;

    public function __construct() {
        parent::__construct();
        $this->glucoTests = new ArrayCollection();
        $this->insulinBoluses = new ArrayCollection();
    }
}