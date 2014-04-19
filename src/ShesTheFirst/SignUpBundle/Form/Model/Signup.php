<?php

namespace ShesTheFirst\SignUpBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;


class Signup
{
    
    /**
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    protected $first_name;
    
    /**
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    protected $last_name;
    
    /**
     * @Assert\Email()
     * @Assert\MaxLength(255)
     */
    protected $email;
    

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }
    
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
}