<?php


namespace App\Resources\View;

 class View
{

    private $content = [];


    private $html = '';

    public function set( $name, $value)
    {
        $this->content[$name] = $value;

        return $this;
    }

    public function render( $template)
    {
        extract($this->content);

        ob_start();
        include __DIR__ . '/../Template/' . $template . '.php';
        $this->html = ob_get_clean();

        return $this->renderLayout();
    }

    private function renderLayout()
    {
        extract($this->content);

        ob_start();
        include __DIR__ . '/../Template/layout.php';

        return ob_get_clean();
    }
}
