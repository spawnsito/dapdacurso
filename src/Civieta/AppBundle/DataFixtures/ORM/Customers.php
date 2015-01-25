<?php
/**
 * User: Daniel Cruz
 * Date: 24/01/2015
 * Time: 21:13
 */

namespace Civieta\AppBundle\ORM\DataFixtures;


use Civieta\AppBundle\Entity\Customer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class Customers extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $faker = Factory::create('es');

        for ($i=0; $i < 100; $i++) {
            $customer = new Customer();
            $customer
                ->setName($faker->name)
                ->setDateOfBirth($faker->dateTimeThisCentury)
                ->setEmails(array($faker->email))
                ->setPhones(array($faker->phoneNumber))
                ->setNif($faker->randomNumber() . $faker->randomLetter);

            $manager->persist($customer);
        }

        $manager->flush();
    }
}