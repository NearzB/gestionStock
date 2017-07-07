<h1>Confirmation suppresion</h1>
<?php
/**
 *
 *  @var \gestionStock\entities\fournisseur\fournisseur $client
 */
?>
<form action="index.php?action=delete" method="post">
    <p>Voulez-vous réellement supprimer ce fournisseur: <?php echo htmlentities($fournisseur->getNomFournisseur().' '.$fournisseur->getId());?> ?</p>
    <p><input type="hidden" name="client_id" value="yes"/></p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
</form>
<a href="index.php?action=Homepage">Home</a>