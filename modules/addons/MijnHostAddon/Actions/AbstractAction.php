<?php

namespace ModulesGarden\MijnHostAddon\Actions;

abstract class AbstractAction
{
    protected array $params = [];

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    abstract function execute(): array;
}