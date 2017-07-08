<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <link rel="Stylesheet" href="design.css"/>
</head>
<body>
<nav>
	<div id="navlogo">
		
	</div>
	<ul>
        <li><a href="index.php">HomePage</a></li>
        <li><a href="index.php?action=home&amp;entities=client">Clients</a></li>
		<li><a href="index.php?action=home&amp;entities=fournisseur">Fournisseurs</a></li>
		<li><a href="index.php?action=home&amp;entities=stock">Stock</a></li>
		<li><a href="index.php?action=home&amp;entities=user">Utilisateurs</a></li>
	</ul>
</nav>
<article>
<?php
if(isset($_SESSION['error']))
{
    echo '<div class="erreur">'.htmlentities($_SESSION['error']).'</div>';
    unset($_SESSION['error']);
}
if(isset($_SESSION['success']))
{
    echo '<div class="success">'.htmlentities($_SESSION['success']).'</div>';
    unset($_SESSION['success']);
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
</article>
</body>
</html>