<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 21:47
 */

namespace gestionStock\views\stock;


class CreateStockView extends AView implements IView
{


    protected  function getTemplateNameWithoutExt()
    {
        return 'stock\editStock';
    }

    protected  function getTitle()
    {
        return "Ajouter Pièce";
    }

}
