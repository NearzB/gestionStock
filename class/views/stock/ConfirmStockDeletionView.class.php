<?php
namespace gestionStock\views\stock;


class ConfirmStockDeletionView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'stock\confirmSupp';
    }

    protected  function getTitle()
    {
        return "Confirmation Suppression";
    }

}