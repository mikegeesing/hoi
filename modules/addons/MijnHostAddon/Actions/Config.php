<?php

namespace ModulesGarden\MijnHostAddon\Actions;

class Config extends AbstractAction
{
    function execute(): array
    {
        return [
            'name' => 'mijn.host',
            'author' => '<a target="_blank" href="https://www.modulesgarden.com/">ModulesGarden</a>',
            'language' => 'english',
            'version' => '1.0.0',
            'fields' => [
                'apiKey' => [
                    'FriendlyName' => 'API Key',
                    'Type' => 'text',
                    'Size' => '200'
                ]
            ]
        ];
    }
}