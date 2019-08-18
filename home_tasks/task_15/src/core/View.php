<?php

namespace Core;


/**
 * Class View
 * @package Core
 */
class View implements ViewInterface
{

    /**
     * @var
     */
    protected $view_name;

    /**
     * @param string $view_name
     */
    public function setViewName(string $view_name):void
    {
        $this->view_name = $view_name;

    }

    /**
     * @param string|null $data
     */
    public function render(string $data = null):void
    {
        if (is_file('src/view/' . $this->view_name)) {
            include 'src/view/' . $this->view_name;
        } else {
            header(sprintf("Location: %s", 'index.php?route=error/view_error'));
        }
    }
}
