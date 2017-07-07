<?php
namespace gestionStock\views\stock;


class HomeView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'stock\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}