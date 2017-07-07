<h1>Confirmer suppresion</h1>
<?php
/**
 *
 *  @var \gestionStock\entities\client\Client $client
 */
?>
<form action="index.php?action=delete" method="post">
    <p>Voulez-vous réellement supprimer ce client: <?php echo htmlentities($client->getNomClient().' '.$client->getId());?> ?</p>
    <p><input type="hidden" name="client_id" value="yes"/></p>
    <p class="submit-container"><input type="submit" value="OK"/></p>
</form>

<a href="index.php?action=Homepage">Home</a>