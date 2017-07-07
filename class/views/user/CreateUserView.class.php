<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 01/07/2017
 * Time: 17:31
 */

namespace gestionStock\views\user;


class CreateUserView extends AView implements IView

{


    protected  function getTemplateNameWithoutExt()
    {
        return 'user\editUser';
    }

    protected  function getTitle()
    {
        return "Create user";
    }

}