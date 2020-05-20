<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Loginsymfony
 *
 * @ORM\Table(name="loginsymfony")
 * @ORM\Entity
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Loginsymfony implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=true, options={"default"="NULL"})
     */
    private $nombre = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=75, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=500, nullable=false)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechacreacion", type="datetime", nullable=false)
     */
    private $fechacreacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFechacreacion(): ?\DateTimeInterface
    {
        return $this->fechacreacion;
    }

    public function setFechacreacion(\DateTimeInterface $fechacreacion): self
    {
        $this->fechacreacion = $fechacreacion;

        return $this;
    }

/*---------------- Propiedades agregadas Siempre tiene qe llamarse asi--------------- */


    public function getPassword()
    {
        return $this->password;
    }

    public function getUsername()
    {
        return $this->nombre;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->nombre,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->nombre,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
