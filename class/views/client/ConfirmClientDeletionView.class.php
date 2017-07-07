<?php
namespace gestionStock\views\client;


class ConfirmClientDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'client\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirmation Suppression";
    }

}