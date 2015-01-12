<?php
/**
 * User: Daniel Cruz
 * Date: 11/01/2015
 * Time: 16:11
 */

namespace Civieta\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Address
 *
 * @package Civieta\AppBundle\Entity
 * @ORM\Entity()
 */
class Address 
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column()
     * @Assert\NotBlank(message="Introduzca la dirección completa")
     */
    private $completeAddress;

    /**
     * @var Province
     * @ORM\ManyToOne(targetEntity="Province")
     * @Assert\NotBlank(message="Seleccione una provincia")
     */
    private $province;

    /**
     * @var string
     * @ORM\Column()
     * @Assert\NotBlank(message="Introduzca la población de residencia")
     */
    private $town;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Introduzca el código postal")
     */
    private $postalCode;

    function __toString()
    {
        return sprintf('%s %s %s (%s)',
            $this->completeAddress, $this->postalCode, $this->getTown(),
            $this->province);
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
    public function getCompleteAddress()
    {
        return $this->completeAddress;
    }

    /**
     * @param string $completeAddress
     */
    public function setCompleteAddress($completeAddress)
    {
        $this->completeAddress = $completeAddress;
    }

    /**
     * @return Province
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param Province $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param string $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

    /**
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param int $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }



}