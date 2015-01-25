<?php
/**
 * User: Daniel Cruz
 * Date: 24/01/2015
 * Time: 20:04
 */

namespace Civieta\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AutonomousCommunity
 *
 * @package Civieta\AppBundle\Entity
 * @ORM\Entity()
 */
class AutonomousCommunity 
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column()
     */
    private $name;


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
}