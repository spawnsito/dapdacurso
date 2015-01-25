<?php
/**
 * User: Daniel Cruz
 * Date: 12/01/2015
 * Time: 23:02
 */

namespace Civieta\AppBundle\Form\Types;


use Civieta\AppBundle\Form\Subscribers\AddProvinceFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('completeAddress', 'text', [
                'label' => 'Dirección completa',
                'required' => false
            ])
            ->add('town', 'text', [
                'label' => 'Población',
                'required' => false
            ])
            ->add('postalCode', 'text', [
                'label' => 'Código Postal',
                'required' => false
            ])
            ->addEventSubscriber(new AddProvinceFieldSubscriber())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'Civieta\AppBundle\Entity\Address',
        ]);
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'addresstype';
    }
}