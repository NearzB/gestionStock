<?php
namespace gestionStock\exceptions\fournisseur;

class InvalidActionException extends \Exception
{


    public function __construct($message = "")
    {
        parent::__construct($message);
    }





}