<?php
/**
 * User: Daniel Cruz
 * Date: 11/01/2015
 * Time: 16:09
 */

namespace Civieta\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Customer
 *
 * @package Civieta\AppBundle\Entity
 * @ORM\Entity(repositoryClass="Civieta\AppBundle\Repository\CustomerRepository")
 * @ORM\Table(indexes={@ORM\Index(columns={"nif"}, name="fk_nif")})
 */
class Customer 
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(length=9)
     * @Assert\NotBlank(message="NIF obligatorio")
     * @Assert\Regex(pattern="/(\d{8})([-]?)([A-Z]{1})/", message="El NIF no es válido. Ej: 13131313X")
     */
    private $nif;

    /**
     * @var string
     * @ORM\Column()
     * @Assert\NotBlank(message="Introduce el nombre del cliente")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(nullable=true)
     */
    private $surname;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Fecha de nacimiento obligatoria")
     */
    private $dateOfBirth;

    /**
     * @var array<string>
     * @ORM\Column(type="array")
     * @Assert\Count(min="1", minMessage="Añade al menos un email")
     */
    private $emails;

    /**
     * @var array<string>
     * @ORM\Column(type="array")
     */
    private $phones;

    /**
     * @var Address
     * @ORM\OneToOne(targetEntity="Address", cascade={"persist"})
     * @Assert\Valid()
     */
    private $address;

    function __construct()
    {
    }


    function __toString()
    {
        return sprintf('%s %s', $this->name, $this->surname);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * @param string $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param array $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    /**
     * @return array
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param array $phones
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }


}