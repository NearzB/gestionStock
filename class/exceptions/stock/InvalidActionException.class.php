<?php
namespace gestionStock\exceptions\stock;

class InvalidActionException extends \Exception
{


    public function __construct($message = "")
    {
        parent::__construct($message);
    }





}