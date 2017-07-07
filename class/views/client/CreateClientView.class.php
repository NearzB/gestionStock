<?php
namespace gestionStock\views\client;


class CreateClientView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'client\editClient';
    }

    protected  function getTitle()
    {
        return "Create client";
    }

}