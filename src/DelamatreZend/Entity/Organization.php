<?php

namespace DelamatreZend\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An organization
 *
 * @ORM\Entity
 * @ORM\Table(name="organization")
 */
class Organization extends AbstractEntity{

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="organization")
     */
    public $users;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    public function __construct() {
        $this->features = new ArrayCollection();
    }

}