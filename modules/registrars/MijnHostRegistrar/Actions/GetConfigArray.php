<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

class GetConfigArray extends AbstractAction
{

    function execute(): array
    {
        return [
            'FriendlyName' => [
                'Type' => 'System',
                'Value' => 'mijn.host',
            ],
            'ApiKey' => [
                'FriendlyName' => 'API Key',
                'Type' => 'text',
                'Size' => '100',
                'Default' => '',
                'Description' => '',
            ]
        ];
    }
}