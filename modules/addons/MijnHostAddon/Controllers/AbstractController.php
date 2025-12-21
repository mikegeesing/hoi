<?php

namespace ModulesGarden\MijnHostAddon\Controllers;

abstract class AbstractController
{
    protected array $params = [];

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }
}