<?php

namespace gestionStock\controllers\stock;


class NotFoundController implements IController
{

    public function doAction()
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        echo $_GET['action'];
        exit;

    }

}
