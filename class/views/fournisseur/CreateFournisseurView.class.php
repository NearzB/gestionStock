<?php
namespace gestionStock\views\fournisseur;


class CreateFournisseurView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'fournisseur\editFournisseur';
    }

    protected  function getTitle()
    {
        return "Create fournisseur";
    }

}