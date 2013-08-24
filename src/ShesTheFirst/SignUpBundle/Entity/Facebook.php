<?php

namespace ShesTheFirst\SignUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ShesTheFirst\SignUpBundle\Entity\Contact;

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
     * @ORM\OneToOne(targetEntity="Contact")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="contact_id")
     * @ORM\Id
     */
    private $contact;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="facebook_id", type="bigint", unique=true)
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
    private $access_token;

    
    /**
     * Set contact
     *
     * @param ShesTheFirst\SignUpBundle\Entity\Contact $contact
     * @return Facebook
     */
    public function setContact(Contact $contact = null)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return ShesTheFirst\SignUpBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }
    
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

}
    