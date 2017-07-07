<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Numéro de référence </th>
        <th>Nom de pièce</th>
        <th>Prix d'achat</th>
        <th>Prix de vente</th>
        <th>Numéro de téléphone</th>
        <th>Localisation</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($stockList); $i<$count; ++$i):
        /**
         * @var \gestionStock\entities\Stock\stock $stock
         */
        $stock = $stockList[$i];
        if(!($stock instanceof \gestionStock\entities\Stock\stock))
            continue;
        ?>

        <tr>
            <td><?php echo htmlentities ($stock->getId());?></td>
            <td><?php echo htmlentities ($stock->getNumPiece());?></td>
            <td><?php echo htmlentities ($stock->getNomPiece());?></td>
            <td><?php echo htmlentities ($stock->getPrixAchat());?></td>
            <td><?php echo htmlentities ($stock->getPrixVente());?></td>
            <td><?php echo htmlentities ($stock->getEmplacement());?></td>
            <td><a href="index.php?action=edit&amp;entities=stock&amp;id=<?php  echo htmlentities($stock->getId(), ENT_QUOTES) ?>/">Mettre à jour</a></td>
            <td><a href="index.php?action=delete&amp;entities=stock&amp;id=<?php echo htmlentities($stock->getId(), ENT_QUOTES) ?>/">Supprimer</a></td>

        </tr>
        <?php
    endfor;
    ?>
    <a href="index.php?action=Homepage">Home</a>
    </tbody>
</table>