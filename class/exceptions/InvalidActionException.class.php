<?php
namespace gestionStock\exceptions;

class InvalidActionException extends \Exception
{


    public function __construct($message = "")
    {
        parent::__construct($message);
    }





}