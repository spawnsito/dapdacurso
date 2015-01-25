<?php
/**
 * User: Daniel Cruz
 * Date: 25/01/2015
 * Time: 13:18
 */

namespace Civieta\AppBundle\Form\Subscribers;



use Civieta\AppBundle\Form\Types\ChoiceWithPathType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddProvinceFieldSubscriber implements EventSubscriberInterface
{

    public function onPostSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $province = null !== $data ? $data->getProvince() : null;
        $community = null !== $province ? $province->getAutonomousCommunity() : null;

        $form->add('autonomousCommunity', new ChoiceWithPathType(), [
            'label' => 'Comunidad Autonoma',
            'route' => 'find_provinces',
            'route_argument' => 'community',
            'class' => 'Civieta\AppBundle\Entity\AutonomousCommunity',
            'required' => false,
            'mapped' => false,
            'data' => $community,
        ]);

        $this->addField($form, $community !== null ? $community->getId() : null);

    }

    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $community = null !== $data ? $data['autonomousCommunity'] : null;
        $this->addField($form, $community);
    }

    private function addField($form, $community)
    {
        if (null !== $community) {
            $form->add('province', 'entity', [
                'label' => 'Provincia',
                'class' => 'Civieta\AppBundle\Entity\Province',
                'query_builder' => function(EntityRepository $repository) use ($community) {
                    return $repository->createQueryBuilder('p')
                        ->join('p.autonomousCommunity', 'a')
                        ->where('a.id = :id')
                        ->orderBy('p.name')
                        ->setParameter('id', $community);
                },
            ]);

        } else {
            $form->add('province', 'choice', [
                'label' => 'Provincia',
                'empty_value' => 'Seleccione una comunidad autónoma',
                'required' => false,
            ]);
            $community = null;
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }
}