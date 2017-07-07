<?php
namespace gestionStock\views\user;


class HomeView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'user\default';
    }

    protected  function getTitle()
    {
        return "Home page";
    }

}