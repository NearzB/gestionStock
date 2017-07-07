<?php
namespace gestionStock\views\client;

class HomeView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'client\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}