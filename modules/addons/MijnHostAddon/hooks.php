<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use WHMCS\View\Menu\Item;

add_hook('ClientAreaPage', 1, function ($params): void {

    if($_GET['m'] != 'MijnHostAddon')
    {
        return;
    }

    $lang = new \ModulesGarden\MijnHostAddon\Helpers\Lang();

    $params['primarySidebar']->addChild('mijnHostProfiles', [
        'label' => $lang->get('primarySidebarHeader')
    ]);

    $params['primarySidebar']->getChild('mijnHostProfiles')->addChild('mijnHostNameserverProfiles', [
        'label' => $lang->get('primarySidebarNameserverProfiles'),
        'uri' => 'index.php?m=MijnHostAddon&mha-controller=Nameservers',
        'order' => 1
    ]);

    $params['primarySidebar']->getChild('mijnHostProfiles')->addChild('mijnHostContactProfiles', [
        'label' => $lang->get('primarySidebarContactProfiles'),
        'uri' => 'index.php?m=MijnHostAddon&mha-controller=Contacts',
        'order' => 2
    ]);
});

add_hook('ClientAreaPrimaryNavbar', 1, function (Item $menuItem): void {

    $domainsMenuItem = $menuItem->getChild('Domains');

    if(!$domainsMenuItem instanceof Item)
    {
        return;
    }

    $lang = new \ModulesGarden\MijnHostAddon\Helpers\Lang();

    $domainsMenuItem->addChild(
        'primaryNavbarMijnHostNameserverProfiles',
        [
            'label' => $lang->get('primaryNavbarNameserverProfiles'),
            'uri' => 'index.php?m=MijnHostAddon&mha-controller=Nameservers',
            'order' => 10
        ]
    );

    $domainsMenuItem->addChild(
        'primaryNavbarMijnHostContactProfiles',
        [
            'label' => $lang->get('primaryNavbarContactProfiles'),
            'uri' => 'index.php?m=MijnHostAddon&mha-controller=Contacts',
            'order' => 15
        ]
    );
});

