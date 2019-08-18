<?php


namespace Controller;

use Core\Controller;


/**
 * Class ControllerError
 * @package Controller
 */
class ControllerError extends Controller
{
    /**
     * Message and HTTP status code for 404 page
     */
    public function actionNot_found(): void
    {

        header('HTTP/1.1 404 Not Found');
        $data = 'Page not found';
        $this->view->render($data);
    }

    /**
     * Message and HTTP status code for 403 page
     */
    public function actionForbidden(): void
    {
        header('HTTP/1.1 403 Forbidden');
        $data = 'You don\'t have permission to access this page';
        $this->view->render($data);
    }

    /**
     * Um...
     * Template loading error
     */
    public function actionView_error(): void
    {
        header('HTTP/1.1 418 I’m a teapot');
        $data = 'Could not load template file';
        $this->view->render($data);
    }

    /**
     * Message and HTTP status code for 400 page
     */
    public function actionBad_request(): void
    {
        header('HTTP/1.1 400 Bad Request');
        $data = 'Missing data parameters';
        $this->view->render($data);
    }
}
