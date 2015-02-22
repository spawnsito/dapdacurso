<?php
/**
 * User: Daniel Cruz
 * Date: 11/01/2015
 * Time: 13:47
 */

namespace Civieta\AppBundle\Menu;


class MenuFactory 
{
    /** @var \Knp\Menu\MenuFactory  */
    private $factory;

    function __construct($factory)
    {
        $this->factory = $factory;
    }

    public function mainMenu()
    {
        $menu = $this->factory->createItem('root');
        $customer = $menu->addChild('customer', [
            'label' => 'Clientes',
        ]);

        $customer->addChild('create_customer', [
            'route' => 'create_customer',
            'routeParameters' => [],
            'label' => 'Crear cliente',
        ]);

        $menu->addChild('logout', [
            'route' => 'user_logout',
            'label' => 'Cerrar sesión',
        ]);

        return $menu;
    }

}