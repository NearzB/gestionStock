<h1>Confirmation suppresion</h1>
<?php
/**
 *
 *  @var \gestionStock\entities\fournisseur\fournisseur $client
 */
?>
<form action="index.php?action=delete&amp;entities=fournisseur&amp;id=<?php echo $fournisseur->getId(); ?>" method="post">
    <p>Voulez-vous réellement supprimer ce fournisseur: <?php echo htmlentities($fournisseur->getNomFournisseur());?> ?</p>
    <p><input type="hidden" name="client_id" value="yes"/></p>
    <p class="submit-container"><input type="submit" name="confirmed" value="OK"/></p>
</form>
