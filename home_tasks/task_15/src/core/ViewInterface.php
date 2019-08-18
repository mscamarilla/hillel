<?php

namespace Core;


/**
 * Interface ViewInterface
 * @package Core
 */
interface ViewInterface
{
    /**
     * @param string $view_name
     * @return mixed
     */
    public function setViewName(string $view_name);

    /**
     * @param string|null $data
     * @return mixed
     */
    public function render(string $data = null);
}