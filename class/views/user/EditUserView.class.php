<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 01/07/2017
 * Time: 17:32
 */

namespace gestionStock\views\user;

use gestionStock\views\AView;
use gestionStock\views\IView;
class EditUserView extends AView implements IView
{

    protected  function getTemplateNameWithoutExt()
    {
        return 'user\editUser';
    }

    protected  function getTitle()
    {
        return "Modifier Utilisateur";
    }

}
