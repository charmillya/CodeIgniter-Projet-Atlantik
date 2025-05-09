<div class="text-light divRounded text-center">
<h2><b>Récapitulatif de réservation</b></h2>
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
    <h6><i>Veuillez confirmer les informations relatives à la réservation</i></h6>
    <br>
    <?php if(isset($Erreur)) {
        echo '<h6 class="text-danger"><b>'.$Erreur.'</b></h6><br>';
    }?>

    <form action="" method='post'>
        <table class="tableLiaisons text-light text-center mx-auto">
            <tr>
                <td></td>
                <td><b>Tarif en €</b></td>
                <td><b>Quantité</b></td>
                <td><b>Coût</b></td>
            </tr>
            <?php
            $totalQuantite = 0;
            $lettreCategorieCourante = "";
            foreach($typesTarifs as $unTypeTarif) {
                if($unTypeTarif->LETTRECATEGORIE != $lettreCategorieCourante) {
                    echo '<tr>';
                    echo '<td colspan="4"><b>'.$unTypeTarif->LIBELLECATEGORIE.'</b></td>';
                    $lettreCategorieCourante = $unTypeTarif->LETTRECATEGORIE;
                }
                echo '<tr>';
                echo '<td>'.$unTypeTarif->LIBELLETYPE.'</td>';
                echo '<td>'.$unTypeTarif->TARIF.'</td>';
                if(isset($_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE])) {
                    echo '<td><h6 class="text-success"><b>'.($_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE]).'</b></h6></td>';
                    $totalQuantite += $unTypeTarif->TARIF*$_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE];
                    echo '<td><h6 class="text-info"><b>'.($unTypeTarif->TARIF*$_SESSION['tabReservationEntree'][$unTypeTarif->LETTRECATEGORIE.$unTypeTarif->NOTYPE]).'€</b></h6></td>';
                }
                else {
                    echo '<td></td>';
                    echo '<td></td>';
                }
                echo '</tr>';
                
            }
            ?>
        </table>
        <br>
        
        <?php 
        echo '<h5 class="text-info"><b>Montant total : '.$totalQuantite.'€</b></h5>';
        echo '<br>';
        echo '<h6>Sélectionnez une méthode de paiement:</h6>';
        echo '<select name="moyenPaiement" id="moyenPaiement">';
        echo '<option value="CB">Carte bancaire</option>';
        echo '<option value="ESPECES">Espèces</option>';
        echo '</select>';
        echo '<br><br>';
        echo "<div class='connexionBtn'>";
        echo '<a class="btn btn-light" href="/traversees/reserver/'.$traverseeSelected->NOTRAVERSEE.'">Modifier ma réservation</a>';
        echo '<input type="submit" class="btn btn-light" name="btnValiderReservation" value="Passer au paiement">';
        echo '</div>';
        ?>
    </form>

    <br><br>

</div>

<br><br><br>