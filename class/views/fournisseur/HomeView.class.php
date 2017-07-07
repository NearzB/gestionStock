<?php
namespace gestionStock\views\fournisseur;


class HomeView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'fournisseur\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}