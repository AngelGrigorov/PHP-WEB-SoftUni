<?php

namespace Core;

class Template implements TemplateInterface
{
    const TEMPLATE_DIRECTORY = 'App\Templates\\';
    const TEMPLATE_EXTENSION = '.php';

    public function render(string $templateName, $data)
    {
        require_once 'App/Templates/'.$templateName.'.php';
    }
}