<?php

namespace ShesTheFirst\SignUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facebook
 *
 * @ORM\Table(name="facebook")
 * @ORM\Entity
 */
class Facebook
{
    /**
     * @var integer
     *
     * @ORM\Column(name="facebook_id", type="bigint")
     * @ORM\Id
     */
    private $id;
    
    /**
     * @var string
     *
     *  @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;
    
    /**
     * @var string
     *
     *  @ORM\Column(type="string", length=255, nullable=true)
     */
    private $first_name;
    
    /**
     * @var string
     *
     *  @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_name;
    
    /**
     * @var string
     *
     *  @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $created;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updated;
    
    /**
     * @var string
     *
     *  @ORM\Column(type="string", length=255, nullable=true)
     */
    private $access_token;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set id
     *
     * @param int $id
     * @return Facebook 
     */
    public function settId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    

    /**
     * Set id
     *
     * @param integer $id
     * @return Facebook
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Facebook
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return Facebook
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Facebook
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Facebook
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set access_token
     *
     * @param string $accessToken
     * @return Facebook
     */
    public function setAccessToken($accessToken)
    {
        $this->access_token = $accessToken;
    
        return $this;
    }

    /**
     * Get access_token
     *
     * @return string 
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }
    

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Facebook
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
    

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Facebook
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}