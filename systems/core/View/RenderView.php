<?php

namespace Kd\Core\View;


class RenderView
{
    protected $__content = array();


    /**
     * Render input view and convert it to array and save to $__content
     *
     * @param string $view
     *
     * @param array $data
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     */
    public function renderView($view, $data = array())
    {
        extract($data);
        ob_start();

        require_once BASE_PATH . 'Views/' . $view . '.php';

        $content = ob_get_contents();
        ob_end_clean();

        $this->__content[] = $content;
    }

    /**
     * Response to URl: localhost:8080/$header
     *
     * @param string $header
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     */
    public function to($header)
    {
        header('location: ' . URL . $header);
        return;
    }

    /**
     * Show Content of view
     *
     * @param null
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     */
    public function show()
    {
        foreach ($this->__content as $html) {
            echo $html;
        }
    }
}