<?php
namespace gestionStock\views\client;


class EditClientView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'client\editClient';
    }

    protected  function getTitle()
    {
        return "Modifier client";
    }

}