<?php

namespace Kd\Core\View;


class RenderView
{
    protected $__content = array();

    public function renderView($view, $data = array())
    {
        extract($data);
        ob_start();

        require_once BASE_PATH . 'Views/'.$view.'.php';

        $content = ob_get_contents();
        ob_end_clean();

        $this->__content[] = $content;
    }

    public function to($header)
    {
        header('location: ' . URL . $header);
        return;
    }

    public function show()
    {
        foreach ($this->__content as $html){
            echo $html;
        }
    }
}