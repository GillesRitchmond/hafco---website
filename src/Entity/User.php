<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserInterface\Serializable;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    // /**
    //  * @var string
    //  * @Gedmo\Slug(fields={"Nom"})
    //  * 
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    // public function getSlug(): ?string
    // {
    //     //return (new Slugify())->slugify($this->productName);
    //     return $this->slug;
    // }

    // public function setSlug(string $slug): self
    // {
    //     $this->slug = $slug;

    //     return $this;
    // }

    /** 
     * @return (Role|string)[] The user roles
     * 
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }


    /**
     * @return string|null  The salt 
     */
    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        
    }

    /**
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->nom,
            $this->prenom,
            $this->email,
            $this->password,
            $this->username
        ]);
    }


    /**
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->nom,
            $this->prenom,
            $this->email,
            $this->password,
            $this->username
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}

