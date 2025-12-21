<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

class MetaData extends AbstractAction
{
    function execute(): array
    {
        return [
            'DisplayName' => 'mijn.host',
            'APIVersion' => '1.1',
        ];
    }
}