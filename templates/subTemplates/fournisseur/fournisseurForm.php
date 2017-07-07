<?php

use \gestionStock\entities\fournisseur\Fournisseur;

/**
 * @var \gestionStock\entities\fournisseur\Fournisseur $fournisseur
 */
if(!isset($fournisseur) || !($fournisseur instanceof Fournisseur))
    $fournisseur = new Fournisseur();
?>
<form action="index.php?action=create&amp;entities=fournisseur" method="post" class="user-form">
    <p>
        <label for="nomFournisseur">Nom fournisseur</label><input <?php echo isset($invalidFields) && in_array('nomFournisseur', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="nomFournisseur" id="nomFournisseur" value="<?php echo htmlentities($fournisseur->getNomFournisseur(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <label for="numeroCompte">Numéro de compte</label><input <?php echo (isset($invalidFields) && in_array('numeroCompte', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="numeroCompte" id="numeroCompte" value="<?php echo htmlentities($fournisseur->getNumeroCompte(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <label for="numeroTel">Numéro de téléphone</label><input <?php echo (isset($invalidFields) && in_array('numeroTel', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="numeroTel" id="numeroTel" value="<?php echo htmlentities($fournisseur->getNumeroTel(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="numeroTva">Numéro de TVA</label><input <?php echo (isset($invalidFields) && in_array('numeroTva', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="numeroTva" id="numeroTva" value="<?php echo htmlentities($fournisseur->getNumeroTva(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="adresse">Adresse du Fournisseur</label><input <?php echo (isset($invalidFields) && in_array('adresse', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="adresse" id="adresse" value="<?php echo htmlentities($fournisseur->getAdresse(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Adresse Email</label><input <?php echo isset($invalidFields) && in_array('adresseMailFournisseur', $invalidFields) ? 'class="error"' : ""?>  type="email" required="required" name="email" id="email" value="<?php echo htmlentities($fournisseur->getEmail(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <input type="hidden" name="id" value="<?php echo $fournisseur->getId(); ?>"/>
    </p>
    <p class="submit-container"><input type="submit" value="valider"/></p>

</form>
<a href="index.php?action=Homepage">Home</a>