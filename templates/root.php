<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>

    <style>

        .erreur, .error
        {
            border: solid 1px red;
            font-weight: bold;
            color: red;
            border-radius: 10px;

        }
        .erreur
        {
            border-radius: 5px;
            padding: 0.5em;
        }
        input, select
        {
            padding: 0.5em;
            border-radius: 10px;
            outline: none;
        }
        .user-form
        {
            width: 50%;
            margin: auto;
            border: solid 1px #000;
            border-radius: 10px;
            padding: 1em;
        }
        label, label + input, label + select
        {
            display: inline-block;
            width: 45%;
        }
        .submit-container
        {
            text-align: center;
        }
        h1
        {
            text-align: center;
        }
        table
        {
            width: 80%;
            margin: auto;
            border: solid 1px #000;
        }
        td
        {
            text-align: center;
        }
        body
        {
            color:blue;
            /*text-shadow: 5px 5px 5px black;*/
            text-align:center;
        }
    </style>
</head>
<body>
<?php
if(isset($error))
{
    echo '<div class="erreur">'.htmlentities($error).'</div>';
}


$errorMessageList = \gestionStock\utils\ErrorMessageManager::getInstance()->getMessageList();


foreach ($errorMessageList as $error)
{
    echo '<div class="erreur">'.htmlentities($error).'</div>';
}

?>

<?php
$fileToIncludePath = __DIR__.DIRECTORY_SEPARATOR.'subTemplates'.DIRECTORY_SEPARATOR.$templateName;
if(file_exists($fileToIncludePath))
{
    include $fileToIncludePath;
}


?>
</body>
</html>