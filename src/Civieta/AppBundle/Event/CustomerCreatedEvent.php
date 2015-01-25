<?php
/**
 * User: Daniel Cruz
 * Date: 25/01/2015
 * Time: 20:24
 */

namespace Civieta\AppBundle\Event;


use Civieta\AppBundle\Entity\Customer;
use Symfony\Component\EventDispatcher\Event;

class CustomerCreatedEvent extends Event
{
    /**
     * @var Customer
     */
    protected $customer;

    function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

}