<?php
/**
 * Created by PhpStorm.
 * User: dcruz
 * Date: 13/01/15
 * Time: 18:59
 */

namespace Civieta\AppBundle\ORM\DataFixtures;


use Civieta\AppBundle\Entity\AutonomousCommunity;
use Civieta\AppBundle\Entity\Province;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProvincesAndCommunities extends AbstractFixture implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $rootPath = $this->container->getParameter('kernel.root_dir');

        $file = file_get_contents(sprintf('%s/Resources/json/provinces.json', $rootPath));
        $provinces = json_decode($file);

        $file = file_get_contents(sprintf('%s/Resources/json/autonomousCommunity.json', $rootPath));
        $communities = json_decode($file);

        $communitiesEntities = array();
        foreach ($communities as $community) {
            $communityEntity = new AutonomousCommunity();
            $communityEntity->setId($community->id)->setName($community->name);
            $communitiesEntities[$communityEntity->getId()] = $communityEntity;

            $manager->persist($communityEntity);
        }

        $manager->flush();

        foreach ($provinces as $province) {
            $provinceObject = new Province();
            $provinceObject->setId($province->id)->setName($province->name);
            $provinceObject->setAutonomousCommunity($communitiesEntities[$province->autonomousCommunity_id]);

            $manager->persist($provinceObject);
        }

        $manager->flush();
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}