<?php
namespace gestionStock\views\user;


class ConfirmUserDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'user\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirmer Suppression";
    }

}