<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="cet email est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    public function getId() {
        return $this->id;
    }

        /**
     * @ORM\column()
     * @Assert\NotBlank() 
     * @var string
     */
    private $lastname;
    public function getLastname() {
        return $this->lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

        /**
     * @ORM\column()
     * @Assert\NotBlank()
     * @var string
     */
    private $firstname;
    
   /**
     * @ORM\column(unique=true)
     * @Assert\Email() 
     * @var string
     */
    private $email;
    
     /**
     * @ORM\column()
     * @var string
     */
    private $password;
    
     /**
     * @ORM\column(length=20)
     * @var string
     */
    private $role = 'ROLE_USER';
    
    /**
     * @var string
     * @Assert\NotBlank()
     */
   private $plainPassword; 
   public function getPlainPassword() {
       return $this->plainPassword;
   }

   public function setPlainPassword($plainPassword) {
       $this->plainPassword = $plainPassword;
       return $this;
   }

   public function eraseCredentials() {
       //sin on veut effacer les droits d'un utilisateur
   }

   public function getRoles() {
       return [$this->role]; 
   }

   public function getSalt() {
     //sécurité supplémentaire, on utilise un algocryptage ne nécessitant pas cette fonction
   }

   public function getUsername(): string{
       return $this->email;
   }
   public function getFullname()
   {
       return $this->firstname.' '. $this->lastname;
   }
   public function __toString() {
       return $this->getFullname();
   }

}
