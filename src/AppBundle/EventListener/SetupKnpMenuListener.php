<?php

namespace AppBundle\EventListener;

use Avanzu\AdminThemeBundle\Event\KnpMenuEvent;

class SetupKnpMenuListener
{

    /**
     * @param KnpMenuEvent $event
     */
    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();

        // Adds a menu item which acts as a label
        $menu->addChild('MainNavigationMenuItem', [
                'label'        => 'MAIN NAVIGATION',
                'childOptions' => $event->getChildOptions()
            ])->setAttribute('class', 'header');

        // A "regular" menu item with a link
        $menu->addChild('HomePageItem', [
                'label'        => 'Homepage',
                'route'        => 'admin_index',
                'childOptions' => $event->getChildOptions()
            ])->setLabelAttribute('icon', 'fa fa-flag');

        // Adds a menu item which has children
        $menu->addChild('UsersItem', [
                'route'        => 'admin_users_index',
                'label'        => 'Users',
                'childOptions' => $event->getChildOptions()
            ])->setLabelAttribute('icon', 'fa fa-user');

        $menu->addChild('OrdersItem', [
                'route'        => 'admin_orders_index',
                'label'        => 'Orders',
                'childOptions' => $event->getChildOptions()
            ])->setLabelAttribute('icon', 'fa fa-shopping-cart');
    }
}
