<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 21:52
 */

namespace gestionStock\views\stock;


class EditStockView extends AView implements IView
{
    protected  function getTemplateNameWithoutExt()
    {
        return 'stock\editStock';
    }

    protected  function getTitle()
    {
        return "Modifier pièce";
    }

}
