<?php


namespace Controller;

use Core\Controller;


class ControllerUser extends Controller
{

    public function actionIndex()
    {
        if (!empty($_SERVER['HTTP_AUTH_TOKEN'])) {
            $this->loadModel('model_user');
            $this->auth($_SERVER['HTTP_AUTH_TOKEN']);
        }

    }
}
