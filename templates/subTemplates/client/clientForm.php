<?php

use \gestionStock\entities\client\Client;

/**
 * @var \gestionStock\entities\client\client $client
 */
if(!isset($client) || !($client instanceof Client))
    $client = new Client();
?>
<form action="index.php?action=create&amp;entities=client" method="post" class="user-form">
    <p>
        <label for="nomClient">Nom client</label><input <?php echo isset($invalidFields) && in_array('nomClient', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="nomClient" id="nomClient" value="<?php echo htmlentities($client->getNomClient(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="adresseMailClient">Adresse Email</label><input <?php echo isset($invalidFields) && in_array('adresseMailClient', $invalidFields) ? 'class="error"' : ""?>  type="email" required="required" name="adresseMailClient" id="adresseMailClient" value="<?php echo htmlentities($client->getAdresseMailClient(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="numeroCompte">Numéro de compte</label><input <?php echo (isset($invalidFields) && in_array('numeroCompte', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="numeroCompte" id="numeroCompte" value="<?php echo htmlentities($client->getNumeroCompte(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="numeroTva">Numéro de TVA</label><input <?php echo (isset($invalidFields) && in_array('numeroTva', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="numeroTva" id="numeroTva" value="<?php echo htmlentities($client->getNumeroTva(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="numeroTel">Numéro de téléphone</label><input <?php echo (isset($invalidFields) && in_array('numeroTel', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="numeroTel" id="numeroTel" value="<?php echo htmlentities($client->getNumeroTel(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="adresseClient">Adresse du Client</label><input <?php echo (isset($invalidFields) && in_array('adresseClient', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="adresseClient" id="adresseClient" value="<?php echo htmlentities($client->getAdresseClient(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <input type="hidden" name="id" value="<?php echo $client->getId(); ?>"/>
    </p>
    <p class="submit-container"><input type="submit" value="valider"/></p>

</form>
<a href="index.php?action=Homepage">Home</a>