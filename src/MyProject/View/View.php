<?php


namespace MyProject\View;


class View
{
    private $extraVars = [];

    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    public function renderHtml(string $templateName, array $vars = [], int $httpCode = 200)
    {
        http_response_code($httpCode);

        extract($vars);
        extract($this->extraVars);
        
		ob_start();
        include $this->templatesPath . '/' . $templateName;
		$buffer = ob_get_contents();
		ob_end_clean();
		
		echo $buffer;
    }

    public function setExtraVars(string $name, $value)
    {
        $this->extraVars[$name] = $value;
    }
}
