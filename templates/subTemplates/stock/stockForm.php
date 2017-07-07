<?php
/**
 * Created by PhpStorm.
 * User: Unknown
 * Date: 28/06/2017
 * Time: 21:56
 */


use \gestionStock\entities\Stock\stock;

/**
 * @var \gestionStock\entities\Stock\Stock; $stock
 */
if(!isset($stock) || !($stock instanceof Stock))
    $stock = new Stock();
?>
<form action="index.php?action=create&amp;entities=stock" method="post" class="user-form">
    <p>
        <label for="numPiece">numérode référence</label><input <?php echo isset($invalidFields) && in_array('numPiece', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="numPiece" id="numPiece" value="<?php echo htmlentities($stock->getNumPiece(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <label for="nomPiece">Nom de la pièce</label><input <?php echo (isset($invalidFields) && in_array('nomPiece', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="nomPiece" id="nomPiece" value="<?php echo htmlentities($stock->getNomPiece(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="prixAchat">Prix d'achat</label><input <?php echo (isset($invalidFields) && in_array('prixAchat', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="prixAchat" id="prixAchat" value="<?php echo htmlentities($stock->getPrixAchat(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <label for="prixVente">Prix de vente</label><input <?php echo (isset($invalidFields) && in_array('prixVente', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="prixVente" id="prixVente" value="<?php echo htmlentities($stock->getPrixVente(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <label for="emplacement">Localisation</label><input <?php echo (isset($invalidFields) && in_array('emplacement', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="emplacement" id="emplacement" value="<?php echo htmlentities($stock->getEmplacement(), ENT_QUOTES);?>"/>
    </p>

    <p>
        <input type="hidden" name="id" value="<?php echo $stock->getId(); ?>"/>
    </p>
    <p class="submit-container"><input type="submit" value="Valider"/></p>

</form>
<a href="index.php?action=Homepage">Home</a>