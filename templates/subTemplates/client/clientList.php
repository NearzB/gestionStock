<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom Client</th>
        <th>Email</th>
        <th>Numéro de compte</th>
        <th>Numéro de TVA</th>
        <th>Numéro de téléphone</th>
        <th>Adresse client</th>
        <th colspan="2">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i=0, $count=count($clientList); $i<$count; ++$i):
        /**
         * @var \gestionStock\entities\client\Client $client
         */
        $client = $clientList[$i];
        if(!($client instanceof \gestionStock\entities\client\Client))
            continue;
        ?>

        <tr>
            <td><?php echo htmlentities ($client->getId());?></td>
            <td><?php echo htmlentities ($client->getNomClient());?></td>
            <td><?php echo htmlentities ($client->getAdresseMailClient());?></td>
            <td><?php echo htmlentities ($client->getNumeroCompte());?></td>
            <td><?php echo htmlentities ($client->getNumeroTva());?></td>
            <td><?php echo htmlentities ($client->getNumeroTel());?></td>
            <td><?php echo htmlentities ($client->getAdresseClient());?></td>
            <td><a href="index.php?action=edit&amp;entities=client&amp;id=<?php  echo htmlentities($client->getId(), ENT_QUOTES) ?>/">Mettre à jour</a></td>
            <td><a href="index.php?action=delete&amp;entities=client&amp;id=<?php echo htmlentities($client->getId(), ENT_QUOTES) ?>/">Supprimer</a></td>

        </tr>
        <?php
    endfor;
    ?>
    <a href="index.php?action=Homepage">Home</a>
    </tbody>
</table>