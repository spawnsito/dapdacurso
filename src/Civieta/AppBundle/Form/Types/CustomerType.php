<?php
/**
 * User: Daniel Cruz
 * Date: 11/01/2015
 * Time: 16:07
 */

namespace Civieta\AppBundle\Form\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nif', 'text', [
                'label' => 'NIF',
            ])
            ->add('name','text', [
                'label' => 'Nombre'
            ])
            ->add('surname', 'text', [
                'label' => 'Apellidos'
            ])
            ->add('dateOfBirth', 'date', [
                'label' => 'Fecha nacimiento',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => [
                    'placeholder' => 'dd/mm/yyyy'
                ]
            ])
            ->add('emails', 'collection', [
                'type' => 'email',
                'label' => 'Emails',
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => false,
            ])
            ->add('phones', 'collection', [
                'type' => 'text',
                'label' => 'Telefonos',
                'allow_add' => true,
                'allow_delete' => true,
                'error_bubbling' => true,
            ])
            ->add('address', 'addresstype', [
                'label' => false,
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Civieta\AppBundle\Entity\Customer',
            'method' => 'post',
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'customer';
    }
}