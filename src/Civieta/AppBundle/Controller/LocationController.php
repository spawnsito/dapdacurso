<?php
/**
 * User: Daniel Cruz
 * Date: 25/01/2015
 * Time: 17:26
 */

namespace Civieta\AppBundle\Controller;


use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LocationController
 *
 * @package Civieta\AppBundle\Controller
 * @Route("/location")
 */
class LocationController extends Controller
{
    /**
     * @Route("/{community}/provinces", name="find_provinces")
     */
    public function findProvincesAction($community)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Province');
        $provinces = $repository->findBy(['autonomousCommunity' => $community ]);

        $context = SerializationContext::create()->setGroups(
            ['province_list']
        );
        $serializer = $this->get('jms_serializer');
        $output = $serializer->serialize($provinces, 'json', $context);

        return new Response($output, 200, ['Content-Type' => 'application/json']);
    }
}