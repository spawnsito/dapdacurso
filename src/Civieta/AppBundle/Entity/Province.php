<?php
/**
 * User: Daniel Cruz
 * Date: 11/01/2015
 * Time: 16:16
 */

namespace Civieta\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Province
 *
 * @package Civieta\AppBundle\Entity
 * @ORM\Entity()
 */
class Province
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @JMS\Groups({"province_list"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @JMS\Groups({"province_list"})
     */
    private $name;

    /**
     * @var AutonomousCommunity
     * @ORM\ManyToOne(targetEntity="AutonomousCommunity")
     */
    private $autonomousCommunity;

    function __toString()
    {
        return $this->name;
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
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return AutonomousCommunity
     */
    public function getAutonomousCommunity()
    {
        return $this->autonomousCommunity;
    }

    /**
     * @param AutonomousCommunity $autonomousCommunity
     * @return $this
     */
    public function setAutonomousCommunity($autonomousCommunity)
    {
        $this->autonomousCommunity = $autonomousCommunity;

        return $this;
    }

}