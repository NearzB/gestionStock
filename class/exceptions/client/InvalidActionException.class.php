<?php
namespace gestionStock\exceptions\client;

class InvalidActionException extends \Exception
{


    public function __construct($message = "")
    {
        parent::__construct($message);
    }





}