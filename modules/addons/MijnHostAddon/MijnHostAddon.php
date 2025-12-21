<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

require_once __DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use ModulesGarden\MijnHostAddon\Actions\Config;
use ModulesGarden\MijnHostAddon\Actions\ClientArea;

function MijnHostAddon_config(): array
{
    $action = new Config();
    return $action->execute();
}

function MijnHostAddon_clientarea(array $params): array
{
    try {
        $action = new ClientArea($params);
        return $action->execute();
    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host', 'ClientArea',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'pagetitle' => 'Profiles',
            'breadcrumb' => [
                'clientarea.php' => 'Client Area',
                'index.php?m=MijnHostAddon' => 'Profiles'
            ],
            'templatefile' => 'error',
            'requirelogin' => true,
            'vars' => [
                'lang' => new \ModulesGarden\MijnHostAddon\Helpers\Lang()
            ]
        ];
    }
}
