<div class="text-light divRounded text-center">
<h2><b>Réserver une traversée</b></h2>
</div>

<br><br><br>

<div class="text-light text-center divReservation">

    <br>
    <div class="text-light text-center divInfosTraversee">
        <?php 
        echo 'Liaison : <b>'.$nomLiaisonSelected->portdepart.' - '.$nomLiaisonSelected->portarrivee.'</b><br>';
        echo 'Traversée : <b> n°'.$traverseeSelected->NOTRAVERSEE.'</b>, le <b>'.date('d/m/Y', strtotime($traverseeSelected->DATEHEUREDEPART)).'</b> à <b>'.date('H:i', strtotime($traverseeSelected->DATEHEUREDEPART)).'</b><br>';
        ?>
    </div>
    <br>

    <div class="text-light text-center divInfosClient">
        <?php
        echo '<h6>Nom : <b>'.$_SESSION['nom'].'</b></h6>';
        echo '<h6>Prénom : <b>'.$_SESSION['prenom'].'</b></h6>';
        echo '<h6>Adresse : <b>'.$_SESSION['adresse'].'</b></h6>';
        echo '<h6>Code postal : <b>'.$_SESSION['codepostal'].'</b></h6>';
        echo '<h6>Ville : <b>'.$_SESSION['ville'].'</b></h6>';

        ?>
    </div>

    <br>
    <h6><i>Veuillez saisir les informations relatives à la réservation</i></h6>
    <br>

    <form action='confirmation' method='post'>
        <table class="tableLiaisons text-light text-center mx-auto">
            <tr>
                <td></td>
                <td><b>Tarif en €</b></td>
                <td><b>Quantité</b></td>
            </tr>
            <?php
            foreach($typesTarifs as $unTypeTarif) {
                echo '<tr>';
                echo '<td>'.$unTypeTarif->LIBELLE.'</td>';
                echo '<td>'.$unTypeTarif->TARIF.'</td>';
                echo '<td>
                <input type="hidden" name="tabInfoLettre['.$unTypeTarif->LETTRECATEGORIE.']" value="0"/>
                <input type="hidden" name="tabInfoType['.$unTypeTarif->NOTYPE.']" value="0"/>
                <input type="number" name="'.$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE.'" min="0" max="10" value="0"></td>'; // l'input des
                // quantités est nommé en fonction de la catégorie et du type pour pouvoir les retrouver dans le POST
                echo '</tr>';
                
                // !! ajouter contrôle de saisie !!
            }
            ?>
        </table>
        <br>
        <input type="submit" class="btn btn-light" value="Valider mon panier">
    </form>

    <br><br>

</div>

<br><br><br>