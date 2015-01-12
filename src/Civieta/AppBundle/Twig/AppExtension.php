<?php
/**
 * User: Daniel Cruz
 * Date: 12/01/2015
 * Time: 23:29
 */

namespace Civieta\AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter(
                'arrayToString',
                array($this, 'arrayToString'),
                array('is_safe' => array('html'))
            ),
        );
    }

    public function arrayToString($array)
    {
        return join(', ', $array);
    }

    public function getName()
    {
        return 'app_extension';
    }
}