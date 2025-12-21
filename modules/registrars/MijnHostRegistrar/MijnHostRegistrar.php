<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

require_once __DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

use ModulesGarden\MijnHostRegistrar\Actions\MetaData;
use ModulesGarden\MijnHostRegistrar\Actions\GetConfigArray;
use ModulesGarden\MijnHostRegistrar\Actions\RegisterDomain;
use ModulesGarden\MijnHostRegistrar\Actions\GetEPPCode;
use ModulesGarden\MijnHostRegistrar\Actions\GetRegistrarLock;
use ModulesGarden\MijnHostRegistrar\Actions\SaveRegistrarLock;
use ModulesGarden\MijnHostRegistrar\Actions\GetDNS;
use ModulesGarden\MijnHostRegistrar\Actions\SaveDNS;
use ModulesGarden\MijnHostRegistrar\Actions\RequestDelete;
use ModulesGarden\MijnHostRegistrar\Actions\Nameservers;
use ModulesGarden\MijnHostRegistrar\Actions\Contacts;
use ModulesGarden\MijnHostRegistrar\Actions\Sync;
use ModulesGarden\MijnHostRegistrar\Actions\TransferDomain;
use ModulesGarden\MijnHostRegistrar\Actions\TransferSync;
use ModulesGarden\MijnHostRegistrar\Helpers\Lang;

function MijnHostRegistrar_MetaData(): array
{
    $action = new MetaData();
    return $action->execute();
}

function MijnHostRegistrar_getConfigArray(): array
{
    $action = new GetConfigArray();
    return $action->execute();
}

function MijnHostRegistrar_RegisterDomain($params): array
{
    try {
        $action = new RegisterDomain($params);
        return $action->execute();

    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'RegisterDomain',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_TransferDomain($params): array
{
    try {
        $action = new TransferDomain($params);
        return $action->execute();

    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'TransferDomain',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_GetRegistrarLock($params): array|string
{
    try {
        $action = new GetRegistrarLock($params);
        return $action->execute();

    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'GetRegistrarLock',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_SaveRegistrarLock($params): array
{
    try {
        $action = new SaveRegistrarLock($params);
        return $action->execute();

    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'SaveRegistrarLock',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_GetDNS($params): array
{
    try {
        $action = new GetDNS($params);
        return $action->execute();

    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'GetDNS',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_SaveDNS($params): array
{
    try {
        $action = new SaveDNS($params);
        return $action->execute();

    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'SaveDNS',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_GetEPPCode(array $params): array
{
    try {
        $action = new GetEPPCode($params);
        return $action->execute();
    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'GetEPPCode',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_RequestDelete($params): array
{
    try {
        $action = new RequestDelete($params);
        return $action->execute();

    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'RequestDelete',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_Sync($params): array
{
    try {
        $action = new Sync($params);
        return $action->execute();
    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host',
            'Sync',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_TransferSync($params): array
{
    try {
        $action = new TransferSync($params);
        return $action->execute();
    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host', 'TransferSync',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_ClientAreaCustomButtonArray()
{
    $lang = new Lang();

    return [
        $lang->get('manageButtonNameservers') => 'Nameservers',
        $lang->get('manageButtonContacts') => 'Contacts',
    ];
}

function MijnHostRegistrar_Nameservers($params)
{
    try {
        $action = new Nameservers($params);
        return $action->execute();
    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host', 'Nameservers',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}

function MijnHostRegistrar_Contacts($params)
{
    try {
        $action = new Contacts($params);
        return $action->execute();
    } catch (\Exception $e) {
        \logModuleCall(
            'mijn.host', 'Contacts',
            print_r($params, true),
            $e->getMessage(),
            $e->getMessage()
        );

        return [
            'error' => $e->getMessage(),
        ];
    }
}
