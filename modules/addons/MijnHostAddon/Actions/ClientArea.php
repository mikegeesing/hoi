<?php

namespace ModulesGarden\MijnHostAddon\Actions;

use ModulesGarden\MijnHostAddon\Controllers\Nameservers;

class ClientArea extends AbstractAction
{
    function execute(): array
    {
        $controller = $_GET['mha-controller'] ?? 'Nameservers';
        $action = $_GET['mha-action'] ?? 'index';

        $controllerNamespace = "\\ModulesGarden\\MijnHostAddon\\Controllers\\$controller";

        if(class_exists($controllerNamespace) && method_exists($controllerNamespace, $action))
        {
            return (new $controllerNamespace($this->params))->$action();
        }

        return (new Nameservers($this->params))->index();
    }
}