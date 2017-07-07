<?php
namespace gestionStock\views\fournisseur;


class EditFournisseurView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'fournisseur\editFournisseur';
    }

    protected  function getTitle()
    {
        return "Modifier fournisseur";
    }

}