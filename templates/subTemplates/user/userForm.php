<?php

use \gestionStock\entities\user\user;

/**
 * @var \gestionStock\entities\user\user $user
 */
if(!isset($user) || !($user instanceof User))
    $user = new User();
?>
<form action="index.php?action=create&amp;entities=user" method="post" class="user-form">
    <p>
        <label for="nom">Nom </label><input <?php echo isset($invalidFields) && in_array('nom', $invalidFields) ? 'class="error"' : ""?> type="text" required="required" name="nom" id="nom" value="<?php echo htmlentities($user->getNom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="prenom">Prénom</label><input <?php echo isset($invalidFields) && in_array('prenom', $invalidFields) ? 'class="error"' : ""?>  type="text" required="required" name="prenom" id="prenom" value="<?php echo htmlentities($user->getPrenom(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="identifiant">Identifiant</label><input <?php echo (isset($invalidFields) && in_array('identifiant', $invalidFields)) ? 'class="error"' : ""?>  type="text" required="required" name="identifiant" id="identifiant" value="<?php echo htmlentities($user->getIdentifiant(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="password">Password</label><input <?php echo (isset($invalidFields) && in_array('password', $invalidFields)) ? 'class="error"' : ""?>  type="password" required="required" name="password" id="password" value="<?php echo htmlentities($user->getpassword(), ENT_QUOTES);?>"/>
    </p>
    <p>
        <label for="email">Email</label><input <?php echo (isset($invalidFields) && in_array('email', $invalidFields)) ? 'class="error"' : ""?>  type="email" required="required" name="email" id="email" value="<?php echo htmlentities($user->getEmail(), ENT_QUOTES);?>"/>
    </p>

<p>
    <input type="hidden" name="id" value="<?php echo $user->getId(); ?>"/>
</p>
<p class="submit-container"><input type="submit" value="valider"/></p>

</form>
<a href="index.php?action=Homepage">Home</a>