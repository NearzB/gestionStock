<h1>Confirmation suppresion</h1>
<?php
/**
 *
 *  @var \gestionStock\entities\stock\stock;
 */
?>
<form action="index.php?action=delete&amp;entities=stock&amp;id=<?php echo $stock->getId(); ?>" method="post">
    <p>Voulez-vous réellement supprimer cette pièce: <?php echo htmlentities($stock->getNomPiece());?> ?</p>
    <p><input type="hidden" name="client_id" value="yes"/></p>
    <p class="submit-container"><input type="submit" name="confirmed" value="OK"/></p>
</form>
