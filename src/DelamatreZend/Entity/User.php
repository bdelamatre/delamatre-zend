<?php

namespace DelamatreZend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Password\Bcrypt;
use ZfcUser\Entity\UserInterface;

/**
 *
 * This user object is compatible with zfc-user
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface{

    const TYPE_USER         = 'user';
    const TYPE_ADMIN        = 'admin';
    const TYPE_SUPERADMIN   = 'superadmin';

    public static $userTypes = array(
        self::TYPE_USER => 'User',
        self::TYPE_ADMIN => 'Admin',
        self::TYPE_SUPERADMIN => 'Superadmin',
    );

    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;

    public static $userState = array(
        self::STATUS_ACTIVE => 'Enabled',
        self::STATUS_INACTIVE => 'Disabled',
    );
        /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="users")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $displayName;


    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="integer")
     */
    protected $state = self::STATUS_ACTIVE;

    /**
     * @ORM\Column(type="string")
     */
    protected $type = self::TYPE_USER;

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
}