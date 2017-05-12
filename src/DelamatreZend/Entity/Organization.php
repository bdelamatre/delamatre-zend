<?php

namespace DelamatreZend\Entity;

use DelamatreZend\Form\Element\Active;
use DelamatreZend\Form\Element\OrganizationType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * An organization
 *
 * @ORM\Entity
 * @ORM\Table(name="organization",indexes={
 *     @ORM\Index(name="index_name", columns={"name"}),
 *     @ORM\Index(name="index_email", columns={"email"}),
 *     @ORM\Index(name="index_type", columns={"type"}),
 *     @ORM\Index(name="index_state", columns={"state"}),
 *
 * })
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="record_type", type="string")
 * @ORM\DiscriminatorMap({"organization-base" = "Organization", "organization" = "\Application\Entity\Organization", "surgerycenter" = "\Application\Entity\SurgeryCenter"})
 */
class Organization extends AbstractEntity{

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

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $preferred_contact_type;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $mobile;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $fax;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $notes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $contracted_fees;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address_street;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address_city;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address_state;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address_country;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $address_zip;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $address_notes;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $billing_email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $billing_street;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $billing_city;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $billing_state;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $billing_country;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $billing_zip;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $billing_notes;

    /**
     * @ORM\Column(type="string")
     */
    protected $type = OrganizationType::TYPE_ADMIN;

    /**
     * @ORM\Column(type="integer")
     */
    protected $state = Active::STATUS_ACTIVE;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $active = 1;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="organization")
     */
    public $users;

    public function __construct() {
        $this->users = new ArrayCollection();
    }

}