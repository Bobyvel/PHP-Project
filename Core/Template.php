<?php

namespace Core;


class Template
{
    const TEMPLATES_FOLDER = 'App/Template/';
    const TEMPLATES_EXTENSION = '.php';

    public function render(string $templateName, $data = null, array $errors = [])
    {
        include self::TEMPLATES_FOLDER
            . $templateName
            . self::TEMPLATES_EXTENSION;
    }
}