<div class="container text-center text-light">

<div class="divRounded justify-content-center">
<h2><b>Tarifs pour une liaison (en €)</b></h2>
</div> 

<br><br>
<?php echo '<h5>Liaison n°'.$liaisonCourante->noliaison.' : '.$liaisonCourante->portdepart.' - '.$liaisonCourante->portarrivee.'</h5>'; ?>
<br><br>

<table class="tableLiaisons mx-auto text-light text-center">

<tr>
    <th rowspan="2">Catégorie</th>
    <th rowspan="2">Type</th>
    <!-- éventuellement modifier pour que les nb périodes soient dynamiques en fonction des périodes retournées dans la requête de $lesTarifs -->
    <?php echo '<th colspan='.$nbPeriodes.'>Période</th>';?>

</tr>
<tr>
    <?php foreach($lesPeriodes as $unePeriode) {
        echo '<th>'.$unePeriode->DATEDEBUT.'<br>'.$unePeriode->DATEFIN.'</th>';
    }?>

</tr>
<?php 
    $libelleCategorieDiff = "";
    $libelleTypeDiff = "";
    $tailleRowspanCategorie = 0;

    foreach($lesTarifs as $unTarif) {

        if ($unTarif->LIBELLECATEGORIE != $libelleCategorieDiff) { // si le libellé de catégorie est différent, on passe à la ligne de catégorie d'après (A, puis B, puis C ..)
            $libelleCategorieDiff = $unTarif->LIBELLECATEGORIE;
            foreach($nbTypes as $uneCategorie) {
                if($uneCategorie->LETTRECAT == $unTarif->LETTRECATEGORIE) {
                    $tailleRowspanCategorie = $uneCategorie->NBTYPES + 1;
                }
            }

            echo '<tr>
            <th rowspan='.$tailleRowspanCategorie.'>'.$unTarif->LETTRECATEGORIE.'<br>'.$libelleCategorieDiff.'</th> 
            </tr>'; // dynamique. doit être nb de types + 1 dû au /tr ici qui compte comme une row
        }

        if ($unTarif->LIBELLETYPE != $libelleTypeDiff) { // si le libellé de type est différent, on passe jusqu'à la prochaine catégorie
            $libelleTypeDiff = $unTarif->LIBELLETYPE; // assignation au libellé actuel
            echo '<tr>
            <th>'.$unTarif->LETTRECATEGORIE.$unTarif->NOTYPE.' - '.$libelleTypeDiff.'</th>
            <td>'.$unTarif->TARIF.'</td>';
        } else {
            echo '<td>'.$unTarif->TARIF.'</td>';
        }

    }
?>

</table>

<br><br>

</div>