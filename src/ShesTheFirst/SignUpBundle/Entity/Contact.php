<?php

namespace ShesTheFirst\SignUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ShesTheFirst\SignUpBundle\Entity\Facebook;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var integer
     *
     * @ORM\Column(name="contact_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
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
     * @ORM\OneToOne(targetEntity="Facebook", mappedBy="contact")
     **/
    private $facebook;


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
     * @return Contact 
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
     * @return Contact
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return Contact
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
     * @return Contact
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
     * @return Contact
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
     * Set created
     *
     * @param \DateTime $created
     * @return Contact
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
     * @return Contact
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
    
    /**
     * Set facebook
     *
     * @param ShesTheFirst\SignUpBundle\Entity\Facebook $facebook
     * @return Contact
     */
    public function setFacebook(Facebook $facebook = null)
    {
        $this->facebook = $facebook;
    
        return $this;
    }

    /**
     * Get facebook
     *
     * @return ShesTheFirst\SignUpBundle\Entity\Facebook 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }
    
}