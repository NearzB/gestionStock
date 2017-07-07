<h1>Confirmation suppresion</h1>
<?php
/**
 *
 *  @var \gestionStock\entities\stock\stock;
 */
?>
<form action="index.php?action=delete" method="post">
    <p>Voulez-vous réellement supprimer cette pièce: <?php echo htmlentities($stock->getNomPiece().' '.$stock->getId());?> ?</p>
    <p><input type="hidden" name="client_id" value="yes"/></p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
</form>
<a href="index.php?action=Homepage">Home</a>