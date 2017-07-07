<?php
namespace gestionStock\exceptions\user;

class InvalidActionException extends \Exception
{


    public function __construct($message = "")
    {
        parent::__construct($message);
    }





}