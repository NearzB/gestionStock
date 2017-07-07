<?php
namespace gestionStock\views\fournisseur;


class ConfirmFournisseurDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'fournisseur\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirmation Suppression";
    }

}