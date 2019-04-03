<?php

namespace App\HTTP;


use Core\DataBinding;
use Core\Template;

abstract class HttpHandlerAbstract
{
    /**
     * @var Template
     */
    private $template;
    /**
     * @var DataBinding
     */
    protected $binder;

    /**
     * HttpHandlerAbstract constructor.
     * @param Template $template
     * @param DataBinding $binder
     */
    public function __construct(Template $template, DataBinding $binder)
    {
        $this->template = $template;
        $this->binder = $binder;
    }


    public function render(string $templateName, $data = null, array $errors=[]){
        $this->template->render($templateName, $data, $errors);
    }
    public function redirect(string $url)
    {
        header("Location: $url");
        exit;
    }
}