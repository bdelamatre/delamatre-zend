<?php

namespace DelamatreZend\Entity;

use DelamatreZend\Form\Element\UserState;
use DelamatreZend\Form\Element\UserType;
use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Password\Bcrypt;
use ZfcUser\Entity\UserInterface;

/**
 *
 * This user object is compatible with zfc-user
 *
 * @ORM\Entity,
 * @ORM\Table(name="user",indexes={
 *     @ORM\Index(name="index_username", columns={"username"}),
 *     @ORM\Index(name="index_displayname", columns={"displayName"}),
 *     @ORM\Index(name="index_email", columns={"email"}),
 *     @ORM\Index(name="index_type", columns={"type"}),
 *     @ORM\Index(name="index_state", columns={"state"}),
 *     @ORM\Index(name="index_password", columns={"password"}),
 *     @ORM\Index(name="index_auth", columns={"username","password"}),
 *     @ORM\Index(name="index_auth2", columns={"email","password"}),
 *     @ORM\Index(name="index_auth3", columns={"username","email","password"})
 *
 * })
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="record_type", type="string")
 * @ORM\DiscriminatorMap({"user-base" = "User", "user" = "\Application\Entity\User", "surgeon" = "\Application\Entity\Surgeon"})
 */
class User implements UserInterface{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer",nullable=true);
     */
    protected $organization_id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $displayName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $preferred_contact_type;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $mobile;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public $fax;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="integer")
     */
    protected $state = UserState::STATUS_ACTIVE;

    /**
     * @ORM\Column(type="string")
     */
    protected $type = UserType::TYPE_USER;

    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="users")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    public $organization;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Set type.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy(){
        $data = get_object_vars($this);
        unset($data['password']);
        unset($data['password_confirm']);
        return $data;
    }

    public function exchangeArray(array $data)
    {
        foreach ($data as $name => $value) {
            if (property_exists($this, $name)) {
                //prevent accidently setting an empty password
                if(in_array($name,array('password','password_confirm'))){
                    if(empty($value)){
                        continue;
                    }
                }
                $this->$name = $value;
            }
        }
    }

    public function getRecordType(){

        $className =  str_replace('\\', '/',get_class($this));
        $name = basename($className);
        return $name;
    }

	    /**
     * @return UserForm
     */
    public function getForm(){
        return new UserForm();
    }

}