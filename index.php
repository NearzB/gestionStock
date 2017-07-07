<?php
session_start();
require_once __DIR__.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'autoloader.php';
if(isset($_GET['entities']))
{
    echo $_GET['entities'];
    if($_GET['entities']=='client')
    {
        $entities='client';
    }
    else if($_GET['entities']=='fournisseur')
    {
        $entities='fournisseur';
    }
    else if($_GET['entities']=='stock')
    {
        $entities='stock';
    }
    else if($_GET['entities']=='user')
    {
        $entities='user';
    }
    else
    {
        $entities='Homepage';
    }

}
else
{
    $entities='Homepage';

}
if(!isset($_GET['action'])||$entities=='Homepage')
{

    $controller = new \gestionStock\controllers\HomepageController();
}
else if($_GET['action'] == 'create')
{
    $path = '\\gestionStock\\controllers\\'.$entities.'\\Create'.$entities.'Controller';
    $controller = new $path();
}
else if($_GET['action'] == 'edit')
{
    $path = '\\gestionStock\\controllers\\'.$entities.'\\Edit'.$entities.'Controller';
    $controller = new $path();
}
else if($_GET['action'] == 'delete')
{
    $path = '\\gestionStock\\controllers\\'.$entities.'\\Delete'.$entities.'Controller';
    $controller = new $path();
}
else if($_GET['action'] == 'home')
{
    $path = '\\gestionStock\\controllers\\'.$entities.'\\HomeController';
    $controller = new $path();
}
else
{
    $path = '\\gestionStock\\controllers\\'.$entities.'\\NotFoundController';
    $controller = new $path();
}




$controller->doAction();