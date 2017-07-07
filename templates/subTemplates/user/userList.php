<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Identifiant</th>
        <th>Mot de passe</th>
        <th>E-mail</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php

        /**
         * @var \gestionStock\entities\user\user $user
         */
    for($i=0, $count=count($userList); $i<$count; ++$i):
        $user = $userList[$i];
        if(!($user instanceof \gestionStock\entities\user\User))
            continue;
        ?>

        <tr>
            <td><?php echo htmlentities ($user->getId());?></td>
            <td><?php echo htmlentities ($user->getNom());?></td>
            <td><?php echo htmlentities ($user->getPrenom());?></td>
            <td><?php echo htmlentities ($user->getIdentifiant());?></td>
            <td><?php echo htmlentities ($user->getpassword());?></td>
            <td><?php echo htmlentities ($user->getEmail());?></td>
            <td><a href="index.php?action=edit&amp;entities=user&amp;id=<?php  echo htmlentities($user->getId(), ENT_QUOTES) ?>/">Mettre à jour</a></td>
            <td><a href="index.php?action=delete&amp;entities=user&amp;id=<?php echo htmlentities($user->getId(), ENT_QUOTES) ?>/">Supprimer</a></td>

        </tr>
        <?php
    endfor;
    ?>
    <a href="index.php?action=Homepage">Home</a>
    </tbody>
</table>
