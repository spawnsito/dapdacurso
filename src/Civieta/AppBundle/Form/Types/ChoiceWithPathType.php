<?php
/**
 * User: Daniel Cruz
 * Date: 25/01/2015
 * Time: 18:13
 */

namespace Civieta\AppBundle\Form\Types;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChoiceWithPathType extends AbstractType
{
    public function getParent()
    {
        return 'entity';
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['route'] = $options['route'];
        $view->vars['route_argument'] = $options['route_argument'];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'route' => '',
            'route_argument' => '',
        ]);
    }

    public function getName()
    {
        return 'choice_path';
    }
}