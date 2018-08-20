<?php

namespace Kd\Core\View;


class RenderView
{
    protected $__content = array();

    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

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
        $this->renderFile(BASE_PATH . 'Views' ,  $view , $data);
    }

    /**
     * Render file
     *
     * @param string $filePath
     *
     * @param string $view
     *
     * @param array $data
     *
     * @return void
     *
     * @author khaln@tech.est-rouge.com
     */
    public function renderFile($filePath,$view, $data = array()){
        extract($data);
        ob_start();

        require_once $filePath . DIRECTORY_SEPARATOR . $view .'.php';

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