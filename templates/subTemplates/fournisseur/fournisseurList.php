<table class="bordure">
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom fournisseur</th>
        <th>Numéro de compte</th>
        <th>Numéro de téléphone</th>
        <th>Numéro de TVA</th>
        <th>Adresse</th>
        <th>Email</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($fournisseurList); $i<$count; ++$i):
        /**
         * @var \gestionStock\entities\fournisseur\fournisseur $fournisseur
         */
        $fournisseur = $fournisseurList[$i];
        if(!($fournisseur instanceof \gestionStock\entities\fournisseur\fournisseur))
            continue;
        ?>

        <tr>
            <td><?php echo htmlentities ($fournisseur->getId());?></td>
            <td><?php echo htmlentities ($fournisseur->getNomFournisseur());?></td>
            <td><?php echo htmlentities ($fournisseur->getNumeroCompte());?></td>
            <td><?php echo htmlentities ($fournisseur->getNumeroTel());?></td>
            <td><?php echo htmlentities ($fournisseur->getNumeroTva());?></td>
            <td><?php echo htmlentities ($fournisseur->getAdresse());?></td>
            <td><?php echo htmlentities ($fournisseur->getEmail());?></td>
            <td><a href="index.php?action=edit&amp;entities=fournisseur&amp;id=<?php  echo htmlentities($fournisseur->getId(), ENT_QUOTES) ?>">Mettre à jour</a></td>
            <td><a href="index.php?action=delete&amp;entities=fournisseur&amp;id=<?php echo htmlentities($fournisseur->getId(), ENT_QUOTES) ?>">Supprimer</a></td>

        </tr>
        <?php
    endfor;
    ?>
    </tbody>
</table>